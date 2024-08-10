<?php if(count($slider)) { ?>
    <div class="slideshow">
        <p class="control-slideshow prev-slideshow transition"><i class="fas fa-chevron-left"></i></p>
        <div class="owl-carousel owl-theme owl-slideshow">
            <?php for($i=0,$count=count($slider); $i < $count; $i++) { ?>
                <div>
                    <div class="box-slideshow">
                        <a href="<?=$slider[$i]['link']?>" target="_blank" title="<?=$slider[$i]['ten']?>">
                            <img onerror="this.src='<?=THUMBS?>/1366x518x2/assets/images/noimage.png';" src="<?=THUMBS?>/1366x518x1/<?=UPLOAD_PHOTO_L.$slider[$i]['photo']?>" alt="<?=$slider[$i]['ten']?>" title="<?=$slider[$i]['ten']?>"/>
                            <?php if($slider[$i]['mota'] != ''){ ?>
                                <div class="slider-content">
                                    <div class="slider-title animate__animated animate__rotateInDownLeft"><?=$slider[$i]['ten']?></div>
                                    <div class="slider-desc animate__animated animate__lightSpeedInRight"><?=$slider[$i]['mota']?></div>
                                    <div class="slider-more animate__animated animate__jackInTheBox"><?=xemthem?></div>
                                </div>
                            <?php } ?>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <p class="control-slideshow next-slideshow transition"><i class="fas fa-chevron-right"></i></p>
    </div>
<?php } ?>