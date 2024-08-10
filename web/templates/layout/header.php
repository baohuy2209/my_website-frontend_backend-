<div id="header">
	<div class="center d-flex align-items-center justify-content-between">
		<div class="header-left">
			<span><?php if(!empty($slogan)){ ?><?=$slogan['ten']?><?php } ?></span>
			<span><i class="fas fa-phone-square-alt"></i>Hotline: <?=$optsetting['hotline']?></span>
		</div>
		<div class="header-right">
			<?php if(count($mxh1)>0){ ?>
				<ul class="mxh header-mxh">
					<?php for($i=0,$count=count($mxh1); $i<$count; $i++) { ?>
						<li>
							<a href="<?=$mxh1[$i]['link']?>" target="_blank">
								<img onerror="this.src='<?=THUMBS?>/25x25x2/assets/images/noimage.png';" src="<?=THUMBS?>/25x25x1/<?=UPLOAD_PHOTO_L.$mxh1[$i]['photo']?>" alt="<?=$mxh1[$i]['ten']?>">
							</a>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
</div>