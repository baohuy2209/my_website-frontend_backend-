<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active lang */
	if(!isset($config['website']['debug-developer']) || $config['website']['debug-developer'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Cấu hình đường dẫn trả về */
	$strUrl = "";
	$strUrl = (isset($_REQUEST['keyword'])) ? "&keyword=".htmlspecialchars($_REQUEST['keyword']) : "";

	switch($act)
	{
		case "create":
			get_create();
			break;

		case "man":
			get_items();
			$template = "lang/man/items";
			break;

		case "add":
			$template = "lang/man/item_add";
			break;

		case "edit":		
			get_item();
			$template = "lang/man/item_add";
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

	/* Create lang */
	function get_create()
	{
		global $d, $config, $func, $curPage;

		$flag = 0;
		foreach($config['website']['lang'] as $k => $v)
		{
			$lang = $d->rawQuery("select giatri, lang$k from #_lang");
			if(file_exists(LIBRARIES."lang/lang".$k.".php"))
			{
				$langfile = fopen(LIBRARIES."lang/lang".$k.".php", "w") or $func->transfer("Không thể tạo tập tin.","index.php?com=lang&act=man&p=".$curPage, false);

				$flag++;
				$str = '<?php';
				for($i=0;$i<count($lang);$i++) $str .= PHP_EOL.'define("'.$lang[$i]['giatri'].'","'.$lang[$i]['lang'.$k].'");';
				$str .= PHP_EOL.'?>';

				fwrite($langfile, $str);
				fclose($langfile);
			}
		}

		if(!$flag)
		{
			$func->transfer("Tạo tập tin ngôn ngữ thất bại","index.php?com=lang&act=man&p=".$curPage, false);
		}
		else
		{
			$func->transfer("Tạo tập tin ngôn ngữ thành công","index.php?com=lang&act=man&p=".$curPage);
		}
	}

	/* Get lang */
	function get_items()
	{
		global $d, $func, $curPage, $items, $paging, $strUrl;

		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " where giatri LIKE '%$keyword%'";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_lang $where order by id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_lang $where order by id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=lang&act=man".$strUrl;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit lang */
	function get_item()
	{
		global $d, $curPage, $func, $item;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=lang&act=man&p=".$curPage, false);	

		$item = $d->rawQueryOne("select * from #_lang where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=lang&act=man&p=".$curPage, false);	
	}

	/* Save lang */
	function save_item()
	{
		global $d, $curPage, $func, $config;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=lang&act=man&p=".$curPage, false);

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
			$d->where('id', $id);
			if($d->update('lang',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=lang&act=man&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=lang&act=man&p=".$curPage, false);
		}
		else
		{
			if($d->insert('lang',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=lang&act=man&p=".$curPage);
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=lang&act=man&p=".$curPage, false);
		}
	}

	/* Delete lang */
	function delete_item()
	{
		global $d, $func, $curPage;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id from #_lang where id = ? limit 0,1",array($id));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$d->rawQuery("delete from #_lang where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=lang&act=man&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=lang&act=man&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id from #_lang where id = ? limit 0,1",array($id));

				if(isset($row['id']) && $row['id'] > 0) $d->rawQuery("delete from #_lang where id = ?",array($id));
			}
			
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=lang&act=man&p=".$curPage);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=lang&act=man&p=".$curPage, false);
	}
?>