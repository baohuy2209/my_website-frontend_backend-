<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active photo */
	if(isset($config['photo']))
	{
		$arrCheck = array();
		$actCheck = '';
		if($act=='photo_static' || $act=='save_static' || $act=='save-watermark' || $act=='preview-watermark') $actCheck = 'photo_static';
		else $actCheck = 'man_photo';
		foreach($config['photo'][$actCheck] as $k => $v) $arrCheck[] = $k;
		if(!count($arrCheck) || !in_array($type,$arrCheck)) $func->transfer("Trang không tồn tại", "index.php", false);
	}
	else
	{
		$func->transfer("Trang không tồn tại", "index.php", false);
	}

	switch($act)
	{
		/* Photo static */
		case "photo_static":
			get_photo_static();
			$template = "photo/static/photo_static";
			break;
		case "save_static":
			save_static();
			break;

		/* Watermark */
		case "save-watermark":
			saveWatermark();
			break;
		case "preview-watermark":
			previewWatermark();
			break;

		/* Photos */
		case "man_photo":
			get_photos();
			$template = "photo/man/photos";
			break;
		case "add_photo":
			$template = "photo/man/photo_add";
			break;
		case "edit_photo":
			get_photo();
			$template = "photo/man/photo_edit";
			break;
		case "save_photo":
			save_photo();
			break;
		case "delete_photo":
			delete_photo();
			break;

		default:
			$template = "404";
	}

	/* Save watermark */
	function saveWatermark()
	{
		global $d, $func, $config, $type;

		if(isset($_POST['data']))
		{
			parse_str(urldecode($_POST['data']), $data);
			$upload = false;
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				$photo = $func->uploadImage("file", $config['photo']['photo_static'][$type]['img_type'], UPLOAD_TEMP, "tmp");
				$upload = true;
				$path = UPLOAD_TEMP.$photo;
			}
			else
			{
				$item = $d->rawQueryOne("select * from #_photo where act = ? and type = ? limit 0,1",array('photo_static',$type));
				$path = UPLOAD_PHOTO.$item['photo'];
			}
		}

		echo json_encode(
			array(
				"path" => $path,
				"upload" => $upload,
				"data" => $data['data']['options']['watermark'],
				"position" => $data['data']['options']['watermark']['position'],
				"image" => "../assets/images/preview-watermark.jpg"
			)
		);

		exit;
	}

	/* Preview watermark */
	function previewWatermark()
	{
		global $func;
		$func->createThumb(500,0,1,$_GET['img'],null,"preview",true,$_GET);
	}

	/* Get photo static */
	function get_photo_static()
	{
		global $d, $item, $type;

		$item = $d->rawQueryOne("select * from #_photo where act = ? and type = ? limit 0,1",array('photo_static',$type));
	}

	/* Save photo static */
	function save_static()
	{
		global $d, $func, $config, $type;

		$row = $d->rawQueryOne("select id, options from #_photo where act = ? and type = ? limit 0,1",array('photo_static',$type));
		$id = (isset($row['id']) && $row['id'] > 0) ? $row['id'] : 0;
		$option = (isset($row['options']) && $row['options'] != '') ? json_decode($row['options'],true) : null;

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
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		$data['type'] = $type;
		$data['act'] = 'photo_static';

		/* Xóa cache watermark */
		if(isset($config['photo']['photo_static'][$type]['watermark']) && $config['photo']['photo_static'][$type]['watermark'] == true)
		{
			$func->removeDir(WATERMARK);
			$func->RemoveFilesFromDirInXSeconds(UPLOAD_TEMP, 1);
		}

		if($id)
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['photo']['photo_static'][$type]['img_type'], UPLOAD_PHOTO, $file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_photo where id = ? and act = ? and type = ? limit 0,1",array($id,'photo_static',$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PHOTO.$row['photo']);
				}
			}

			$data['ngaysua'] = time();

			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('photo',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=photo&act=photo_static&type=".$type);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=photo_static&type=".$type, false);
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", $config['photo']['photo_static'][$type]['img_type'], UPLOAD_PHOTO, $file_name))
				{
					$data['photo'] = $photo;
				}
			}

			$data['ngaytao'] = time();

			if((isset($data['photo']) && $data['photo'] != '') || (isset($data['link_video']) && $data['link_video'] != ''))
			{
				if($d->insert('photo',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=photo&act=photo_static&type=".$type);
				else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=photo&act=photo_static&type=".$type, false);	
			}
			else
			{
				$func->transfer("Dữ liệu rỗng", "index.php?com=photo&act=photo_static&type=".$type, false);
			}
		}
	}

	/* Get photo */
	function get_photos()
	{
		global $d, $func, $curPage, $items, $paging, $type;

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_photo where type = ? and act <> ? order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($type,'photo_static'));
		$sqlNum = "select count(*) as 'num' from #_photo where type = ? and act <> ? order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($type,'photo_static'));
		$total = $count['num'];
		$url = "index.php?com=photo&act=man_photo&type=".$type;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit photo */
	function get_photo()
	{
		global $d, $func, $curPage, $item, $list_cat, $type;
		
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_photo where id = ? and act <> ? and type = ? limit 0,1",array($id,'photo_static',$type));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);
	}

	/* Save photo */
	function save_photo()
	{
		global $d, $func, $curPage, $config, $type;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		$dataMultiTemp = (isset($_POST['dataMulti'])) ? $_POST['dataMulti'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}
		}

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", $config['photo']['man_photo'][$type]['img_type_photo'], UPLOAD_PHOTO,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_photo where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PHOTO.$row['photo']);
				}
			}
			
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['act'] = 'photo_multi';

			$d->where('id', $id);
			$d->where('type', $type);
			if($d->update('photo',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);
		}
		else
		{
			$numberPhoto = (isset($config['photo']['man_photo'][$type]['number_photo'])) ? $config['photo']['man_photo'][$type]['number_photo'] : 0;

			if($numberPhoto && $dataMultiTemp)
			{
				$success = 0;

				for($i=0;$i<count($dataMultiTemp);$i++)
				{
					$success_photo = 0;
					$success_video = 0;
					$success_link = 0;
					$dataMulti = $dataMultiTemp[$i];
					$dataMulti['hienthi'] = (isset($dataMultiTemp[$i]['hienthi'])) ? 1 : 0;
					$dataMulti['type'] = $type;
					$dataMulti['act'] = 'photo_multi';

					if(isset($config['photo']['man_photo'][$type]['images_photo']) && $config['photo']['man_photo'][$type]['images_photo'] == true)
					{
						if(isset($_FILES["file".$i]))
						{
							$file_name = $func->uploadName($_FILES["file".$i]["name"]);
							if($photo = $func->uploadImage("file".$i, $config['photo']['man_photo'][$type]['img_type_photo'], UPLOAD_PHOTO,$file_name.$i))
							{
								$success_photo = 1;
								$dataMulti['photo'] = $photo;
							}
						}
					}

					if(isset($config['photo']['man_photo'][$type]['video_photo']) && $config['photo']['man_photo'][$type]['video_photo'] == true)
					{
						if(!empty($dataMulti['link_video']))
						{
							$success_video = 1;
						}
					}

					if(isset($config['photo']['man_photo'][$type]['link_only']) && $config['photo']['man_photo'][$type]['link_only'] == true)
					{
						if(!empty($dataMulti['link']) && $dataMulti['link']!='')
						{
							$success_link = 1;
						}
					}


					if($success_photo || $success_video || $success_link)
					{
						if($d->insert('photo',$dataMulti))
						{
							$success = 1;
						}
						else
						{
							$func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);
						}
					}
				}

				if($success == 0)
				{
					$func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);
				}
				else
				{
					$func->transfer("Lưu dữ liệu thành công", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage);
				}
			}
			$func->transfer("Dữ liệu rỗng", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);
		}
	}

	/* Delete photo */
	function delete_photo()
	{
		global $d, $func, $curPage, $type;
		
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id, photo from #_photo where id = ? and type = ? limit 0,1",array($id,$type));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_PHOTO.$row['photo']);
				$d->rawQuery("delete from #_photo where id = ? and type = ?",array($id,$type));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, photo from #_photo where id = ? and type = ? limit 0,1",array($id,$type));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_PHOTO.$row['photo']);
					$d->rawQuery("delete from #_photo where id = ? and type = ?",array($id,$type));
				}
			}
			
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage, false);
	}
?>