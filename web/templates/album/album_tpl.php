<div class="title-main">
    <h1><?=$title_crumb?></h1>
    <p><?php if(!empty($slogan)){ ?><?=$slogan['ten']?><?php } ?></p>
</div>
<div class="w-clear">
    <?php if(count($product)>0) { ?>
        <?php for($i=0,$count=count($product); $i<$count; $i++) { ?>
            <div class="box-album">
                <div class="pic-album">
                    <a class="text-decoration-none scale-img" href="<?=$product[$i][$sluglang]?>" title="<?=$product[$i]['ten']?>">
                        <img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$product[$i]['photo']?>" alt="<?=$product[$i]['ten']?>"/>
                    </a>
                </div>
                <h3 class="name-album text-split"><?=$product[$i]['ten']?></h3>
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