<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active news */
	if(isset($config['news']))
	{
		$arrCheck = array();
		foreach($config['news'] as $k => $v) $arrCheck[] = $k;
		if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);
	}
	else
	{
		$func->transfer("Trang không tồn tại", "index.php", false);
	}

	/* Cấu hình đường dẫn trả về */
	$strUrl = "";
	$arrUrl = array('id_list','id_cat','id_item','id_sub','id_brand');
	if(isset($_POST['data']))
	{
		$dataUrl = isset($_POST['data']) ? $_POST['data'] : null;
		if($dataUrl)
		{
			foreach($arrUrl as $k => $v)
			{
				if(isset($dataUrl[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($dataUrl[$arrUrl[$k]]);
			}
		}
	}
	else
	{
		foreach($arrUrl as $k => $v)
		{
			if(isset($_REQUEST[$arrUrl[$k]])) $strUrl .= "&".$arrUrl[$k]."=".htmlspecialchars($_REQUEST[$arrUrl[$k]]);
		}
		if(isset($_REQUEST['keyword'])) $strUrl .= "&keyword=".htmlspecialchars($_REQUEST['keyword']);
	}

	switch($act)
	{
		/* Man */
		case "man":
			get_items();
			$template = "news/man/items";
			break;
		case "add":
			$template = "news/man/item_add";
			break;
		case "edit":
		case "copy":
			if((!isset($config['news'][$type]['copy']) || $config['news'][$type]['copy'] == false) && $act=='copy')
			{
				$template = "404";
				return false;
			}
			get_item();
			$template = "news/man/item_add";
			break;
		case "save":
		case "save_copy":
			save_item();
			break;
		case "delete":
			delete_item();
			break;

		/* List */
		case "man_list":
			get_lists();
			$template = "news/list/lists";
			break;
		case "add_list":
			$template = "news/list/list_add";
			break;
		case "edit_list":
			get_list();
			$template = "news/list/list_add";
			break;
		case "save_list":
			save_list();
			break;
		case "delete_list":
			delete_list();
			break;

		/* Cat */
		case "man_cat":
			get_cats();
			$template = "news/cat/cats";
			break;
		case "add_cat":
			$template = "news/cat/cat_add";
			break;
		case "edit_cat":
			get_cat();
			$template = "news/cat/cat_add";
			break;
		case "save_cat":
			save_cat();
			break;
		case "delete_cat":
			delete_cat();
			break;

		/* Item */
		case "man_item":
			get_loais();
			$template = "news/item/loais";
			break;
		case "add_item":
			$template = "news/item/loai_add";
			break;
		case "edit_item":
			get_loai();
			$template = "news/item/loai_add";
			break;
		case "save_item":
			save_loai();
			break;
		case "delete_item":
			delete_loai();
			break;

		/* Sub */
		case "man_sub":
			get_subs();
			$template = "news/sub/subs";
			break;
		case "add_sub":
			$template = "news/sub/sub_add";
			break;
		case "edit_sub":
			get_sub();
			$template = "news/sub/sub_add";
			break;
		case "save_sub":
			save_sub();
			break;
		case "delete_sub":
			delete_sub();
			break;
		
		/* Gallery */
		case "man_photo":
		case "add_photo":
		case "edit_photo":
		case "save_photo":
		case "delete_photo":
			include "gallery.php";
			break;

		default:
			$template = "404";
	}

	/* Get man */
	function get_items()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;

		$where = "";
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
		$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']) : 0;
		$iditem = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']) : 0;
		$idsub = (isset($_REQUEST['id_sub'])) ? htmlspecialchars($_REQUEST['id_sub']) : 0;

		if($idlist) $where .= " and id_list=$idlist";
		if($idcat) $where .= " and id_cat=$idcat";
		if($iditem) $where .= " and id_item=$iditem";
		if($idsub) $where .= " and id_sub=$idsub";
		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_news where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_news where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=news&act=man".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit man */
	function get_item()
	{
		global $d, $strUrl, $func, $curPage, $item, $gallery, $type, $com, $act;

		$id = 0;
		if(isset($_GET['id'])) $id = htmlspecialchars($_GET['id']);
		if(isset($_GET['id_copy'])) $id = htmlspecialchars($_GET['id_copy']);

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_news where id = ? and type = ? limit 0,1",array($id,$type));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		/* Lấy hình ảnh con */
		if($act != 'copy')
		{
			$gallery = $d->rawQuery("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($id,$com,$type,'man',$type));
		}
	}

	/* Save man */
	function save_item()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $act, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = isset($_POST['data']) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
			else $data['tenkhongdauvi'] = (isset($data['tenvi'])) ? $func->changeTitle($data['tenvi']) : '';
			if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
			else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']) : '';
			if(isset($config['news'][$type]['tags']) && $config['news'][$type]['tags'] == true)
			{
				if(isset($_POST['tags_group']) && ($_POST['tags_group'] != '')) $data['id_tags'] = implode(",", $_POST['tags_group']);
				else $data['id_tags'] = "";
			}
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['type'] = $type;
		}

		/* Post seo */
		if(isset($config['news'][$type]['seo']) && $config['news'][$type]['seo'] == true)
		{
			$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
			if($dataSeo)
			{
				foreach($dataSeo as $column => $value)
				{
					$dataSeo[$column] = htmlspecialchars($value);
				}
			}
		}

		$savehere = (isset($_POST['save-here'])) ? true : false;
		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id && $act!='save_copy')
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_news where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_NEWS.$row['photo']);
				}
			}

			$data['ngaysua'] = time();

			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('news',$data))
			{
				/* SEO */
				if(isset($config['news'][$type]['seo']) && $config['news'][$type]['seo'] == true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				if($savehere) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=news&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id);
				else $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl);
			}
			else
			{
				if($savehere) $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id, false);
				else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);
			}
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
				}
			}
		
			$data['ngaytao'] = time();

			if($d->insert('news',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(isset($config['news'][$type]['seo']) && $config['news'][$type]['seo'] == true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				/* Cập nhật hash khi upload multi */
				$hash = (isset($_POST['hash']) && $_POST['hash'] != '') ? addslashes($_POST['hash']) : null;
				if($hash)
				{
					$d->rawQuery("update #_gallery set hash = ?, id_photo = ? where hash = ?",array('',$id_insert,$hash));
				}

				if($act=='save_copy')
				{
					if($savehere) $func->transfer("Sao chép dữ liệu thành công", "index.php?com=news&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert);
					else $func->transfer("Sao chép dữ liệu thành công", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl);
				}
				else
				{
					if($savehere) $func->transfer("Lưu dữ liệu thành công", "index.php?com=news&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert);
					else $func->transfer("Lưu dữ liệu thành công", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl);
				}
			}
			else
			{
				if($act=='save_copy')
				{
					if($savehere) $func->transfer("Sao chép dữ liệu bị lỗi", "index.php?com=news&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert, false);
					else $func->transfer("Sao chép dữ liệu bị lỗi", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);
				}
				else
				{
					if($savehere) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=edit&type=".$type."&p=".$curPage.$strUrl."&id=".$id_insert, false);
					else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);
				}
			}
		}
	}

	/* Delete man */
	function delete_item()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_news where id = ? and type = ? limit 0,1",array($id,$type));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_NEWS.$row['photo']);
				$d->rawQuery("delete from #_news where id = ?",array($id));

				/* Xóa gallery */
				$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));

				if(count($row))
				{
					foreach($row as $v)
					{
						$func->delete_file(UPLOAD_NEWS.$v['photo']);
						$func->delete_file(UPLOAD_FILE.$v['taptin']);
					}

					$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));
				}

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_news where id = ? and type = ? limit 0,1",array($id,$type));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_NEWS.$row['photo']);
					$d->rawQuery("delete from #_news where id = ?",array($id));

					/* Xóa gallery */
					$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));

					if(count($row))
					{
						foreach($row as $v)
						{
							$func->delete_file(UPLOAD_NEWS.$v['photo']);
							$func->delete_file(UPLOAD_FILE.$v['taptin']);
						}

						$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',$com));
					}
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl);
		} 
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get list */
	function get_lists()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;
		
		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_news_list where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_news_list where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=news&act=man_list&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit list */
	function get_list()
	{
		global $d, $strUrl, $func, $curPage, $item, $gallery, $type, $com;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_news_list where id = ? and type = ? limit 0,1",array($id,$type));
		
		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);

		/* Lấy hình ảnh con */
		$gallery = $d->rawQuery("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? order by stt,id desc",array($id,$com,$type,'man_list',$type));
	}

	/* Save list */
	function save_list()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
			else $data['tenkhongdauvi'] = (isset($data['tenvi'])) ? $func->changeTitle($data['tenvi']) : '';
			if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
			else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']) : '';
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['type'] = $type;
		}

		/* Post seo */
		if(isset($config['news'][$type]['seo_list']) && $config['news'][$type]['seo_list'] == true)
		{
			$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
			if($dataSeo)
			{
				foreach($dataSeo as $column => $value)
				{
					$dataSeo[$column] = htmlspecialchars($value);
				}
			}
		}

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_list'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_news_list where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_NEWS.$row['photo']);
				}
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('news_list',$data))
			{
				/* SEO */
				if(isset($config['news'][$type]['seo_list']) && $config['news'][$type]['seo_list'] == true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_list',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_list';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_list'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
				}
			}
			
			$data['ngaytao'] = time();
			
			if($d->insert('news_list',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(isset($config['news'][$type]['seo_list']) && $config['news'][$type]['seo_list'] == true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_list';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				/* Cập nhật hash khi upload multi */
				$hash = (isset($_POST['hash']) && $_POST['hash'] != '') ? addslashes($_POST['hash']) : null;
				if($hash)
				{
					$d->rawQuery("update #_gallery set hash = ?, id_photo = ? where hash = ?",array('',$id_insert,$hash));
				}

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete list */
	function delete_list()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_list',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_news_list where id = ? and type = ? limit 0,1",array($id,$type));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_NEWS.$row['photo']);
				$d->rawQuery("delete from #_news_list where id = ?",array($id));

				/* Xóa gallery */
				$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));

				if(count($row))
				{
					foreach($row as $v)
					{
						$func->delete_file(UPLOAD_NEWS.$v['photo']);
						$func->delete_file(UPLOAD_FILE.$v['taptin']);
					}

					$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));
				}

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_list',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_news_list where id = ? and type = ? limit 0,1",array($id,$type));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_NEWS.$row['photo']);
					$d->rawQuery("delete from #_news_list where id = ?",array($id));

					/* Xóa gallery */
					$row = $d->rawQuery("select id, photo, taptin from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));

					if(count($row))
					{
						foreach($row as $v)
						{
							$func->delete_file(UPLOAD_NEWS.$v['photo']);
							$func->delete_file(UPLOAD_FILE.$v['taptin']);
						}

						$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man_list',$com));
					}
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_list&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get cat */
	function get_cats()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;
		
		$where = "";
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;

		if($idlist) $where .= " and id_list=$idlist";
		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_news_cat where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_news_cat where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=news&act=man_cat".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit cat */
	function get_cat()
	{
		global $d, $strUrl, $func, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		
		$item = $d->rawQueryOne("select * from #_news_cat where id = ? and type = ? limit 0,1",array($id,$type));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Save cat */
	function save_cat()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
			else $data['tenkhongdauvi'] = (isset($data['tenvi'])) ? $func->changeTitle($data['tenvi']) : '';
			if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
			else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']) : '';
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['type'] = $type;
		}

		/* Post seo */
		if(isset($config['news'][$type]['seo_cat']) && $config['news'][$type]['seo_cat'] == true)
		{
			$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
			if($dataSeo)
			{
				foreach($dataSeo as $column => $value)
				{
					$dataSeo[$column] = htmlspecialchars($value);
				}
			}
		}

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_cat'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_news_cat where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_NEWS.$row['photo']);
				}
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('news_cat',$data))
			{
				/* SEO */
				if(isset($config['news'][$type]['seo_cat']) && $config['news'][$type]['seo_cat'] == true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_cat',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_cat';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_cat'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
				}
			}

			$data['ngaytao'] = time();
			
			if($d->insert('news_cat',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(isset($config['news'][$type]['seo_cat']) && $config['news'][$type]['seo_cat'] == true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_cat';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}
				$func->transfer("Lưu dữ liệu thành công", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete cat */
	function delete_cat()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_cat',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_news_cat where id = ? and type = ? limit 0,1",array($id,$type));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_NEWS.$row['photo']);
				$d->rawQuery("delete from #_news_cat where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_cat',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_news_cat where id = ? and type = ? limit 0,1",array($id,$type));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_NEWS.$row['photo']);
					$d->rawQuery("delete from #_news_cat where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_cat&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get item */
	function get_loais()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;
		
		$where = "";
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
		$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']) : 0;

		if($idlist) $where .= " and id_list=$idlist";
		if($idcat) $where .= " and id_cat=$idcat";
		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_news_item where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_news_item where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=news&act=man_item".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit item */
	function get_loai()
	{
		global $d, $strUrl, $func, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		
		$item = $d->rawQueryOne("select * from #_news_item where id = ? and type = ? limit 0,1",array($id,$type));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Save item */
	function save_loai()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
			else $data['tenkhongdauvi'] = (isset($data['tenvi'])) ? $func->changeTitle($data['tenvi']) : '';
			if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
			else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']) : '';
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['type'] = $type;
		}

		/* Post seo */
		if(isset($config['news'][$type]['seo_item']) && $config['news'][$type]['seo_item'] == true)
		{
			$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
			if($dataSeo)
			{
				foreach($dataSeo as $column => $value)
				{
					$dataSeo[$column] = htmlspecialchars($value);
				}
			}
		}

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_item'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_news_item where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_NEWS.$row['photo']);
				}
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('news_item',$data))
			{
				/* SEO */
				if(isset($config['news'][$type]['seo_item']) && $config['news'][$type]['seo_item'] == true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_item',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_item';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_item'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
				}
			}

			$data['ngaytao'] = time();
			
			if($d->insert('news_item',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(isset($config['news'][$type]['seo_item']) && $config['news'][$type]['seo_item'] == true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_item';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete item */
	function delete_loai()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_item',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_news_item where id = ? and type = ? limit 0,1",array($id,$type));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_NEWS.$row['photo']);
				$d->rawQuery("delete from #_news_item where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_item',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_news_item where id = ? and type = ? limit 0,1",array($id,$type));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_NEWS.$row['photo']);
					$d->rawQuery("delete from #_news_item where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_item&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Get sub */
	function get_subs()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $type;

		$where = "";	
		
		$idlist = (isset($_REQUEST['id_list'])) ? htmlspecialchars($_REQUEST['id_list']) : 0;
		$idcat = (isset($_REQUEST['id_cat'])) ? htmlspecialchars($_REQUEST['id_cat']) : 0;
		$iditem = (isset($_REQUEST['id_item'])) ? htmlspecialchars($_REQUEST['id_item']) : 0;

		if($idlist) $where .= " and id_list=$idlist";
		if($idcat) $where .= " and id_cat=$idcat";
		if($iditem) $where .= " and id_item=$iditem";
		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_news_sub where type = ? $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type));
		$sqlNum = "select count(*) as 'num' from #_news_sub where type = ? $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type));
		$total = $count['num'];
		$url = "index.php?com=news&act=man_sub".$strUrl."&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit sub */
	function get_sub()
	{
		global $d, $strUrl, $func, $curPage, $item, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_news_sub where id = ? and type = ? limit 0,1",array($id,$type));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
	}

	/* Save sub */
	function save_sub()
	{
		global $d, $strUrl, $func, $curPage, $config, $com, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
		
		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			if(isset($_POST['slugvi'])) $data['tenkhongdauvi'] = $func->changeTitle(htmlspecialchars($_POST['slugvi']));
			else $data['tenkhongdauvi'] = (isset($data['tenvi'])) ? $func->changeTitle($data['tenvi']) : '';
			if(isset($_POST['slugen'])) $data['tenkhongdauen'] = $func->changeTitle(htmlspecialchars($_POST['slugen']));
			else $data['tenkhongdauen'] = (isset($data['tenen'])) ? $func->changeTitle($data['tenen']) : '';
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['type'] = $type;
		}

		/* Post seo */
		if(isset($config['news'][$type]['seo_sub']) && $config['news'][$type]['seo_sub'] == true)
		{
			$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
			if($dataSeo)
			{
				foreach($dataSeo as $column => $value)
				{
					$dataSeo[$column] = htmlspecialchars($value);
				}
			}
		}

		$id = htmlspecialchars($_POST['id']);

		if($id)
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_sub'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_news_sub where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_NEWS.$row['photo']);
				}
			}

			$data['ngaysua'] = time();
			
			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('news_sub',$data))
			{
				/* SEO */
				if(isset($config['news'][$type]['seo_sub']) && $config['news'][$type]['seo_sub'] == true)
				{
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_sub',$type));

					$dataSeo['idmuc'] = $id;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_sub';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['news'][$type]['img_type_sub'], UPLOAD_NEWS,$file_name))
				{
					$data['photo'] = $photo;
				}
			}

			$data['ngaytao'] = time();
			
			if($d->insert('news_sub',$data))
			{
				$id_insert = $d->getLastInsertId();

				/* SEO */
				if(isset($config['news'][$type]['seo_sub']) && $config['news'][$type]['seo_sub'] == true)
				{
					$dataSeo['idmuc'] = $id_insert;
					$dataSeo['com'] = $com;
					$dataSeo['act'] = 'man_sub';
					$dataSeo['type'] = $type;
					$d->insert('seo',$dataSeo);
				}

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete sub */
	function delete_sub()
	{
		global $d, $strUrl, $func, $curPage, $com, $type;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			/* Xóa SEO */
			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_sub',$type));

			/* Lấy dữ liệu */
			$row = $d->rawQueryOne("select id, photo from #_news_sub where id = ? and type = ? limit 0,1",array($id,$type));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_NEWS.$row['photo']);
				$d->rawQuery("delete from #_news_sub where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,$com,'man_sub',$type));

				/* Lấy dữ liệu */
				$row = $d->rawQueryOne("select id, photo from #_news_sub where id = ? and type = ? limit 0,1",array($id,$type));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_NEWS.$row['photo']);
					$d->rawQuery("delete from #_news_sub where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_sub&type=".$type."&p=".$curPage.$strUrl, false);
	}
?>