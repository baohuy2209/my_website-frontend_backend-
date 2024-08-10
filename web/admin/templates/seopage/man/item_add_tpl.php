<?php
    $linkSave = "index.php?com=seopage&act=save&type=".$_GET['type'];
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý Seo page</li>
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
                <h3 class="card-title">Thông tin SEO page - <?=$config['seopage']['page'][$_GET['type']]?></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="change-photo" for="file">
                        <p>Upload hình ảnh:</p>
                        <div class="rounded">
                            <img class="rounded img-upload" src="<?=THUMBS?>/<?=$config['seopage']['thumb']?>/<?=UPLOAD_SEOPAGE_L.$item['photo']?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
                            <strong>
                                <b class="text-sm text-split"></b>
                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn hình</span>
                            </strong>
                        </div>
                    </label>
                    <strong class="d-block mt-2 mb-2 text-sm"><?php echo "Width: ".$config['seopage']['width']." px - Height: ".$config['seopage']['height']." px (".$config['seopage']['img_type'].")" ?></strong>
                    <div class="custom-file my-custom-file d-none">
                        <input type="file" class="custom-file-input" name="file" id="file">
                        <label class="custom-file-label" for="file">Chọn file</label>
                    </div>
                </div>
                <?php
                    $seoDB = $item;
                    include TEMPLATE.LAYOUT."seo.php";
                ?>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
        </div>
    </form>
</section>