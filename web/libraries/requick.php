<?php
	/* Request data */
	$com = (isset($_REQUEST['com'])) ? htmlspecialchars($_REQUEST['com']) : '';
	$act = (isset($_REQUEST['act'])) ? htmlspecialchars($_REQUEST['act']) : '';
	$type = (isset($_REQUEST['type'])) ? htmlspecialchars($_REQUEST['type']) : '';
	$kind = (isset($_REQUEST['kind'])) ? htmlspecialchars($_REQUEST['kind']) : '';
	$val = (isset($_REQUEST['val'])) ? htmlspecialchars($_REQUEST['val']) : '';
	$idc = (isset($_REQUEST['idc'])) ? htmlspecialchars($_REQUEST['idc']) : '';
	$id = (isset($_REQUEST['id'])) ? htmlspecialchars($_REQUEST['id']) : '';
	$curPage = (isset($_GET['p'])) ? htmlspecialchars($_GET['p']) : 1;
	if(isset($kind)) $dfgallery = ($kind == 'man_list') ? 'gallery_list' : 'gallery';
	else $dfgallery = '';

	/* Kiểm tra 2 máy đăng nhập cùng 1 tài khoản */
	if(array_key_exists($login_admin, $_SESSION) && (isset($_SESSION[$login_admin]['active']) || $_SESSION[$login_admin]['active'] == true))
	{
		$id_user = (int)$_SESSION[$login_admin]['id'];
		$timenow = time();

		$row = $d->rawQueryOne("select username, password, lastlogin, user_token from #_user WHERE id = ? limit 0,1",array($id_user));

		$sessionhash = md5(sha1($row['password'].$row['username']));
		
		if($_SESSION[$login_admin]['login_session'] != $sessionhash || ($timenow - $row['lastlogin']) > 3600)
		{
			session_destroy();
			$func->redirect("index.php?com=user&act=login");
		}

		if($_SESSION[$login_admin]['login_token'] !== $row['user_token']) $alertlogin = 'Có người đang đăng nhập tài khoản của bạn.';
		else $alertlogin ='';

		$token = md5(time());
		$_SESSION[$login_admin]['login_token'] = $token;

		/* Cập nhật lại thời gian hoạt động và token */
		$d->rawQuery("update #_user set lastlogin = ?, user_token = ? where id = ?",array($timenow,$token,$id_user));
	}

	/* Kiểm tra phân quyền */
	if(isset($config['permission']) && $config['permission'] == true && isset($_SESSION[$login_admin]['active']) && $_SESSION[$login_admin]['active'] == true)
	{
		if($func->check_permission())
		{
			$kiemtra = true;
			if( $act != 'save' && 
				$act != 'save_list' && 
				$act != 'save_cat' && 
				$act != 'save_item' && 
				$act != 'save_sub' &&
				$act != 'save_brand' &&
				$act != 'save_mau' &&
				$act != 'save_size' &&
				$act != 'saveImages' &&
				$act != 'uploadExcel' &&
				$act != 'save_static' &&
				$act != 'save_photo')
			{
				if($com != 'user') 
				{
					if($com != '' && $com != 'index')
					{
						if($type != '')
							$quyen_user = $com.'_'.$act.'_'.$type;
						else
							$quyen_user = $com.'_'.$act;

						if($quyen_user == '_'){
							$quyen_user=='';
						}
						if(isset($_SESSION['list_quyen']))
						{
							if(!in_array($quyen_user, $_SESSION['list_quyen']))
							{
								$func->transfer("Bạn không có quyền vào khu vực này","index.php", false);
								exit;
							}
						}
					}
				}
			}
		}
	}

	/* Kiểm tra đăng nhập */
	if($func->check_login() == false && $act != "login")
	{
		$func->redirect("index.php?com=user&act=login");
	}

	/* Delete gallery */
	$func->deleteGallery();

	/* Delete cache */
	$cacheAction = array(
		'save',
		'save_copy',
		'save_list',
		'save_cat',
		'save_item',
		'save_sub',
		'save_brand',
		'save_city',
		'save_district',
		'save_wards',
		'save_street',
		'capnhat',
		'delete',
		'delete_list',
		'delete_cat',
		'delete_item',
		'delete_sub',
		'delete_brand',
		'delete_city',
		'delete_district',
		'delete_wards',
		'delete_street'
	);
	if(isset($_POST) && isset($cacheAction) && count($cacheAction) > 0) 
	{
		if(in_array($act, $cacheAction))
		{
			$cache->DeleteCache();
		}
	}
	
	/* Include sources */
	if(file_exists(SOURCES.$com.'.php')) include SOURCES.$com.".php";
	else $template = "index";
?>