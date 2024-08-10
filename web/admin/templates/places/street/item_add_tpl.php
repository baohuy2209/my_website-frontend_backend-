<?php
	$linkMan = "index.php?com=places&act=man_street&p=".$curPage;
	if($act=='add_street') $linkFilter = "index.php?com=places&act=add_street&p=".$curPage;
	else if($act=='edit_street') $linkFilter = "index.php?com=places&act=edit_street&id=".$id."&p=".$curPage;
    $linkSave = "index.php?com=places&act=save_street&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết đường phố</li>
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
                <h3 class="card-title"><?=($act=="edit_street")?"Cập nhật":"Thêm mới";?> đường phố</h3>
            </div>
            <div class="card-body">
            	<div class="form-group-category row">
                    <div class="form-group col-md-3 col-sm-4">
                        <label class="d-block" for="id_city">Danh sách tỉnh thành:</label>
                        <?=$func->get_ajax_place("city")?>
                    </div>
                    <div class="form-group col-md-3 col-sm-4">
                        <label class="d-block" for="id_district">Danh sách quận huyện:</label>
                        <?=$func->get_ajax_place("district")?>
                    </div>
                    <div class="form-group col-md-3 col-sm-4">
                        <label class="d-block" for="id_wards">Danh sách phường xã:</label>
                        <?=$func->get_ajax_place("wards")?>
                    </div>
                </div>
				<div class="form-group">
					<label for="ten">Tiêu đề: <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Tiêu đề" value="<?=@$item['ten']?>" required>
				</div>
				<div class="form-group">
					<label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
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