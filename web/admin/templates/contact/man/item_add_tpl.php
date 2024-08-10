<?php
    $linkMan = "index.php?com=contact&act=man&p=".$curPage;
    $linkSave = "index.php?com=contact&act=save&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý liên hệ">Quản lý liên hệ</a></li>
                <li class="breadcrumb-item active">Chi tiết liên hệ</li>
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
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin liên hệ</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label class="d-inline-block align-middle mb-1 mr-2">Tập tin:</label>
                        <?php if(isset($item['taptin']) && ($item['taptin'] != '')) { ?>
                            <a class="btn btn-sm bg-gradient-primary text-white d-inline-block align-middle p-2 rounded mb-1" href="<?=UPLOAD_FILE.@$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
                        <?php } else { ?>
                            <a class="bg-gradient-secondary text-white d-inline-block p-2 rounded mb-1" href="#" title="Tập tin trống"><i class="fas fa-download mr-2"></i>Tập tin trống</a>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ten">Họ tên:</label>
                        <input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên" value="<?=@$item['ten']?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dienthoai">Điện thoại:</label>
                        <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="data[email]" id="email" placeholder="Email" value="<?=@$item['email']?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="diachi">Địa chỉ:</label>
                        <input type="text" class="form-control" name="data[diachi]" id="diachi" placeholder="Địa chỉ" value="<?=@$item['diachi']?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tieude">Chủ đề:</label>
                        <input type="text" class="form-control" name="data[tieude]" id="tieude" placeholder="Chủ đề" value="<?=@$item['tieude']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="noidung">Nội dung:</label>
                    <textarea class="form-control" name="data[noidung]" id="noidung" rows="5" placeholder="Nội dung"><?=@$item['noidung']?></textarea>
                </div>
                <div class="form-group">
                    <label for="ghichu">Ghi chú:</label>
                    <textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú"><?=@$item['ghichu']?></textarea>
                </div>
                <div class="form-group">
                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>