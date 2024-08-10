<?php
    $linkMan = "index.php?com=user&act=permission_group&p=".$curPage;
    $linkSave = "index.php?com=user&act=save_permission_group&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?=($act=="edit_permission_group")?"Cập nhật":"Thêm mới";?> nhóm quyền</li>
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
                <h3 class="card-title">Thông tin chính</h3>
            </div>
            <div class="card-body">
				<div class="form-group">
					<label for="ten">Tên nhóm quyền: <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Tên nhóm quyền" value="<?=@$item['ten']?>" required>
				</div>
				<div class="form-group">
					<label class="d-inline-block align-middle mb-0" for="ten">Chọn tất cả:</label>
					<div class="custom-control custom-checkbox d-inline-block align-middle ml-2">
                        <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                        <label for="selectall-checkbox" class="custom-control-label"></label>
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
        <?php if(isset($config['product'])) { ?>
			<?php foreach($config['product'] as $key => $value) { ?>
			    <div class="card card-permission card-primary card-outline text-sm">
		            <div class="card-header">
		                <h3 class="card-title">Quản lý <?=$value['title_main']?></h3>
		                <div class="card-tools">
		                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		            </div>
		            <div class="card-body">
	            		<?php if(isset($value['list']) && $value['list'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-list-<?=$key?>">Danh mục cấp 1:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-list-view-<?=$key?>" value="product_man_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-list-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-list-add-<?=$key?>" value="product_add_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-list-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-list-edit-<?=$key?>" value="product_edit_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-list-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-list-delete-<?=$key?>" value="product_delete_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-list-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['cat']) && $value['cat'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-cat-<?=$key?>">Danh mục cấp 2:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-cat-view-<?=$key?>" value="product_man_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-cat-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-cat-add-<?=$key?>" value="product_add_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-cat-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-cat-edit-<?=$key?>" value="product_edit_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-cat-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-cat-delete-<?=$key?>" value="product_delete_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-cat-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['item']) && $value['item'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-item-<?=$key?>">Danh mục cấp 3:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-item-view-<?=$key?>" value="product_man_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-item-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-item-add-<?=$key?>" value="product_add_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-item-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-item-edit-<?=$key?>" value="product_edit_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-item-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-item-delete-<?=$key?>" value="product_delete_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-item-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['sub']) && $value['sub'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-sub-<?=$key?>">Danh mục cấp 4:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-sub-view-<?=$key?>" value="product_man_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_sub_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-sub-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-sub-add-<?=$key?>" value="product_add_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_sub_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-sub-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-sub-edit-<?=$key?>" value="product_edit_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_sub_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-sub-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-sub-delete-<?=$key?>" value="product_delete_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_sub_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-sub-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
		            	<?php if(isset($value['brand']) && $value['brand'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-brand-<?=$key?>">Danh mục hãng:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-brand-view-<?=$key?>" value="product_man_brand_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_brand_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-brand-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-brand-add-<?=$key?>" value="product_add_brand_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_brand_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-brand-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-brand-edit-<?=$key?>" value="product_edit_brand_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_brand_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-brand-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-brand-delete-<?=$key?>" value="product_delete_brand_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_brand_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-brand-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
		            	<?php } ?>
		            	<?php if(isset($value['mau']) && $value['mau'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-mau-<?=$key?>">Danh mục màu sắc:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-mau-view-<?=$key?>" value="product_man_mau_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_mau_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-mau-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-mau-add-<?=$key?>" value="product_add_mau_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_mau_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-mau-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-mau-edit-<?=$key?>" value="product_edit_mau_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_mau_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-mau-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-mau-delete-<?=$key?>" value="product_delete_mau_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_mau_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-mau-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
		            	<?php } ?>
		            	<?php if(isset($value['size']) && $value['size'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-size-<?=$key?>">Danh mục kích thước:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-size-view-<?=$key?>" value="product_man_size_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_size_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-size-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-size-add-<?=$key?>" value="product_add_size_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_size_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-size-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-size-edit-<?=$key?>" value="product_edit_size_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_size_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-size-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-size-delete-<?=$key?>" value="product_delete_size_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_size_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-size-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
		            	<?php } ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-<?=$key?>"><?=$value['title_main']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-view-<?=$key?>" value="product_man_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-product-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-add-<?=$key?>" value="product_add_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-product-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-edit-<?=$key?>" value="product_edit_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-product-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-delete-<?=$key?>" value="product_delete_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-product-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
			                    </div>
							</div>
						</div>
						<?php if(isset($value['gallery']) && count($value['gallery']) > 0) { ?>
							<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-photo-<?=$key?>"><?=$value['title_main']?> <span class="font-weight-normal">(Hình ảnh)</span>:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-photo-view-<?=$key?>" value="product_man_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_man_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-photo-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-photo-add-<?=$key?>" value="product_add_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_add_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-photo-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-photo-edit-<?=$key?>" value="product_edit_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_edit_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-photo-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-photo-delete-<?=$key?>" value="product_delete_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('product_delete_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-photo-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['import']) && $value['import'] == true) { ?>
							<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-import-<?=$key?>">Import:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-import-man-<?=$key?>" value="import_man_<?=$key?>" <?=(isset($ds_quyen) && in_array('import_man_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-import-man-<?=$key?>" class="custom-control-label font-weight-normal">Upload danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-import-editImages-<?=$key?>" value="import_editImages_<?=$key?>" <?=(isset($ds_quyen) && in_array('import_editImages_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-import-editImages-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa hình ảnh</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-import-deleteImages-<?=$key?>" value="import_deleteImages_<?=$key?>" <?=(isset($ds_quyen) && in_array('import_deleteImages_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-import-deleteImages-<?=$key?>" class="custom-control-label font-weight-normal">Xóa hình ảnh</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['export']) && $value['export'] == true) { ?>
							<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-product-export-<?=$key?>">Export:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-product-export-<?=$key?>" value="export_man_<?=$key?>" <?=(isset($ds_quyen) && in_array('export_man_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-product-export-<?=$key?>" class="custom-control-label font-weight-normal">Export danh sách</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
	            	</div>
		        </div>
			<?php } ?>
		<?php } ?>
        <?php if(isset($config['news'])) { ?>
        	<?php foreach($config['news'] as $key => $value) { if(isset($value['dropdown']) && $value['dropdown'] == true) { ?>
				<div class="card card-permission card-primary card-outline text-sm">
		            <div class="card-header">
		                <h3 class="card-title">Quản lý <?=$value['title_main']?></h3>
		                <div class="card-tools">
		                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		            </div>
		            <div class="card-body">
	            		<?php if(isset($value['list']) && $value['list'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-list-<?=$key?>">Danh mục cấp 1:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-list-view-<?=$key?>" value="news_man_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-list-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-list-add-<?=$key?>" value="news_add_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-list-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-list-edit-<?=$key?>" value="news_edit_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-list-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-list-delete-<?=$key?>" value="news_delete_list_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_list_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-list-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['cat']) && $value['cat'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-cat-<?=$key?>">Danh mục cấp 2:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-cat-view-<?=$key?>" value="news_man_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-cat-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-cat-add-<?=$key?>" value="news_add_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-cat-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-cat-edit-<?=$key?>" value="news_edit_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-cat-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-cat-delete-<?=$key?>" value="news_delete_cat_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_cat_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-cat-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['item']) && $value['item'] == true) { ?>
		            		<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-item-<?=$key?>">Danh mục cấp 3:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-item-view-<?=$key?>" value="news_man_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-item-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-item-add-<?=$key?>" value="news_add_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-item-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-item-edit-<?=$key?>" value="news_edit_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-item-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-item-delete-<?=$key?>" value="news_delete_item_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_item_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-item-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
						<?php if(isset($value['sub']) && $value['sub'] == true) { ?>
							<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-sub-<?=$key?>">Danh mục cấp 4:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
						                <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-sub-view-<?=$key?>" value="news_man_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_sub_'.$key, $ds_quyen))?'checked':'';?>>
						                <label for="quyen-news-sub-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
						            </div>
						            <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
						                <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-sub-add-<?=$key?>" value="news_add_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_sub_'.$key, $ds_quyen))?'checked':'';?>>
						                <label for="quyen-news-sub-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
						            </div>
						            <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
						                <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-sub-edit-<?=$key?>" value="news_edit_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_sub_'.$key, $ds_quyen))?'checked':'';?>>
						                <label for="quyen-news-sub-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
						            </div>
						            <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
						                <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-sub-delete-<?=$key?>" value="news_delete_sub_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_sub_'.$key, $ds_quyen))?'checked':'';?>>
						                <label for="quyen-news-sub-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
						            </div>
								</div>
							</div>
						<?php } ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-<?=$key?>"><?=$value['title_main']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-view-<?=$key?>" value="news_man_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-add-<?=$key?>" value="news_add_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-edit-<?=$key?>" value="news_edit_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-delete-<?=$key?>" value="news_delete_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
			                    </div>
							</div>
						</div>
						<?php if(isset($value['gallery']) && count($value['gallery']) > 0) { ?>
							<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-photo-<?=$key?>"><?=$value['title_main']?> <span class="font-weight-normal">(Hình ảnh)</span>:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-view-<?=$key?>" value="news_man_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-add-<?=$key?>" value="news_add_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-edit-<?=$key?>" value="news_edit_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-delete-<?=$key?>" value="news_delete_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
		            </div>
		        </div>
	        <?php } } ?>
		<?php } ?>
        <?php if(isset($config['shownews']) && $config['shownews'] == true) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý bài viết</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
	            	<?php foreach($config['news'] as $key => $value) { if(!isset($value['dropdown']) || $value['dropdown'] == false) { ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-<?=$key?>"><?=$value['title_main']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-view-<?=$key?>" value="news_man_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-add-<?=$key?>" value="news_add_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-edit-<?=$key?>" value="news_edit_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-delete-<?=$key?>" value="news_delete_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-news-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
			                    </div>
							</div>
						</div>
						<?php if(isset($value['gallery']) && count($value['gallery']) > 0) { ?>
							<div class="form-group row">
								<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-news-photo-<?=$key?>"><?=$value['title_main']?> <span class="font-weight-normal">(Hình ảnh)</span>:</label>
								<div class="col-md-7">
									<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-view-<?=$key?>" value="news_man_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_man_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-add-<?=$key?>" value="news_add_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_add_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-edit-<?=$key?>" value="news_edit_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_edit_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
				                    </div>
				                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
				                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-news-photo-delete-<?=$key?>" value="news_delete_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('news_delete_photo_'.$key, $ds_quyen))?'checked':'';?>>
				                        <label for="quyen-news-photo-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
				                    </div>
								</div>
							</div>
						<?php } ?>
					<?php } } ?>
	            </div>
	        </div>
		<?php } ?>
        <?php if(isset($config['photo'])) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý hình ảnh - video</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
	            	<?php if(isset($config['photo']['photo_static'])) { foreach($config['photo']['photo_static'] as $key => $value) { ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-photo-static-<?=$key?>"><?=$value['title_main']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-photo-static-<?=$key?>" value="photo_photo_static_<?=$key?>" <?=(isset($ds_quyen) && in_array('photo_photo_static_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-photo-static-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
			                </div>
						</div>
					<?php } } ?>
	            	<?php if(isset($config['photo']['man_photo'])) { foreach($config['photo']['man_photo'] as $key => $value) { ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-man-photo-<?=$key?>"><?=$value['title_main_photo']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-man-photo-view-<?=$key?>" value="photo_man_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('photo_man_photo_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-man-photo-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-man-photo-add-<?=$key?>" value="photo_add_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('photo_add_photo_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-man-photo-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-man-photo-edit-<?=$key?>" value="photo_edit_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('photo_edit_photo_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-man-photo-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-man-photo-delete-<?=$key?>" value="photo_delete_photo_<?=$key?>" <?=(isset($ds_quyen) && in_array('photo_delete_photo_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-man-photo-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
			                    </div>
							</div>
						</div>
					<?php } } ?>
	            </div>
	        </div>
		<?php } ?>
		<?php if(isset($config['order']['active']) && $config['order']['active'] == true) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý đơn hàng</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
					<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-order-view" value="order_man" <?=(isset($ds_quyen) && in_array('order_man', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-order-view" class="custom-control-label font-weight-normal">Xem danh sách</label>
                    </div>
                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-order-edit" value="order_edit" <?=(isset($ds_quyen) && in_array('order_edit', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-order-edit" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
                    </div>
                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-order-delete" value="order_delete" <?=(isset($ds_quyen) && in_array('order_delete', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-order-delete" class="custom-control-label font-weight-normal">Xóa</label>
                    </div>
	            </div>
	        </div>
		<?php } ?>
		<?php if(isset($config['tags'])) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý tags</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
	            	<?php foreach($config['tags'] as $key => $value) { ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-tags-<?=$key?>"><?=$value['title_main']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-tags-view-<?=$key?>" value="tags_man_<?=$key?>" <?=(isset($ds_quyen) && in_array('tags_man_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-tags-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-tags-add-<?=$key?>" value="tags_add_<?=$key?>" <?=(isset($ds_quyen) && in_array('tags_add_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-tags-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-tags-edit-<?=$key?>" value="tags_edit_<?=$key?>" <?=(isset($ds_quyen) && in_array('tags_edit_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-tags-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-tags-delete-<?=$key?>" value="tags_delete_<?=$key?>" <?=(isset($ds_quyen) && in_array('tags_delete_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-tags-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
			                    </div>
							</div>
						</div>
					<?php } ?>
	            </div>
	        </div>
		<?php } ?>
        <?php if(isset($config['newsletter'])) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý nhận tin</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
	            	<?php foreach($config['newsletter'] as $key => $value) { ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-email-<?=$key?>"><?=$value['title_main']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-email-view-<?=$key?>" value="newsletter_man_<?=$key?>" <?=(isset($ds_quyen) && in_array('newsletter_man_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-email-view-<?=$key?>" class="custom-control-label font-weight-normal">Xem danh sách</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-email-add-<?=$key?>" value="newsletter_add_<?=$key?>" <?=(isset($ds_quyen) && in_array('newsletter_add_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-email-add-<?=$key?>" class="custom-control-label font-weight-normal">Thêm mới</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-email-edit-<?=$key?>" value="newsletter_edit_<?=$key?>" <?=(isset($ds_quyen) && in_array('newsletter_edit_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-email-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
			                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-email-delete-<?=$key?>" value="newsletter_delete_<?=$key?>" <?=(isset($ds_quyen) && in_array('newsletter_delete_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-email-delete-<?=$key?>" class="custom-control-label font-weight-normal">Xóa</label>
			                    </div>
							</div>
						</div>
					<?php } ?>
	            </div>
	        </div>
		<?php } ?>
        <?php if(isset($config['static'])) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý trang tĩnh</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
	            	<?php foreach($config['static'] as $key => $value) { ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-static-<?=$key?>"><?=$value['title_main']?>:</label>
							<div class="col-md-7">
								<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
			                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-static-edit-<?=$key?>" value="static_capnhat_<?=$key?>" <?=(isset($ds_quyen) && in_array('static_capnhat_'.$key, $ds_quyen))?'checked':'';?>>
			                        <label for="quyen-static-edit-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
			                    </div>
							</div>
						</div>
					<?php } ?>
	            </div>
	        </div>
		<?php } ?>
        <?php if(isset($config['places']['active']) && $config['places']['active'] == true) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý địa điểm</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
					<div class="form-group row">
						<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-places-city">Tỉnh thành:</label>
						<div class="col-md-7">
							<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-city-view" value="places_man_city" <?=(isset($ds_quyen) && in_array('places_man_city', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-city-view" class="custom-control-label font-weight-normal">Xem danh sách</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-city-add" value="places_add_city" <?=(isset($ds_quyen) && in_array('places_add_city', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-city-add" class="custom-control-label font-weight-normal">Thêm mới</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-city-edit" value="places_edit_city" <?=(isset($ds_quyen) && in_array('places_edit_city', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-city-edit" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-city-delete" value="places_delete_city" <?=(isset($ds_quyen) && in_array('places_delete_city', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-city-delete" class="custom-control-label font-weight-normal">Xóa</label>
		                    </div>
						</div>
					</div>
					<div class="form-group row">
						<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-places-district">Quận huyện:</label>
						<div class="col-md-7">
							<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-district-view" value="places_man_district" <?=(isset($ds_quyen) && in_array('places_man_district', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-district-view" class="custom-control-label font-weight-normal">Xem danh sách</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-district-add" value="places_add_district" <?=(isset($ds_quyen) && in_array('places_add_district', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-district-add" class="custom-control-label font-weight-normal">Thêm mới</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-district-edit" value="places_edit_district" <?=(isset($ds_quyen) && in_array('places_edit_district', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-district-edit" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-district-delete" value="places_delete_district" <?=(isset($ds_quyen) && in_array('places_delete_district', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-district-delete" class="custom-control-label font-weight-normal">Xóa</label>
		                    </div>
						</div>
					</div>
					<div class="form-group row">
						<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-places-wards">Phường xã:</label>
						<div class="col-md-7">
							<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-wards-view" value="places_man_wards" <?=(isset($ds_quyen) && in_array('places_man_wards', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-wards-view" class="custom-control-label font-weight-normal">Xem danh sách</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-wards-add" value="places_add_wards" <?=(isset($ds_quyen) && in_array('places_add_wards', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-wards-add" class="custom-control-label font-weight-normal">Thêm mới</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-wards-edit" value="places_edit_wards" <?=(isset($ds_quyen) && in_array('places_edit_wards', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-wards-edit" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-wards-delete" value="places_delete_wards" <?=(isset($ds_quyen) && in_array('places_delete_wards', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-wards-delete" class="custom-control-label font-weight-normal">Xóa</label>
		                    </div>
						</div>
					</div>
					<div class="form-group row">
						<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-places-street">Đường:</label>
						<div class="col-md-7">
							<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-street-view" value="places_man_street" <?=(isset($ds_quyen) && in_array('places_man_street', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-street-view" class="custom-control-label font-weight-normal">Xem danh sách</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-street-add" value="places_add_street" <?=(isset($ds_quyen) && in_array('places_add_street', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-street-add" class="custom-control-label font-weight-normal">Thêm mới</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-street-edit" value="places_edit_street" <?=(isset($ds_quyen) && in_array('places_edit_street', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-street-edit" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
		                    </div>
		                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-places-street-delete" value="places_delete_street" <?=(isset($ds_quyen) && in_array('places_delete_street', $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-places-street-delete" class="custom-control-label font-weight-normal">Xóa</label>
		                    </div>
						</div>
					</div>
	            </div>
	        </div>
		<?php } ?>
	    <?php if(isset($config['onesignal']) && $config['onesignal'] == true) { ?>
			<div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý thông báo đẩy</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
					<div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-onesignal-view" value="pushOnesignal_man" <?=(isset($ds_quyen) && in_array('pushOnesignal_man', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-onesignal-view" class="custom-control-label font-weight-normal">Xem danh sách</label>
                    </div>
                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-onesignal-add" value="pushOnesignal_add" <?=(isset($ds_quyen) && in_array('pushOnesignal_add', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-onesignal-add" class="custom-control-label font-weight-normal">Thêm mới</label>
                    </div>
                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-onesignal-edit" value="pushOnesignal_edit" <?=(isset($ds_quyen) && in_array('pushOnesignal_edit', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-onesignal-edit" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
                    </div>
                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 mr-4 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-onesignal-push" value="pushOnesignal_sync" <?=(isset($ds_quyen) && in_array('pushOnesignal_sync', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-onesignal-push" class="custom-control-label font-weight-normal">Đẩy tin</label>
                    </div>
                    <div class="custom-control custom-checkbox d-inline-block align-middle mb-2 text-md">
                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-onesignal-delete" value="pushOnesignal_delete" <?=(isset($ds_quyen) && in_array('pushOnesignal_delete', $ds_quyen))?'checked':'';?>>
                        <label for="quyen-onesignal-delete" class="custom-control-label font-weight-normal">Xóa</label>
                    </div>
	            </div>
	        </div>
		<?php } ?>
        <?php if(isset($config['seopage']) && count($config['seopage']['page']) > 0) { ?>
	        <div class="card card-permission card-primary card-outline text-sm">
	            <div class="card-header">
	                <h3 class="card-title">Quản lý SEO page</h3>
	                <div class="card-tools">
	                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	                </div>
	            </div>
	            <div class="card-body">
					<?php foreach($config['seopage']['page'] as $key => $value) { ?>
						<div class="form-group row">
							<label class="d-inline-block align-middle mb-2 mr-2 text-md col-md-3" for="quyen-seopage-<?=$key?>"><?=$value?>:</label>
							<div class="custom-control custom-checkbox d-inline-block align-middle text-md mb-2 col-md-7">
		                        <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-seopage-<?=$key?>" value="seopage_capnhat_<?=$key?>" <?=(isset($ds_quyen) && in_array('seopage_capnhat_'.$key, $ds_quyen))?'checked':'';?>>
		                        <label for="quyen-seopage-<?=$key?>" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
		                    </div>
						</div>
					<?php } ?>
	            </div>
	        </div>
	    <?php } ?>
	    <div class="card card-permission card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Quản lý thông tin công ty</h3>
                <div class="card-tools">
                	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
				<div class="form-group">
					<div class="custom-control custom-checkbox text-md">
		                <input type="checkbox" class="custom-control-input" name="dataQuyen[]" id="quyen-setting" value="setting_capnhat" <?=(isset($ds_quyen) && in_array('setting_capnhat', $ds_quyen))?'checked':'';?>>
		                <label for="quyen-setting" class="custom-control-label font-weight-normal">Chỉnh sửa</label>
		            </div>
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

<!-- Phân quyền js -->
<script type="text/javascript">
	function LoadCheck()
	{
		if(jQuery('.card-permission').find("input[type=checkbox]:checked").length == jQuery('.card-permission').find("input[type=checkbox]").length)
	    {
	       	jQuery("input#selectall-checkbox").prop("checked",true);
	    }
	    else
	    {
	    	jQuery("input#selectall-checkbox").prop("checked",false);
	    }
	}
	LoadCheck();
	jQuery(document).ready(function(){
		jQuery("input#selectall-checkbox").click(function(){
			$this = jQuery(this);
			if($this.prop('checked'))
			{
				jQuery(".card-permission").find("input[type=checkbox]").prop("checked",true);
			}
			else
			{
				jQuery(".card-permission").find("input[type=checkbox]").prop("checked",false);
			}
		})
		jQuery(".card-permission").change(function(){
		    LoadCheck();
		});
	})
</script>