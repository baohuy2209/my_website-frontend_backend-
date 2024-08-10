<?php
	$linkMan = "index.php?com=places&act=man_wards&p=".$curPage;
	if($act=='add_wards') $linkFilter = "index.php?com=places&act=add_wards&p=".$curPage;
	else if($act=='edit_wards') $linkFilter = "index.php?com=places&act=edit_wards&id=".$id."&p=".$curPage;
    $linkSave = "index.php?com=places&act=save_wards&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết phường xã</li>
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
                <h3 class="card-title"><?=($act=="edit_wards")?"Cập nhật":"Thêm mới";?> phường xã</h3>
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
                </div>
				<div class="form-group">
					<label for="ten">Tiêu đề: <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Tiêu đề" value="<?=@$item['ten']?>" required>
				</div>
				<?php if(isset($config['places']['placesship']) && $config['places']['placesship'] == true) { ?>
			    	<div class="form-group">
						<label for="ten" class="d-block">Phí vận chuyển:</label>
						<input type="text" class="form-control format-price w-auto d-inline-block align-middle" name="data[gia]" id="gia" placeholder="Phí vận chuyển" value="<?=@$item['gia']?>" required>
						<span class="d-inline-block align-middle ml-1">VNĐ</span>
					</div>
			    <?php } ?>
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