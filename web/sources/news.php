<?php  
	if(!defined('SOURCES')) die("Error");

	@$id = htmlspecialchars($_GET['id']);
	@$idl = htmlspecialchars($_GET['idl']);
	@$idc = htmlspecialchars($_GET['idc']);
	@$idi = htmlspecialchars($_GET['idi']);
	@$ids = htmlspecialchars($_GET['ids']);

	if($id!='')
	{
		/* Lấy bài viết detail */
		$row_detail = $d->rawQueryOne("select id, luotxem, ngaytao, id_list, id_cat, id_item, id_sub, type, ten$lang as ten, tenkhongdauvi, tenkhongdauen, noidung$lang as noidung, photo from #_news where id = ? and type = ? and hienthi > 0 limit 0,1",array($id,$type));

		/* Cập nhật lượt xem */
		$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
		$d->where('id',$row_detail['id']);
		$d->update('news',$data_luotxem);

		/* Lấy cấp 1 */
		$news_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_list where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_list'],$type));

		/* Lấy cấp 2 */
		$news_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_cat where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_cat'],$type));

		/* Lấy cấp 3 */
		$news_item = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_item where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_item'],$type));

		/* Lấy cấp 4 */
		$news_sub = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_sub where id = ? and type = ? and hienthi > 0 limit 0,1",array($row_detail['id_sub'],$type));	
		
		/* Lấy hình ảnh con */
		$hinhanhtt = $d->rawQuery("select photo from #_gallery where id_photo = ? and com='news' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc",array($row_detail['id'],$type,$type));

		/* Lấy bài viết cùng loại */
		$where = "";
		$where = "id <> ? and id_list = ? and type = ? and hienthi > 0";
		$params = array($id,$row_detail['id_list'],$type);

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$seoDB = $seo->getSeoDB($row_detail['id'],'news','man',$row_detail['type']);
		$seo->setSeo('h1',$row_detail['ten']);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$row_detail['ten']);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = (isset($row_detail['options']) && $row_detail['options'] != '') ? json_decode($row_detail['options'],true) : null;
		if(!empty($row_detail['photo']))
		{
			if($img_json_bar == null || ($img_json_bar['p'] != $row_detail['photo']))
			{
				$img_json_bar = $func->getImgSize($row_detail['photo'],UPLOAD_NEWS_L.$row_detail['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar),'news',$row_detail['id']);
			}
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_NEWS_L.$row_detail['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		if($news_list != null) $breadcr->setBreadCrumbs($news_list[$sluglang],$news_list['ten']);
		if($news_cat != null) $breadcr->setBreadCrumbs($news_cat[$sluglang],$news_cat['ten']);
		if($news_item != null) $breadcr->setBreadCrumbs($news_item[$sluglang],$news_item['ten']);
		if($news_sub != null) $breadcr->setBreadCrumbs($news_sub[$sluglang],$news_sub['ten']);
		$breadcr->setBreadCrumbs($row_detail[$sluglang],$row_detail['ten']);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($idl!='')
	{
		/* Lấy cấp 1 detail */
		$news_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, type, photo from #_news_list where id = ? and type = ? limit 0,1",array($idl,$type));

		/* SEO */
		$title_cat = $news_list['ten'];
		$seoDB = $seo->getSeoDB($news_list['id'],'news','man_list',$news_list['type']);
		$seo->setSeo('h1',$news_list['ten']);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$news_list['ten']);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = (isset($news_list['options']) && $news_list['options'] != '') ? json_decode($news_list['options'],true) : null;
		if(!empty($news_list['photo']))
		{
			if($img_json_bar == null || ($img_json_bar['p'] != $news_list['photo']))
			{
				$img_json_bar = $func->getImgSize($news_list['photo'],UPLOAD_NEWS_L.$news_list['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar),'news_list',$news_list['id']);
			}
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_NEWS_L.$news_list['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* Lấy bài viết */
		$where = "";
		$where = "id_list = ? and type = ? and hienthi > 0";
		$params = array($idl,$type);

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($news_list[$sluglang],$news_list['ten']);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($idc!='')
	{
		/* Lấy cấp 2 detail */
		$news_cat = $d->rawQueryOne("select id, id_list, ten$lang as ten, tenkhongdauvi, tenkhongdauen, type, photo from #_news_cat where id = ? and type = ? limit 0,1",array($idc,$type));

		/* Lấy cấp 1 */
		$news_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_list where id = ? and type = ? limit 0,1",array($news_cat['id_list'],$type));
		
		/* Lấy bài viết */
		$where = "";
		$where = "id_cat = ? and type = ? and hienthi > 0";
		$params = array($idc,$type);

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$title_cat = $news_cat['ten'];
		$seoDB = $seo->getSeoDB($news_cat['id'],'news','man_cat',$news_cat['type']);
		$seo->setSeo('h1',$news_cat['ten']);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$news_cat['ten']);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = (isset($news_cat['options']) && $news_cat['options'] != '') ? json_decode($news_cat['options'],true) : null;
		if(!empty($news_cat['photo']))
		{
			if($img_json_bar == null || ($img_json_bar['p'] != $news_cat['photo']))
			{
				$img_json_bar = $func->getImgSize($news_cat['photo'],UPLOAD_NEWS_L.$news_cat['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar),'news_cat',$news_cat['id']);
			}
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_NEWS_L.$news_cat['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($news_list[$sluglang],$news_list['ten']);
		$breadcr->setBreadCrumbs($news_cat[$sluglang],$news_cat['ten']);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($idi!='')
	{
		/* Lấy cấp 3 detail */
		$news_item = $d->rawQueryOne("select id, id_list, id_cat, ten$lang as ten, tenkhongdauvi, tenkhongdauen, type, photo from #_news_item where id = ? and type = ? limit 0,1",array($idi,$type));

		/* Lấy cấp 1 */
		$news_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_list where id = ? and type = ? limit 0,1",array($news_item['id_list'],$type));

		/* Lấy cấp 2 */
		$news_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_cat where id_list = ? and id = ? and type = ? limit 0,1",array($news_item['id_list'],$news_item['id_cat'],$type));

		/* Lấy bài viết */
		$where = "";
		$where = "id_item = ? and type = ? and hienthi > 0";
		$params = array($idi,$type);

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$title_cat = $news_item['ten'];
		$seoDB = $seo->getSeoDB($news_item['id'],'news','man_item',$news_item['type']);
		$seo->setSeo('h1',$news_item['ten']);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$news_item['ten']);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = (isset($news_item['options']) && $news_item['options'] != '') ? json_decode($news_item['options'],true) : null;
		if(!empty($news_item['photo']))
		{
			if($img_json_bar == null || ($img_json_bar['p'] != $news_item['photo']))
			{
				$img_json_bar = $func->getImgSize($news_item['photo'],UPLOAD_NEWS_L.$news_item['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar),'news_item',$news_item['id']);
			}
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_NEWS_L.$news_item['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($news_list[$sluglang],$news_list['ten']);
		$breadcr->setBreadCrumbs($news_cat[$sluglang],$news_cat['ten']);
		$breadcr->setBreadCrumbs($news_item[$sluglang],$news_item['ten']);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else if($ids!='')
	{
		/* Lấy cấp 4 */
		$news_sub = $d->rawQueryOne("select id, id_list, id_cat, id_item, ten$lang as ten, tenkhongdauvi, tenkhongdauen, type, photo from #_news_sub where id = ? and type = ? limit 0,1",array($ids,$type));

		/* Lấy cấp 1 */
		$news_list = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_list where id = ? and type = ? limit 0,1",array($news_sub['id_list'],$type));

		/* Lấy cấp 2 */
		$news_cat = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_cat where id_list = ? and id = ? and type = ? limit 0,1",array($news_sub['id_list'],$news_sub['id_cat'],$type));

		/* Lấy cấp 3 */
		$news_item = $d->rawQueryOne("select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_news_item where id_list = ? and id_cat = ? and id = ? and type = ? limit 0,1",array($news_sub['id_list'],$news_sub['id_cat'],$news_sub['id_item'],$type));

		/* Lấy bài viết */
		$where = "";
		$where = "id_sub = ? and type = ? and hienthi > 0";
		$params = array($ids,$type);

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* SEO */
		$title_cat = $news_sub['ten'];
		$seoDB = $seo->getSeoDB($news_sub['id'],'news','man_sub',$news_sub['type']);
		$seo->setSeo('h1',$news_sub['ten']);
		if(!empty($seoDB['title'.$seolang])) $seo->setSeo('title',$seoDB['title'.$seolang]);
		else $seo->setSeo('title',$news_sub['ten']);
		if(!empty($seoDB['keywords'.$seolang])) $seo->setSeo('keywords',$seoDB['keywords'.$seolang]);
		if(!empty($seoDB['description'.$seolang])) $seo->setSeo('description',$seoDB['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = (isset($news_sub['options']) && $news_sub['options'] != '') ? json_decode($news_sub['options'],true) : null;
		if(!empty($news_sub['photo']))
		{
			if($img_json_bar == null || ($img_json_bar['p'] != $news_sub['photo']))
			{
				$img_json_bar = $func->getImgSize($news_sub['photo'],UPLOAD_NEWS_L.$news_sub['photo']);
				$seo->updateSeoDB(json_encode($img_json_bar),'news_sub',$news_sub['id']);
			}
			$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_NEWS_L.$news_sub['photo']);
			$seo->setSeo('photo:width',$img_json_bar['w']);
			$seo->setSeo('photo:height',$img_json_bar['h']);
			$seo->setSeo('photo:type',$img_json_bar['m']);
		}

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcr->setBreadCrumbs($news_list[$sluglang],$news_list['ten']);
		$breadcr->setBreadCrumbs($news_cat[$sluglang],$news_cat['ten']);
		$breadcr->setBreadCrumbs($news_item[$sluglang],$news_item['ten']);
		$breadcr->setBreadCrumbs($news_sub[$sluglang],$news_sub['ten']);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
	else
	{
		/* SEO */
		$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1",array($type));
		$seo->setSeo('h1',$title_crumb);
		if(!empty($seopage['title'.$seolang])) $seo->setSeo('title',$seopage['title'.$seolang]);
		else $seo->setSeo('title',$title_crumb);
		if(!empty($seopage['keywords'.$seolang])) $seo->setSeo('keywords',$seopage['keywords'.$seolang]);
		if(!empty($seopage['description'.$seolang])) $seo->setSeo('description',$seopage['description'.$seolang]);
		$seo->setSeo('url',$func->getPageURL());
		$img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'],true) : null;
		if(!empty($seopage['photo']))
		{
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

		/* Lấy tất cả bài viết */
		$where = "";
		$where = "type = ? and hienthi > 0";
		$params = array($type);

		$curPage = $get_page;
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select id, ten$lang as ten, tenkhongdauvi, tenkhongdauen, photo, ngaytao, mota$lang as mota from #_news where $where order by stt,id desc $limit";
		$news = $d->rawQuery($sql,$params);
		$sqlNum = "select count(*) as 'num' from #_news where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,$params);
		$total = $count['num'];
		$url = $func->getCurrentPageURL();
		$paging = $func->pagination($total,$per_page,$curPage,$url);

		/* breadCrumbs */
		if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
		$breadcrumbs = $breadcr->getBreadCrumbs();
	}
?>