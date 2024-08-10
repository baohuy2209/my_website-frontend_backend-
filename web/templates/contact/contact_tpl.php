<div class="title-main">
    <h1><?=$title_crumb?></h1>
    <p><?php if(!empty($slogan)){ ?><?=$slogan['ten']?><?php } ?></p>
</div>
<div class="w-clear">
    <div class="top-contact">
        <div class="article-contact"><?=(isset($lienhe['noidung']) && $lienhe['noidung'] != '') ? htmlspecialchars_decode($lienhe['noidung']) : ''?></div>
        <form class="form-contact validation-contact" novalidate method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="input-contact col-sm-6">
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="<?=hoten?>" required />
                    <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
                </div>
                <div class="input-contact col-sm-6">
                    <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?=sodienthoai?>" required />
                    <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
                </div>
            </div>
            <div class="row">
                <div class="input-contact col-sm-6">
                    <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?=diachi?>" required />
                    <div class="invalid-feedback"><?=vuilongnhapdiachi?></div>
                </div>
                <div class="input-contact col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                    <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
                </div>
            </div>
            <div class="input-contact">
                <input type="text" class="form-control" id="tieude" name="tieude" placeholder="<?=chude?>" required />
                <div class="invalid-feedback"><?=vuilongnhapchude?></div>
            </div>
            <div class="input-contact">
                <textarea class="form-control" id="noidung" name="noidung" placeholder="<?=noidung?>" required /></textarea>
                <div class="invalid-feedback"><?=vuilongnhapnoidung?></div>
            </div>
            <div class="input-contact">
                <input type="file" class="custom-file-input" name="file">
                <label class="custom-file-label" for="file" title="<?=chon?>"><?=dinhkemtaptin?></label>
            </div>
            <input type="submit" class="btn btn-primary" name="submit-contact" value="<?=gui?>" disabled />
            <input type="reset" class="btn btn-secondary" value="<?=nhaplai?>" />
            <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
        </form>
    </div>
    <div class="bottom-contact"><?=htmlspecialchars_decode($optsetting['toado_iframe'])?></div>
</div>