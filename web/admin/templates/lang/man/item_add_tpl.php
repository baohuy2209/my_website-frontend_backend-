<?php
    $linkMan = "index.php?com=lang&act=man&p=".$curPage;
    $linkSave = "index.php?com=lang&act=save&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý ngôn ngữ">Quản lý ngôn ngữ</a></li>
                <li class="breadcrumb-item active">Chi tiết ngôn ngữ</li>
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
                <h3 class="card-title"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> ngôn ngữ</h3>
            </div>
            <div class="card-body">
				<div class="form-group">
					<label for="giatri">Tên biến:</label>
                    <input type="text" class="form-control" name="data[giatri]" id="giatri" placeholder="Tên biến" value="<?=@$item['giatri']?>" required>
				</div>
				<?php foreach($config['website']['lang'] as $key => $value) { ?>
                  	<div class="form-group">
						<label for="lang<?=$key?>"><?=$value?>:</label>
						<input type="text" class="form-control" name="data[lang<?=$key?>]" id="lang<?=$key?>" placeholder="<?=$value?> *" value="<?=@$item['lang'.$key]?>" required>
					</div>
                <?php } ?>
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