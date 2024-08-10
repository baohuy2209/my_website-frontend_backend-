<?php
	include "ajax_config.php";
	
	$id_mau = (isset($_POST['id_mau']) && $_POST['id_mau'] > 0) ? htmlspecialchars($_POST['id_mau']) : 0;
	$idpro = (isset($_POST['idpro']) && $_POST['idpro'] > 0) ? htmlspecialchars($_POST['idpro']) : 0;
	$hinhanhsp = $d->rawQuery("select photo, id_photo, id from #_gallery where id_mau = ? and id_photo = ? and com = ? and type = ? and kind = ? and val = ?",array($id_mau,$idpro,'product','san-pham','man','san-pham'));
	$row_detail = $d->rawQueryOne("select ten$lang, photo from #_product where id = ? and type = ? limit 0,1",array($idpro,'san-pham'));
?>
<?php if($hinhanhsp && count($hinhanhsp) > 0) { ?>
	<a id="Zoom-1" class="MagicZoom" data-options="zoomMode: off; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[0]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$hinhanhsp[0]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
    <div class="gallery-thumb-pro">
        <p class="control-carousel prev-carousel prev-thumb-pro transition"><i class="fas fa-chevron-left"></i></p>
        <div class="owl-carousel owl-theme owl-thumb-pro">
            <?php foreach($hinhanhsp as $v) { ?>
                <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" title="<?=$row_detail['ten'.$lang]?>">
                    <img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=WATERMARK?>/product/540x540x1/<?=UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$row_detail['ten'.$lang]?>">
                </a>
            <?php } ?>
        </div>
        <p class="control-carousel next-carousel next-thumb-pro transition"><i class="fas fa-chevron-right"></i></p>
    </div>
<?php } else { ?>
	<img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="" alt="<?=khongtimthayketqua?>"/>
<?php } ?>