<?php
	if(!defined('SOURCES')) die("Error");

	switch($act)
	{
		/* Login - logout - edit admin */
		case "login":
			if(isset($_SESSION[$login_admin]['active']) && $_SESSION[$login_admin]['active'] == true) $func->transfer("Trang không tồn tại", "index.php", false);
			else $template = "user/login";
			break;
		case "logout":
			logout();
			break;
		case "admin_edit":
			edit();
			$template = "user/admin/admin_add";
			break;

		/* Info admin */
		case "man_admin":
			/* Kiểm tra active user admin */
			if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			get_items_admin();
			$template = "user/man_admin/items";
			break;
		case "add_admin":
			/* Kiểm tra active user admin */
			if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			$template = "user/man_admin/item_add";
			break;
		case "edit_admin":
			/* Kiểm tra active user admin */
			if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			get_item_admin();
			$template = "user/man_admin/item_add";
			break;
		case "save_admin":
			/* Kiểm tra active user admin */
			if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			save_item_admin();
			break;
		case "delete_admin":
			/* Kiểm tra active user admin */
			if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			delete_item_admin();
			break;

		/* Info visitor */
		case "man":
			/* Kiểm tra active user visitor */
			if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			get_items();
			$template = "user/man/items";
			break;
		case "add":
			/* Kiểm tra active user visitor */
			if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			$template = "user/man/item_add";
			break;
		case "edit":
			/* Kiểm tra active user visitor */
			if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			get_item();
			$template = "user/man/item_add";
			break;
		case "save":
			/* Kiểm tra active user visitor */
			if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			save_item();
			break;
		case "delete":
			/* Kiểm tra active user visitor */
			if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			delete_item();
			break;
		
		/* Phân quyền */
		case "permission_group":
			/* Kiểm tra active phân quyền */
			if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			permission_groups();
			$template = "user/admin/permission_groups";
			break;
		case "add_permission_group":
			/* Kiểm tra active phân quyền */
			if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			$template = "user/admin/permission_group";
			break;
		case "edit_permission_group":
			/* Kiểm tra active phân quyền */
			if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			permission_group();
			$template = "user/admin/permission_group";
			break;
		case "save_permission_group":
			/* Kiểm tra active phân quyền */
			if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			save_permission_group();
			break;
		case "delete_permission_group":
			/* Kiểm tra active phân quyền */
			if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
			if($func->check_permission())
			{
				$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
				exit;
			}
			delete_permission_group();
			break;

		default:
			$template = "404";
	}

	/* Get phân quyền */
	function permission_groups()
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
		$sql = "select * from #_permission_group where id<>0 $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_permission_group where id<>0 $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=user&act=permission_group";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit phân quyền */
	function permission_group()
	{
		global $d, $func, $curPage, $item, $ds_quyen;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			/* Lấy nhóm quyền */
			$item = $d->rawQueryOne("select * from #_permission_group where id = ? limit 0,1",array($id));

			if(!isset($item['id'])) $func->transfer("Nhóm quyền này không tồn tại", "index.php?com=user&act=permission_group&p=".$curPage, false);

			/* Lấy quyền */
			$arr = $d->rawQuery("select ma,quyen from #_permission where ma_nhom_quyen = ?",array($id));

			if(!empty($arr)) foreach($arr as $quyen) $ds_quyen[] = $quyen['quyen'];
			else $ds_quyen[] = '';
		}
		else
		{
			$func->transfer("Nhóm quyền này không tồn tại", "index.php?com=user&act=permission_group&p=".$curPage, false);
		}
	}

	/* Save phân quyền */
	function save_permission_group()
	{
		global $d, $func, $curPage;

		$id = htmlspecialchars($_POST['id']);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		$dataQuyen = (isset($_POST['dataQuyen'])) ? $_POST['dataQuyen'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}
		}
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;

		if($id)
		{
			/* Kiểm tra nhóm quyền */
			$row = $d->rawQueryOne("select id from #_permission_group where id = ? limit 0,1",array($id));
			if(!isset($row['id'])) $func->transfer("Nhóm quyền này không tồn tại", "index.php?com=user&act=permission_group&p=".$curPage, false);

			/* Xử lý tham số bắt buộc */
			if(empty($_POST['dataQuyen'])) $func->transfer("Vui lòng chọn quyền cho nhóm này", "index.php?com=user&act=edit_permission_group&id=".$id."&p=".$curPage, false);

			/* Cập nhật thông tin nhóm quyền */
			$data['ngaysua'] = time();
			$d->where('id',$id);
			$d->update('permission_group',$data);

			/* Xóa hết các quyên hiện tại */
			$d->rawQuery("delete from #_permission where ma_nhom_quyen = ?",array($id));

			/* Thêm các quyền mới vào */
			if($dataQuyen)
			{
				for($i=0;$i<count($dataQuyen);$i++)
				{
					$data_permission['ma_nhom_quyen'] = $id;
					$data_permission['quyen'] = $dataQuyen[$i];
					$d->insert('permission',$data_permission);
				}
				$func->transfer("Cập nhật nhóm quyền thành công", "index.php?com=user&act=permission_group&p=".$curPage);
			}
			else
			{
				$func->transfer("Cập nhật nhóm quyền thất bại", "index.php?com=user&act=permission_group&p=".$curPage);
			}
		}
		else
		{
			/* Xử lý tham số bắt buộc */
			if(empty($_POST['dataQuyen'])) $func->transfer("Vui lòng chọn quyền cho nhóm này", "index.php?com=user&act=add_permission_group&p=".$curPage, false);

			/* Lưu thông tin nhóm quyền */
			$data['ngaytao'] = time();
			$d->insert('permission_group',$data);
			
			/* Lưu quyền cho nhóm quyền */
			if($dataQuyen)
			{
				$id_nhomquyen = $d->getLastInsertId();
				for($i=0;$i<count($dataQuyen);$i++)
				{
					$data_permission['ma_nhom_quyen'] = $id_nhomquyen;
					$data_permission['quyen'] = $dataQuyen[$i];
					$d->insert('permission',$data_permission);
				}
				$func->transfer("Tạo nhóm quyền thành công", "index.php?com=user&act=permission_group&p=".$curPage);
			}
			else
			{
				$func->transfer("Tạo nhóm quyền thất bại", "index.php?com=user&act=permission_group&p=".$curPage);
			}
		}
	}

	/* Delete phân quyền */
	function delete_permission_group()
	{
		global $d, $func, $curPage;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{	
			$row = $d->rawQuery("select * from #_permission_group where id = ?",array($id));

			if(count($row))
			{
				$d->rawQuery("delete from #_permission_group where id = ?",array($id));
				$row = $d->rawQuery("select * from #_permission where ma_nhom_quyen = ?",array($id));
				if(count($row)) $d->rawQuery("delete from #_permission where ma_nhom_quyen = ?",array($id));
				$row = $d->rawQuery("select * from #_user where id_nhomquyen = ?",array($id));

				if(count($row))
				{
					$data_user['id_nhomquyen'] = 0;
					$d->where('id_nhomquyen',$id);
					$d->update('user',$data_user);
				}
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=permission_group&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=user&act=permission_group&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQuery("select * from #_permission_group where id = ?",array($id));

				if(count($row))
				{
					$d->rawQuery("delete from #_permission_group where id = ?",array($id));
					$row = $d->rawQuery("select * from #_permission where ma_nhom_quyen = ?",array($id));
					if(count($row)) $d->rawQuery("delete from #_permission where ma_nhom_quyen = ?",array($id));
					$row = $d->rawQuery("select * from #_user where id_nhomquyen = ?",array($id));

					if(count($row))
					{
						$data_user['id_nhomquyen'] = 0;
						$d->where('id_nhomquyen',$id);
						$d->update('user',$data_user);
					}
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=permission_group&p=".$curPage);
		} 
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=permission_group&p=".$curPage, false);
	}

	/* Get admin */
	function get_items_admin()
	{
		global $d, $func, $curPage, $items, $paging, $config;

		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (username LIKE '%$keyword%' or ten LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_user where id <> 1 and (username <> 'coder') $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_user where id <> 1 and (username <> 'coder') $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=user&act=man_admin";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit admin */
	function get_item_admin()
	{
		global $d, $func, $curPage, $item;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin&p=".$curPage, false);
		
		$item = $d->rawQueryOne("select * from #_user where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=man_admin&p=".$curPage, false);
	}

	/* Save admin */
	function save_item_admin()
	{
		global $d, $func, $curPage, $config;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin&p=".$curPage, false);
		
		$id = htmlspecialchars($_POST['id']);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		if($id)
		{
			if($func->check_permission())
			{
				$row = $d->rawQueryOne("select id from #_user where id = ? limit 0,1",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->transfer("Bạn không có quyền trên tài khoản này. Mọi thắc mắc xin liên hệ quản trị website", "index.php?com=user&act=man_admin&p=".$curPage, false);
			}
			
			if(isset($data['password']) && ($data['password'] != ''))
			{
				$password = $data['password'];
				$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

				if($confirm_password=='')
				{
					$func->transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=edit_admin&id=".$id."&p=".$curPage, false);
				}

				if($password!=$confirm_password)
				{
					$func->transfer("Xác nhận mật khẩu mới không chính xác","index.php?com=user&act=edit_admin&id=".$id."&p=".$curPage, false);
				}

				$data['password'] = md5($config['website']['secret'].$password.$config['website']['salt']);
			}
			else unset($data['password']);
			
			$d->where('id', $id);
			if($d->update('user',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=man_admin&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man_admin&p=".$curPage, false);
		}
		else
		{
			$username = isset($data['username']) ? $data['username'] : '';
			$row = $d->rawQueryOne("select id from #_user where username = ? limit 0,1",array($username));
			if(isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập nay đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=man_admin&p=".$curPage, false);
			
			if(isset($data['password']) && ($data['password'] == '')) $func->transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add_admin&p=".$curPage, false);
			$data['password'] = md5($config['website']['secret'].$data['password'].$config['website']['salt']);
			
			if($d->insert('user',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=man_admin&p=".$curPage);
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man_admin", false);
		}
	}

	/* Delete admin */
	function delete_item_admin()
	{
		global $d, $func, $curPage;
		
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$d->rawQuery("delete from #_user where id = ?",array($id));
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=man_admin&p=".$curPage);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$d->rawQuery("delete from #_user where id = ?",array($id));
			}

			$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=man_admin&p=".$curPage);
		}
		$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin&p=".$curPage, false);
	}

	/* Get visitor */
	function get_items()
	{
		global $d, $func, $curPage, $items, $paging, $config;

		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (username LIKE '%$keyword%' or ten LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_member where id <> 0 $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_member where id <> 0 $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=user&act=man";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit visitor */
	function get_item()
	{
		global $d, $func, $curPage, $item;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
		
		$item = $d->rawQueryOne("select * from #_member where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=man&p=".$curPage, false);
	}

	/* Save visitor */
	function save_item()
	{
		global $d, $func, $curPage;
		
		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);

		$id = htmlspecialchars($_POST['id']);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		if($id)
		{
			if($func->check_permission())
			{
				$row = $d->rawQueryOne("select id from #_member where id = ? limit 0,1",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->transfer("Bạn không có quyền trên tài khoản này. Mọi thắc mắc xin liên hệ quản trị website", "index.php?com=user&act=man&p=".$curPage, false);
			}
			
			if(isset($data['password']) && ($data['password'] != ''))
	        {
	            $password = $data['password'];
	            $confirm_password = (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] : '';

	            if($confirm_password == '')
	            {
	                $func->transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=edit&id=".$id."&p=".$curPage, false);
	            }

	            if($password != $confirm_password)
	            {
	                $func->transfer("Xác nhận mật khẩu mới không chính xác","index.php?com=user&act=edit&id=".$id."&p=".$curPage, false);
	            }

	            $data['password'] = md5($password);
	        }
	        else unset($data['password']);
			
			$d->where('id', $id);
			if($d->update('member',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=man&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man&p=".$curPage, false);
		}
		else
		{
			$username = isset($data['username']) ? $data['username'] : '';
			$row = $d->rawQueryOne("select id from #_user where username = ? limit 0,1",array($username));
			if(isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập nay đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=edit&id=".$id."&p=".$curPage, false);
			
			if(isset($data['password']) && ($data['password'] == '')) $func->transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add&p=".$curPage, false);
			$data['password'] = md5($data['password']);
			
			if($d->insert('member',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=man&p=".$curPage);
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man&p=".$curPage, false);
		}
	}

	/* Delete visitor */
	function delete_item()
	{
		global $d, $func, $curPage;
		
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$d->rawQuery("delete from #_member where id = ?",array($id));
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=man&p=".$curPage);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$d->rawQuery("delete from #_member where id = ?",array($id));
			}

			$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=man&p=".$curPage);
		}
		$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man&p=".$curPage, false);
	}

	/* Edit admin */
	function edit()
	{
		global $d, $func, $curPage, $item, $config, $login_admin;
		
		if(isset($_GET['changepass']) && ($_GET['changepass'] == 1)) $changepass = 1;
		else $changepass = 0;

		if(!empty($_POST))
		{
			/* Post dữ liệu */
			$data = (isset($_POST['data'])) ? $_POST['data'] : null;
			if($data)
			{
				foreach($data as $column => $value)
				{
					$data[$column] = htmlspecialchars($value);
				}
			}

			if(isset($changepass) && $changepass == 1)
			{
				$old_pass = (isset($_POST['old-password'])) ? htmlspecialchars($_POST['old-password']) : '';
				$new_pass = (isset($_POST['new-password'])) ? htmlspecialchars($_POST['new-password']) : '';
				$renew_pass = (isset($_POST['renew-password'])) ? htmlspecialchars($_POST['renew-password']) : '';

				if($old_pass!='' || $new_pass!='' ||  $renew_pass!='')
				{
					if($old_pass=='') $func->transfer("Mật khẩu cũ chưa nhập","index.php?com=user&act=admin_edit&changepass=1", false);
					if($new_pass=='') $func->transfer("Mật khẩu mới chưa nhập","index.php?com=user&act=admin_edit&changepass=1", false);
					if($renew_pass=='') $func->transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=admin_edit&changepass=1", false);

					/* Lấy dữ liệu */
					$row = $d->rawQueryOne("select id, password from #_user where username = ? limit 0,1",array($_SESSION[$login_admin]['username']));

					if(isset($row['id']) && $row['id'] > 0)
					{
						if($row['password'] != md5($config['website']['secret'].$old_pass.$config['website']['salt'])) $func->transfer("Mật khẩu không chính xác","index.php?com=user&act=admin_edit&changepass=1", false);
					}
					else
					{
						$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&changepass=1", false);
					}

					if($new_pass!="")
					{
						if($new_pass=='123qwe' || $new_pass=='123456' || $new_pass=='ninaco') $func->transfer("Mật khẩu bạn đặt quá đơn giãn, xin vui lòng chọn mật khẩu khác","index.php?com=user&act=admin_edit&changepass=1", false);			
						$data['password'] = md5($config['website']['secret'].$new_pass.$config['website']['salt']);
						$flagchangepass = true;
					}
				}
				else
				{
					$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&changepass=1", false);
				}
			}
			else
			{
				$username = $data['username'];
				$row = $d->rawQueryOne("select id from #_user where username <> ? and username = ? limit 0,1",array($_SESSION[$login_admin]['username'],$username));
				if(isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập này đã tồn tại","index.php?com=user&act=admin_edit", false);

				$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
			}
			
			$d->where('username', $_SESSION[$login_admin]['username']);
			if($d->update('user',$data))
			{
				if(isset($flagchangepass) && $flagchangepass == true)
				{
					session_unset();
					$func->transfer("Cập nhật dữ liệu thành công","index.php");	
				}
				$func->transfer("Cập nhật dữ liệu thành công","index.php?com=user&act=admin_edit");
			}
			else
			{
				$func->transfer("Cập nhật dữ liệu bị lỗi","index.php?com=user&act=admin_edit");
			}
		}
		
		$item = $d->rawQueryOne("select * from #_user where username = ? limit 0,1",array($_SESSION[$login_admin]['username']));
	}

	/* Logout admin */
	function logout()
	{
		global $d, $func, $login_admin;

		/* Hủy bỏ quyền */
		$data_capnhatquyen['quyen'] = '';
		$d->where('id',$_SESSION[$login_admin]['id']);
		$d->update('user',$data_capnhatquyen);

		/* Hủy bỏ login */
		unset($_SESSION[$login_admin]);
		unset($_SESSION['list_quyen']);
		$func->redirect("index.php?com=user&act=login");
	}
?>