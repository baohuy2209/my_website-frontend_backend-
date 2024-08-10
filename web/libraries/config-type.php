<?php
    /* Config type - Group */
    // $config['group'] = array(
    //     "Group Sản Phẩm" => array(
    //         "product" => array("san-pham"),
    //         // "tags" => array("san-pham"),
    //         // "static" => array("gioi-thieu-san-pham"),
    //         // "photo" => array("slide-product"),
    //         // "photo_static" => array("watermark"),
    //         // "newsletter" => array("dangkybaogia")
    //     ),
    //     "Group Tin Tức" => array(
    //         "news" => array("tin-tuc"),
    //         // "tags" => array("tin-tuc"),
    //         // "photo_static" => array("watermark-news"),
    //         // "newsletter" => array("dangkytuyendung")
    //     )
    // );

    /* Config type - Product */
    require_once LIBRARIES.'type/config-type-product.php';

    /* Config type - Tags */
    require_once LIBRARIES.'type/config-type-tags.php';

    /* Config type - Newsletter */
    require_once LIBRARIES.'type/config-type-newsletter.php';

    /* Config type - News */
    require_once LIBRARIES.'type/config-type-news.php';

    /* Config type - Static */
    require_once LIBRARIES.'type/config-type-static.php';

    /* Config type - Photo */
    require_once LIBRARIES.'type/config-type-photo.php';

    /* Seo page */
    $config['seopage']['page'] = array(
        "san-pham" => "Sản phẩm",
        "tin-tuc" => "Tin tức",
        "dich-vu" => "Dịch vụ",
        "gioi-thieu" => "Giới thiệu",
        "lien-he" => "Liên hệ"
    );
    $config['seopage']['width'] = 300;
    $config['seopage']['height'] = 200;
    $config['seopage']['thumb'] = '300x200x1';
    $config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Setting */
    $config['setting']['diachi'] = true;
    $config['setting']['dienthoai'] = true;
    $config['setting']['hotline'] = true;
    $config['setting']['zalo'] = true;
    $config['setting']['oaidzalo'] = true;
    $config['setting']['email'] = true;
    $config['setting']['website'] = true;
    $config['setting']['fanpage'] = true;
    $config['setting']['toado'] = true;
    $config['setting']['toado_iframe'] = true;

    /* Quản lý import */
    $config['import']['images'] = false;
    $config['import']['thumb'] = '100x100x1';
    $config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

    /* Quản lý export */
    $config['export']['category'] = true;

    /* Quản lý tài khoản */
    $config['user']['active'] = false;
    $config['user']['admin'] = false;
    $config['user']['visitor'] = false;

    /* Quản lý phân quyền */
    $config['permission'] = false;

    /* Quản lý địa điểm */
    $config['places']['active'] = false;
    $config['places']['placesship'] = false;

    /* Quản lý giỏ hàng */
    $config['order']['active'] = false;
    $config['order']['search'] = false;
    $config['order']['excel'] = false;
    $config['order']['word'] = false;
    $config['order']['excelall'] = false;
    $config['order']['wordall'] = false;
    $config['order']['thumb'] = '100x100x1';

    /* Quản lý thông báo đẩy */
    $config['onesignal'] = false;

    /* Quản lý mục (Không cấp) */
    if(isset($config['news']))
    {
        foreach($config['news'] as $key => $value)
        {
            if(!isset($value['dropdown']) || (isset($value['dropdown']) && $value['dropdown'] == false))
            { 
                $config['shownews'] = 1;
                break;
            }
        }
    }
?>