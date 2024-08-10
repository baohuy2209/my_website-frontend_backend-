<?php
	if(!defined('SOURCES')) die("Error");

	switch($act)
	{
		case "man":
			get_items();
			$template = "contact/man/items";
			break;

		case "edit":
			get_item();
			$template = "contact/man/item_add";
			break;

		case "save":
			save_item();
			break;

		case "delete":
			delete_item();
			break;

		default:
			$template = "404";
	}

	/* Get contact */
	function get_items()
	{
		global $d, $func, $curPage, $items, $paging;

		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and ten LIKE '%$keyword%'";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_contact where id<>0 $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_contact where id<>0 $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=contact&act=man";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit contact */
	function get_item()
	{
		global $d, $func, $curPage, $item;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=contact&act=man&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_contact where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=contact&act=man&p=".$curPage, false);
	}

	/* Save contact */
	function save_item()
	{
		global $d, $func, $curPage;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=contact&act=man&p=".$curPage, false);

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}
		}
		
		if($id)
		{
			$data['hienthi'] = 1;
			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			if($d->update('contact',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=contact&act=man&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=contact&act=man&p=".$curPage, false);
		}
		else
		{
			$func->transfer("Dữ liệu rỗng", "index.php?com=contact&act=man&p=".$curPage, false);
		}
	}

	/* Delete contact */
	function delete_item()
	{
		global $d, $func, $curPage;
		
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id, taptin from #_contact where id = ? limit 0,1",array($id));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_FILE.$row['taptin']);
				$d->rawQuery("delete from #_contact where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=contact&act=man&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=contact&act=man&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, taptin from #_contact where id = ? limit 0,1",array($id));
				
				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_FILE.$row['taptin']);
					$d->rawQuery("delete from #_contact where id = ?",array($id));
				}
			}
			
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=contact&act=man&p=".$curPage);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=contact&act=man&p=".$curPage, false);
	}
?>