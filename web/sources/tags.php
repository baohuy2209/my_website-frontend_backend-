<?php  
	if(!defined('SOURCES')) die("Error");
		
	$id = htmlspecialchars($_GET['id']);
	
	if($id)
	{
		/* Lấy tag detail */
		$tags_detail = $d->rawQueryOne("select id, ten$lang as ten, type, photo, tenkhongdauvi, tenkhongdauen from #_tags where id = ? and type = ? limit 0,1",array($id,$type));

		/* Lấy mục */
		$where = "";
		$where = "find_in_set(".$tags_detail['id'].",id_tags) and type = ?";
		$params = array($type);

		/* Column for sản phẩm */
		if($table == 'product') $col = "photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id";

		/* Column for bài viết */
		if($table == 'news') $col = "photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, mota$lang as mota, noidung$lang as noidung, ngaytao, id";

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select $col from #_".$table." where $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_".$table." where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* Data for sản phẩm */
		if($table == 'product') $product = $items;

		/* Data for bài viết */
		if($table == 'news') $news = $items;
		
		/* SEO */
		$title_cat = $tags_detail['ten'];
		$title_crumb = $tags_detail['ten'];
		$seoDB = $seo->getSeoDB($tags_detail['id'],'tags','man',$tags_detail['type']);
		$seo->setSeo('h1',$tags_detail['ten']);
		if($seoDB['title'.$seolang]!='') $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$tags_detail['ten']);
		$seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		$seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = (isset($tags_detail['options']) && $tags_detail['options'] != '') ? json_decode($tags_detail['options'],true) : null;
		if(!empty($tags_detail['photo'])){
			if($img_json_bar == null || ($img_json_bar['p'] != $tags_detail['photo']))
			{
				$img_json_bar = $func->getImgSize($tags_detail['photo'],UPLOAD_TAGS_L.$tags_detail['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar),'tags',$tags_detail['id']);
			}
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_TAGS_L.$tags_detail['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($tags_detail[$sluglang],$title_crumb);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
?>