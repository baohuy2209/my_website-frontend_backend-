<div id="footer">
    <div class="footer-top">
        <div class="center d-flex flex-wrap align-items-start justify-content-between">
            <div class="footer-1">
                <div class="footer-tit ">thông tin liên hệ</div>
                <div class="footer-tit name-company"><?=$footer['ten']?></div>
                <div class="footer-content"><?=htmlspecialchars_decode($footer['noidung'])?></div>
            </div>
            <div class="footer-2">
                <?php if(isset($chinhsach)){ ?>
                    <div class="footer-tit">Chính sách</div>
                    <ul class="footer-list">
                        <?php for($i=0,$count=count($chinhsach); $i < $count; $i++) { ?>
                            <li><a class="text-decoration-none" href="<?=$chinhsach[$i][$sluglang]?>" title="<?=$chinhsach[$i]['ten']?>">- <?=$chinhsach[$i]['ten']?></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
            <div class="footer-3">
                <?=$addons->setAddons('fanpage-facebook', 'fanpage-facebook', 10);?>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="center d-flex flex-wrap align-items-center justify-content-between">
            <p class="copyright">© Copyright © 2020 Lily Steel Building. All rights reserved. Design by <a href="https://nina.vn/" target="_blank">NINA Co.,Ltd</a></p>
            <ul class="statistic d-flex flex-wrap align-items-center justify-content-center">
                <li><?=dangonline?>: <span class="numer-access"><?=$online?></span></li>
                <span>|</span>
                <li><?=trongthang?>:  <span class="numer-access"><?=$counter['month']?></span></li>
                <span>|</span>
                <li><?=tongtruycap?>:  <span class="numer-access"><?=$counter['total']?></span></li>
            </ul>
        </div>
    </div>
    <?php /* if($source=='index'){ 
        <?=$addons->setAddons('footer-map', 'footer-map', 10);?>
    } */ ?>
</div>