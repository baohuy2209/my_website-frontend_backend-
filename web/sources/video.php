<?php  
	if(!defined('SOURCES')) die("Error");

	/* Lấy tất cả video */
	$where = "";
	$where = "type = ? and act <> ? and hienthi > 0";
	$params = array($type,'photo_static');

	$curPage = $get_page;
	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select photo, link_video, tenvi as ten from #_photo where $where order by stt,id desc $limit";
	$video = $d->rawQuery($sql,$params);
	$sqlNum = "select count(*) as 'num' from #_photo where $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,$params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total,$per_page,$curPage,$url);

	/* SEO */
	$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1",array($type));
	$seo->setSeo('h1',$title_crumb);
	if($seopage['title'.$seolang]!='') $seo->setSeo('title',$seopage['title'.$seolang]);
	else $seo->setSeo('title',$title_crumb);
	$seo->setSeo('keywords',$seopage['keywords'.$seolang]);
	$seo->setSeo('description',$seopage['description'.$seolang]);
	$seo->setSeo('url',$func->getPageURL());
	$img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'],true) : null;
	if(!empty($seopage['photo'])){
		if($img_json_bar == null || ($img_json_bar['p'] != $seopage['photo']))
		{
			$img_json_bar = $func->getImgSize($seopage['photo'],UPLOAD_SEOPAGE_L.$seopage['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'seopage',$seopage['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_SEOPAGE_L.$seopage['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
	}
	
	/* breadCrumbs */
	if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
?>