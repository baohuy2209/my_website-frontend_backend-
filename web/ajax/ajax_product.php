<?php 
	include "ajax_config.php";

	/* Paginations */
	include LIBRARIES."class/class.PaginationsAjax.php";
	$pagingAjax = new PaginationsAjax();
	$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
	$eShow = htmlspecialchars($_GET['eShow']);
	$idList = (isset($_GET['idList']) && $_GET['idList'] > 0) ? htmlspecialchars($_GET['idList']) : 0;
	$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
	$start = ($p-1) * $pagingAjax->perpage;
	$pageLink = "ajax/ajax_product.php?perpage=".$pagingAjax->perpage;
	$tempLink = "";
	$where = "";

	/* Math url */
	if($idList)
	{
		$tempLink .= "&idList=".$idList;
		$where .= " and id_list = ".$idList;
	}
	$tempLink .= "&p=";
	$pageLink .= $tempLink;

	/* Get data */
	$sql = "select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id, photo, gia, giamoi, giakm, type from #_product where type='san-pham' $where and noibat > 0 and hienthi > 0 order by stt,id desc";
	$sqlCache = $sql." limit $start, $pagingAjax->perpage";
    $items = $cache->getCache($sqlCache,'result',7200);

	/* Count all data */
	$countItems = count($cache->getCache($sql,'result',7200));

	/* Get page result */
	$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);
?>
<?php if($countItems) { ?>
	<div class="w-clear">
		<?php for($i=0,$count=count($items); $i < $count; $i++) { ?>
            <div class="box-product">
                <div class="pic-product">
                    <a class="text-decoration-none scale-img" href="<?=$items[$i][$sluglang]?>" title="<?=$items[$i]['ten']?>">
                        <img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$items[$i]['photo']?>" alt="<?=$items[$i]['ten']?>"/>
                    </a>
                </div>
                <div class="content-product">
                    <h3 class="name-product">
                        <a class="text-decoration-none text-split text-split-2" href="<?=$items[$i][$sluglang]?>" title="<?=$items[$i]['ten']?>">
                            <?=$items[$i]['ten']?>
                        </a>
                    </h3>
                    <div class="price-product d-flex flex-wrap align-items-center justify-content-center">
                    	<div><?=gia?>:&nbsp;</div>
                        <?php if($items[$i]['giakm']) { ?>
                            <span class="price-new"><?=$func->format_money($items[$i]['giamoi'])?></span>
                            <span class="price-old del"><?=$func->format_money($items[$i]['gia'])?></span>
                            <span class="price-per"><?='-'.$items[$i]['giakm'].'%'?></span>
                        <?php } else { ?>
                            <span class="price-new"><?=($items[$i]['gia']) ? $func->format_money($items[$i]['gia']) : lienhe?></span>
                        <?php } ?>
                    </div>
                    <div class="box-product-cart d-flex flex-wrap align-items-center justify-content-center">
                        <span class="box-product-cart-add addcart transition" data-id="<?=$items[$i]['id']?>" data-action="addnow">Thêm vào giỏ hàng</span>
                        <span class="box-product-cart-buy addcart transition" data-id="<?=$items[$i]['id']?>" data-action="buynow">Mua ngay</span>
                    </div>
                </div>
            </div>
        <?php } ?>
	</div>
	<div class="pagination-ajax"><?=$pagingItems?></div>
<?php } ?>