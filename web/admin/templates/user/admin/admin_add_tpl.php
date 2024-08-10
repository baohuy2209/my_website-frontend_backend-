<?php
	if(isset($_GET['changepass']) && ($_GET['changepass'] == 1)) $changepass = "&changepass=1";
	else $changepass = "";
    $linkSave = "index.php?com=user&act=admin_edit".$changepass;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Thông tin tài khoản</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin admin</h3>
            </div>
            <div class="card-body">
				<div class="row">
					<?php if(isset($changepass) && $changepass != '') { ?>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="old-password">Mật khẩu cũ:</label>
							<input type="password" class="form-control" name="old-password" id="old-password" placeholder="Mật khẩu cũ">
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="new-password">
								<span class="d-inline-block align-middle">Mật khẩu mới:</span>
								<span class="text-danger ml-2" id="show-password"></span>
							</label>
							<div class="row align-items-center">
								<div class="col-6"><input type="password" class="form-control" name="new-password" id="new-password" placeholder="Mật khẩu mới"></div>
								<div class="col-6"><a class="btn btn-sm bg-gradient-primary text-sm" href="#" onclick="randomPassword()"><i class="fas fa-random mr-2"></i>Tạo mật khẩu</a></div>
							</div>
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="renew-password">Nhập lại mật khẩu mới:</label>
							<input type="password" class="form-control" name="renew-password" id="renew-password" placeholder="Nhập lại mật khẩu mới">
						</div>
					<?php } else { ?>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="username">Tài khoản: <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="data[username]" id="username" placeholder="Tài khoản" value="<?=@$item['username']?>" <?=($act=="admin_edit")?'readonly':'';?> required>
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="ten">Họ tên: <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>" required>
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="email">Email:</label>
							<input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="dienthoai">Điện thoại:</label>
							<input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="gioitinh">Giới tính:</label>
							<select class="form-control" name="data[gioitinh]" id="gioitinh">
								<option value="0">Chọn giới tính</option>
								<option <?=(@$item['gioitinh']==1)?"selected":""?> value="1">Nam</option>
								<option <?=(@$item['gioitinh']==2)?"selected":""?> value="2">Nữ</option>
							</select>
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="ngaysinh">Ngày sinh:</label>
							<input type="text" class="form-control" name="data[ngaysinh]" id="ngaysinh" placeholder="Ngày sinh" value="<?=(@$item['ngaysinh'])?date('d/m/Y',@$item['ngaysinh']):"";?>" readonly>
						</div>
						<div class="form-group col-xl-4 col-lg-6 col-md-6">
							<label for="diachi">Địa chỉ:</label>
							<input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$item['diachi']?>">
						</div>
					<?php } ?>
				</div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>

<!-- User js -->
<script type="text/javascript">
	function randomPassword()
	{
		var chuoi = "";
		for(i=0;i<9;i++)
		{
			chuoi += "!@#$%^&*()?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".charAt(Math.floor(Math.random()*62));
		}
		jQuery('#new-password').val(chuoi);
		jQuery('#renew-password').val(chuoi);
		jQuery('#show-password').html(chuoi);
	}
	
	$(document).ready(function(){
	    $('#ngaysinh').datetimepicker({
	        timepicker: false,
	        format: 'd/m/Y',
	        formatDate: 'd/m/Y',
	        // minDate: '1950/01/01',
	        maxDate: '<?=date("Y/m/d",time())?>'
	    });
	});
</script>