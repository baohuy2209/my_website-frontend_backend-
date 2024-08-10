<?php
    $linkMan = "index.php?com=product&act=man_mau&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=product&act=save_mau&type=".$type."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết màu sắc <?=$config['product'][$type]['title_main']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title"><?=($act=="edit_mau")?"Cập nhật":"Thêm mới";?> màu sắc <?=$config['product'][$type]['title_main']?></h3>
            </div>
            <div class="card-body">
				<?php if(isset($config['product'][$type]['mau_images']) && $config['product'][$type]['mau_images'] == true) { ?>
                    <div class="form-group">
                        <label class="change-photo" for="file">
                            <p>Upload hình ảnh:</p>
                            <div class="rounded">
                                <img class="rounded img-upload" src="<?=UPLOAD_COLOR.@$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                                <strong>
                                    <b class="text-sm text-split"></b>
                                    <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                                </strong>
                            </div>
                        </label>
                        <strong class="d-block mt-2 mb-2 text-sm"><?php echo "Width: ".$config['product'][$type]['width_mau']." px - Height: ".$config['product'][$type]['height_mau']." px (".$config['product'][$type]['img_type_mau'].")" ?></strong>
                        <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="file" id="file">
                            <label class="custom-file-label" for="file">Chọn file</label>
                        </div>
                    </div>
				<?php } ?>
                <div class="row">
    				<?php if(isset($config['product'][$type]['mau_mau']) && $config['product'][$type]['mau_mau'] == true) { ?>
    					<div class="form-group col-md-3 col-sm-4">
                            <label class="d-block" for="mau">Màu sắc:</label>
                            <input type="text" class="form-control jscolor" name="data[mau]" id="mau" maxlength="7" value="<?=(@$item['mau'])?$item['mau']:'#000000'?>">
                        </div>
    				<?php } ?>
    				<?php if(
                        (isset($config['product'][$type]['mau_loai']) && $config['product'][$type]['mau_loai'] == true) && 
                        (isset($config['product'][$type]['mau_images']) && $config['product'][$type]['mau_images'] == true)
                    ) { ?>
    					<div class="form-group col-md-3 col-sm-4">
                            <label for="loaihienthi">Loại hiển thị:</label>
                            <select class="form-control" name="data[loaihienthi]" id="loaihienthi">
                                <option value="0">Chọn loại hiển thị</option>
                                <option <?=(isset($item['loaihienthi']) && $item['loaihienthi'] == 0)?"selected":""?> value="0">Màu sắc</option>
                                <option <?=(isset($item['loaihienthi']) && $item['loaihienthi'] == 1)?"selected":""?> value="1">Hình ảnh</option>
                            </select>
                        </div>
    				<?php } ?>
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
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-body card-article">
                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                            <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                <div class="tab-pane fade show <?=($k=='vi')?'active':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
                                    <div class="form-group">
                                        <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                        <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>" <?=($k=='vi')?'required':''?>>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>