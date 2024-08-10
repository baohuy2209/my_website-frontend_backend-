<div class="title-main">
    <h1><?=$row_detail['ten']?></h1>
    <p><?php if(!empty($slogan)){ ?><?=$slogan['ten']?><?php } ?></p>
</div>
<div class="album-gallery w-clear">
    <?php if(count($hinhanhsp)>0) { ?>
    	<?php for($i=0,$count=count($hinhanhsp); $i<$count; $i++) { ?>
	        <div class="box-album">
	            <div class="pic-album">
                    <a class="text-decoration-none scale-img" rel="album-<?=$row_detail['id']?>" href="<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" title="<?=$row_detail['ten']?>">
                        <img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[$i]['photo']?>" alt="<?=$row_detail['ten']?>"/>
                    </a>
                </div>
	        </div>
	    <?php } ?> 
	<?php } else { ?>
        <div class="alert alert-danger" role="alert">
            <strong><?=khongtimthayketqua?></strong>
        </div>
    <?php } ?>
</div>