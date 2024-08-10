<?php
	if(!defined('SOURCES')) die("Error");

	switch($act)
	{
		case "capnhat":
			get_setting();
			$template = "setting/man/item_add";
			break;
		case "save":
			save_setting();
			break;
			
		default:
			$template = "404";
	}

	/* Get setting */
	function get_setting()
	{
		global $d, $item;

		$item = $d->rawQueryOne("select * from #_setting limit 0,1");
	}

	/* Save setting */
	function save_setting()
	{
		global $d, $func, $config, $com;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=setting&act=capnhat", false);

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
		$row = $d->rawQueryOne("select id, options from #_setting where id = ? limit 0,1",array($id));
		$option = json_decode($row['options'],true);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				if(is_array($value))
				{
					foreach($value as $k2 => $v2) $option[$k2] = $v2;
					$data[$column] = json_encode($option);
				}
				else
				{
					$data[$column] = htmlspecialchars($value);
				}
			}
		}
		
		/* Post Seo */
		$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
		if($dataSeo)
		{
			foreach($dataSeo as $column => $value)
			{
				$dataSeo[$column] = htmlspecialchars($value);
			}
		}

		if(isset($row['id']) && $row['id'] > 0)
		{
			$d->where('id',$id);
			if($d->update('setting',$data))
			{
				/* SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array(0,$com,'capnhat',$com));
				$dataSeo['idmuc'] = 0;
				$dataSeo['com'] = $com;
				$dataSeo['act'] = 'capnhat';
				$dataSeo['type'] = $com;
				$d->insert('seo',$dataSeo);

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=setting&act=capnhat");
			}
			else
			{
				$func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=setting&act=capnhat", false);
			}
		}
		else
		{
			if($d->insert('setting',$data))
			{
				/* SEO */
				$dataSeo['idmuc'] = 0;
				$dataSeo['com'] = $com;
				$dataSeo['act'] = 'capnhat';
				$dataSeo['type'] = $com;
				$d->insert('seo',$dataSeo);

				$func->transfer("Thêm dữ liệu thành công", "index.php?com=setting&act=capnhat");
			}
			else
			{
				$func->transfer("Thêm dữ liệu bị lỗi", "index.php?com=setting&act=capnhat", false);
			}
		}
	}
?>