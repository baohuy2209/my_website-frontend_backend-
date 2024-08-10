<?php
    if(!defined('SOURCES')) die("Error");

    /* Favicon */
    $favicon = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('favicon','photo_static'));

    /* Header */
    $logo = $d->rawQueryOne("select id, photo from #_photo where type = ? and act = ? limit 0,1",array('logo','photo_static'));
    $banner = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? limit 0,1",array('banner','photo_static'));
    $slogan = $d->rawQueryOne("select ten$lang as ten from #_static where type = ? limit 0,1",array('slogan'));
    $mxh1 = $d->rawQuery("select ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mxh1'));
    $mxh2 = $d->rawQuery("select ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mxh2'));

    /* Footer */
    $footer = $d->rawQueryOne("select ten$lang as ten, noidung$lang as noidung from #_static where type = ? limit 0,1",array('footer'));
    
    $chinhsach = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, mota$lang as mota, ngaytao, id, photo from #_news where type = ? and hienthi > 0 order by stt,id desc",array('chinh-sach'));

    /* Support */
    $social2 = $d->rawQuery("select ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mangxahoi2'));

    /* Menu */
    $splistmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_product_list where type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
    $ttlistmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_news_list where type = ? and hienthi > 0 order by stt,id desc",array('tin-tuc'));

    /* Get statistic */
    // $tagsSanPham = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_tags where type = ? and noibat > 0 order by stt,id desc",array('san-pham'));
    // $tagsTinTuc = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_tags where type = ? and noibat > 0 order by stt,id desc",array('tin-tuc'));

    /* Get statistic */
    $counter = $statistic->getCounter();
    $online = $statistic->getOnline();

    /* Newsletter */
    if(isset($_POST['submit-newsletter']))
    {
        $responseCaptcha = $_POST['recaptcha_response_newsletter'];
        $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (isset($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (isset($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (isset($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

        if(($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true)
        {
            $data = array();
            $data['email'] = (isset($_REQUEST['email-newsletter']) && $_REQUEST['email-newsletter'] != '') ? htmlspecialchars($_REQUEST['email-newsletter']) : '';
            $data['ten'] = (isset($_REQUEST['ten-newsletter']) && $_REQUEST['ten-newsletter'] != '') ? htmlspecialchars($_REQUEST['ten-newsletter']) : '';
            $data['dienthoai'] = (isset($_REQUEST['dienthoai-newsletter']) && $_REQUEST['dienthoai-newsletter'] != '') ? htmlspecialchars($_REQUEST['dienthoai-newsletter']) : '';
            $data['diachi'] = (isset($_REQUEST['diachi-newsletter']) && $_REQUEST['diachi-newsletter'] != '') ? htmlspecialchars($_REQUEST['diachi-newsletter']) : '';
            $data['noidung'] = (isset($_REQUEST['noidung-newsletter']) && $_REQUEST['noidung-newsletter'] != '') ? htmlspecialchars($_REQUEST['noidung-newsletter']) : '';
            $data['ngaytao'] = time();
            $data['type'] = 'dangkynhantin';

            if($d->insert('newsletter',$data))
            {
                $func->transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.",$config_base);
            }
            else
            {
                $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
            }
        }
        else
        {
            $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.",$config_base, false);
        }
    }
?>