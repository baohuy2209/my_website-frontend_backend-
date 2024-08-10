<div class="title-main">
    <h1><?=$title_crumb?></h1>
    <p><?php if(!empty($slogan)){ ?><?=$slogan['ten']?><?php } ?></p>
</div>
<div class="w-clear">
    <?php if(isset($video) && count($video) > 0) { ?>
        <?php for($i=0,$count=count($video); $i<$count; $i++) { ?>
            <div class="box-video text-decoration-none" data-fancybox="video" data-src="<?=$video[$i]['link_video']?>" title="<?=$video[$i]['ten']?>">
                <div class="pic-video scale-img"><img onerror="this.src='<?=THUMBS?>/480x360x2/assets/images/noimage.png';" src="https://img.youtube.com/vi/<?=$func->getYoutube($video[$i]['link_video'])?>/0.jpg" alt="<?=$video[$i]['ten']?>"/></div>
                <h3 class="name-video text-split"><?=$video[$i]['ten']?></h3>
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