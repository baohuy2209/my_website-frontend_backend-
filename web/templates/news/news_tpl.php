<div class="title-main">
    <h1><?=(@$title_cat!='')?$title_cat:@$title_crumb?></h1>
    <p><?php if(!empty($slogan)){ ?><?=$slogan['ten']?><?php } ?></p>
</div>
<div class="w-clear">
    <?php if(count($news)>0) { ?>
        <?php for($i=0,$count=count($news); $i<$count; $i++) { ?>
            <div class="box-news w-clear">
                <div class="pic-news">
                    <a class="text-decoration-none scale-img" href="<?=$news[$i][$sluglang]?>" title="<?=$news[$i]['ten']?>">
                        <img onerror="this.src='<?=THUMBS?>/480x320x2/assets/images/noimage.png';" src="<?=THUMBS?>/480x320x1/<?=UPLOAD_NEWS_L.$news[$i]['photo']?>" alt="<?=$news[$i]['ten']?>">
                    </a>
                </div>
                <h3 class="name-news">
                    <a class="text-decoration-none scale-img" href="<?=$news[$i][$sluglang]?>" title="<?=$news[$i]['ten']?>">
                        <?=$news[$i]['ten']?>
                    </a>
                </h3>
                <div class="time-news"><?=ngaydang?>: <?=date("d/m/Y h:i A",$news[$i]['ngaytao'])?></div>
                <p class="desc-news text-split"><?=$news[$i]['mota']?></p>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
</div>