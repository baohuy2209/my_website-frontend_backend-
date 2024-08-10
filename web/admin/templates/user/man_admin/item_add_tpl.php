<?php
    $linkMan = "index.php?com=user&act=man_admin&p=".$curPage;
    $linkSave = "index.php?com=user&act=save_admin&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết tài khoản admin</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> tài khoản</h3>
            </div>
            <div class="card-body">
            	<div class="row">
					<div class="form-group col-md-4">
						<?php if(isset($config['permission']) && $config['permission'] == true) { ?>
							<label for="permission">Danh sách nhóm quyền:</label>
							<?=$func->get_permission(@$item['id_nhomquyen'])?>
						<?php } ?>
					</div>
					<div class="form-group col-md-4">
						<label for="username">Tài khoản: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[username]" id="username" placeholder="Tài khoản" value="<?=@$item['username']?>" <?=($act=="edit")?'readonly':'';?> required>
					</div>
					<div class="form-group col-md-4">
						<label for="ten">Họ tên: <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="password">Mật khẩu:</label>
						<input type="password" class="form-control" name="data[password]" id="password" placeholder="Mật khẩu" <?=($act=="add_admin")?'required':'';?>>
					</div>
					<div class="form-group col-md-4">
						<label for="confirm_password">Nhập lại mật khẩu:</label>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu" <?=($act=="add_admin")?'required':'';?>>
					</div>
					<div class="form-group col-md-4">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="dienthoai">Điện thoại:</label>
						<input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
					</div>
					<div class="form-group col-md-4">
						<label for="gioitinh">Giới tính:</label>
						<select class="form-control" name="data[gioitinh]" id="gioitinh">
							<option value="0">Chọn giới tính</option>
							<option <?=(@$item['gioitinh']==1)?"selected":""?> value="1">Nam</option>
							<option <?=(@$item['gioitinh']==2)?"selected":""?> value="2">Nữ</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="ngaysinh">Ngày sinh:</label>
						<input type="text" class="form-control" name="data[ngaysinh]" id="ngaysinh" placeholder="Ngày sinh" value="<?=(@$item['ngaysinh'])?date('d/m/Y',@$item['ngaysinh']):"";?>" readonly>
					</div>
					<div class="form-group col-md-4">
						<label for="diachi">Địa chỉ:</label>
						<input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$item['diachi']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
					<div class="custom-control custom-checkbox d-inline-block align-middle">
                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                        <label for="hienthi-checkbox" class="custom-control-label"></label>
                    </div>
				</div>
				<div class="form-group">
					<label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
					<input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
				</div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>

<!-- User js -->
<script type="text/javascript">
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