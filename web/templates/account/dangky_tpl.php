<div class="wrap-user">
    <div class="title-user">
        <span><?=dangky?></span>
    </div>
    <form class="form-user validation-user" novalidate method="post" action="account/dang-ky" enctype="multipart/form-data">
        <label for="basic-url"><?=hoten?></label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" class="form-control" id="ten" name="ten" placeholder="<?=nhaphoten?>" required>
            <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
        </div>
        <label for="basic-url"><?=taikhoan?></label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" class="form-control" id="username" name="username" placeholder="<?=nhaptaikhoan?>" required>
            <div class="invalid-feedback"><?=vuilongnhaptaikhoan?></div>
        </div>
        <label for="basic-url"><?=matkhau?></label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="<?=nhapmatkhau?>" required>
            <div class="invalid-feedback"><?=vuilongnhapmatkhau?></div>
        </div>
        <label for="basic-url"><?=nhaplaimatkhau?></label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="<?=nhaplaimatkhau?>" required>
            <div class="invalid-feedback"><?=vuilongnhaplaimatkhau?></div>
        </div>
        <label for="basic-url"><?=gioitinh?></label>
        <div class="input-group input-user">
            <div class="radio-user custom-control custom-radio">
                <input type="radio" id="nam" name="gioitinh" class="custom-control-input" value="1" required>
                <label class="custom-control-label" for="nam"><?=nam?></label>
            </div>
            <div class="radio-user custom-control custom-radio">
                <input type="radio" id="nu" name="gioitinh" class="custom-control-input" value="2" required>
                <label class="custom-control-label" for="nu"><?=nu?></label>
            </div>
        </div>
        <label for="basic-url"><?=ngaysinh?></label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
            </div>
            <input type="text" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="<?=nhapngaysinh?>" required>
            <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
        </div>
        <label for="basic-url">Email</label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-envelope"></i></div>
            </div>
            <input type="email" class="form-control" id="email" name="email" placeholder="<?=nhapemail?>" required>
            <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
        </div>
        <label for="basic-url"><?=dienthoai?></label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-phone-square"></i></div>
            </div>
            <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?=nhapdienthoai?>" required>
            <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
        </div>
        <label for="basic-url"><?=diachi?></label>
        <div class="input-group input-user">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-map"></i></div>
            </div>
            <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?=nhapdiachi?>" required>
            <div class="invalid-feedback"><?=vuilongnhapdiachi?></div>
        </div>
        <div class="button-user">
            <input type="submit" class="btn btn-primary btn-block" name="dangky" value="<?=dangky?>" disabled>
        </div>
    </form>
</div>