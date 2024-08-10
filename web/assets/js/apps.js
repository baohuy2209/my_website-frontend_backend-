/* Validation form */
ValidationFormSelf("validation-newsletter");
ValidationFormSelf("validation-cart");
ValidationFormSelf("validation-user");
ValidationFormSelf("validation-contact");

/* Exists */
$.fn.exists = function(){
    return this.length;
};

/* Paging ajax */
if($(".paging-product").exists())
{
    loadPagingAjax("ajax/ajax_product.php?perpage=8",'.paging-product');
}

/* Paging category ajax */
if($(".paging-product-category").exists())
{
    $(".paging-product-category").each(function(){
        var list = $(this).data("list");
        loadPagingAjax("ajax/ajax_product.php?perpage=9&idList="+list,'.paging-product-category-'+list);
    })
}

/* Back to top */
NN_FRAMEWORK.BackToTop = function(){
    $(window).scroll(function(){
        if(!$('.scrollToTop').length) $("body").append('<div class="scrollToTop"><img src="'+GOTOP+'" alt="Go Top"/></div>');
        if($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
        else $('.scrollToTop').fadeOut();
    });

    $('body').on("click",".scrollToTop",function() {
        $('html, body').animate({scrollTop : 0},800);
        return false; 
    });
};

/* Alt images */
NN_FRAMEWORK.AltImages = function(){
    $('img').each(function(index, element) {
        if(!$(this).attr('alt') || $(this).attr('alt')=='')
        {
            $(this).attr('alt',WEBSITE_NAME);
        }
    });
};

/* Fix menu */
NN_FRAMEWORK.FixMenu = function(){
    $(window).scroll(function(){
        if($(window).scrollTop() >= ($("#header").height() + $("#banner").height() + $("#menu").height()))
            $("#menu").addClass('fixing');
        else 
            $("#menu").removeClass('fixing');
    });
};

/* Tools */
NN_FRAMEWORK.Tools = function(){
    if($(".toolbar").exists())
    {
        $(".footer").css({marginBottom:$(".toolbar").innerHeight()});
    }
};

/* Popup */
NN_FRAMEWORK.Popup = function(){
    if($("#popup").exists())
    {
        $('#popup').modal('show');
    }
};

/* Wow */
NN_FRAMEWORK.WowAnimation = function(){
    new WOW().init();
};

/* Mmenu */
NN_FRAMEWORK.Mmenu = function(){
    if($("nav#mmenu").exists())
    {
        $('nav#mmenu').mmenu({
            extensions  : [ 'effect-slide-menu', 'pageshadow' ],
            searchfield : false,
            counters  : false,
            offCanvas: {
                position  : "left"
            }
        });
    }
};

/* Toc */
NN_FRAMEWORK.Toc = function(){
    if($(".toc-list").exists())
    {
        $(".toc-list").toc({
            content: "div#toc-content",
            headings: "h2,h3,h4"
        });

        if(!$(".toc-list li").length) $(".meta-toc").hide();

        $('.toc-list').find('a').click(function(){
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
    }
};

/* Simply scroll */
NN_FRAMEWORK.SimplyScroll = function(){
    if($(".tintuc-r ul").exists())
    {
        $(".tintuc-r ul").simplyScroll({
            customClass: 'vert',
            orientation: 'vertical',
            // orientation: 'horizontal',
            auto: true,
            manualMode: 'auto',
            pauseOnHover: 1,
            speed: 1,
            loop: 0
        });
    }
};

/* Tabs */
NN_FRAMEWORK.Tabs = function(){
    if($(".ul-tabs-pro-detail").exists())
    {
        $(".ul-tabs-pro-detail li").click(function(){
            var tabs = $(this).data("tabs");
            $(".content-tabs-pro-detail, .ul-tabs-pro-detail li").removeClass("active");
            $(this).addClass("active");
            $("."+tabs).addClass("active");
        });
    }
};

/* Photobox */
NN_FRAMEWORK.Photobox = function(){
    if($(".album-gallery").exists())
    {
        $('.album-gallery').photobox('a',{thumbs:true,loop:false});
    }
};

/* Datetime picker */
NN_FRAMEWORK.DatetimePicker = function(){
    if($('#ngaysinh').exists())
    {
        $('#ngaysinh').datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            formatDate: 'd/m/Y',
            minDate: '01/01/1950',
            maxDate: TIMENOW
        });
    }
};

/* Search */
NN_FRAMEWORK.Search = function(){
    if($(".icon-search").exists())
    {
        $(".icon-search").click(function(){
            if($(this).hasClass('active'))
            {
                $(this).removeClass('active');
                $(".search-grid").stop(true,true).animate({opacity: "0",width: "0px"}, 200);   
            }
            else
            {
                $(this).addClass('active');                            
                $(".search-grid").stop(true,true).animate({opacity: "1",width: "230px"}, 200);
            }
            document.getElementById($(this).next().find("input").attr('id')).focus();
            $('.icon-search i').toggleClass('fa fa-search fa fa-times');
        });
    }
};

/* Videos */
NN_FRAMEWORK.Videos = function(){
    /* Fancybox */
    // $('[data-fancybox="something"]').fancybox({
    //     // transitionEffect: "fade",
    //     // transitionEffect: "slide",
    //     // transitionEffect: "circular",
    //     // transitionEffect: "tube",
    //     // transitionEffect: "zoom-in-out",
    //     // transitionEffect: "rotate",
    //     transitionEffect: "fade",
    //     transitionDuration: 800,
    //     animationEffect: "fade",
    //     animationDuration: 800,
    //     slideShow: {
    //         autoStart: true,
    //         speed: 3000
    //     },
    //     arrows: true,
    //     infobar: false,
    //     toolbar: false,
    //     hash: false
    // });

    if($(".video").exists())
    {
        $('[data-fancybox="video"]').fancybox({
            transitionEffect: "fade",
            transitionDuration: 800,
            animationEffect: "fade",
            animationDuration: 800,
            arrows: true,
            infobar: false,
            toolbar: true,
            hash: false
        });
    }
};

/* Owl */
NN_FRAMEWORK.OwlPage = function(){
    if($(".owl-slideshow").exists())
    {
        $('.owl-slideshow').owlCarousel({
            items: 1,
            rewind: true,
            autoplay: true,
            loop: true,
            lazyLoad: false,
            mouseDrag: false,
            touchDrag: false,
            // animateIn: 'animate__animated animate__fadeInLeft',
            // animateOut: 'animate__animated animate__fadeOutRight',
            margin: 0,
            smartSpeed: 1000,
            autoplaySpeed: 1500,
            nav: false,
            dots: false
        });
        $('.prev-slideshow').click(function() {
            $('.owl-slideshow').trigger('prev.owl.carousel');
        });
        $('.next-slideshow').click(function() {
            $('.owl-slideshow').trigger('next.owl.carousel');
        });
        $(".owl-slideshow").on("change.owl.carousel", function(event){
            $('.slider-title').removeClass('animate__animated animate__rotateInDownLeft');
            $('.slider-desc').removeClass('animate__animated animate__lightSpeedInRight');
            $('.slider-more').removeClass('animate__animated animate__jackInTheBox');
        });
        $(".owl-slideshow").on("translate.owl.carousel", function(event){
            var item = event.item.index;
            $('.owl-slideshow .owl-item').eq(item).find('.slider-title').addClass('animate__animated animate__rotateInDownLeft');
            $('.owl-slideshow .owl-item').eq(item).find('.slider-desc').addClass('animate__animated animate__lightSpeedInRight');
            $('.owl-slideshow .owl-item').eq(item).find('.slider-more').addClass('animate__animated animate__jackInTheBox');
        });
    }

    if($(".owl-doitac").exists())
    {
        $('.owl-doitac').owlCarousel({
            items: 7,
            rewind: true,
            autoplay: true,
            loop: false,
            lazyLoad: false,
            mouseDrag: true,
            touchDrag: true,
            margin: 10,
            smartSpeed: 250,
            autoplaySpeed: 1000,
            nav: false,
            dots: false,
            responsiveClass:true,
            responsiveRefreshRate: 200,
            responsive: {
                0: {
                    items: 2,
                    margin: 10
                },
                400: {
                    items: 3,
                    margin: 10
                },
                600: {
                    items: 4,
                    margin: 10
                },
                768: {
                    items: 5,
                    margin: 10
                },
                992: {
                    items: 6,
                    margin: 10
                },
                1200: {
                    items: 7,
                    margin: 10
                }
            }
        });
        $('.prev-doitac').click(function() {
            $('.owl-doitac').trigger('prev.owl.carousel');
        });
        $('.next-doitac').click(function() {
            $('.owl-doitac').trigger('next.owl.carousel');
        });
    }

    if($(".owl-dichvu").exists())
    {
        $('.owl-dichvu').owlCarousel({
            items: 3,
            rewind: true,
            autoplay: true,
            loop: false,
            lazyLoad: false,
            mouseDrag: true,
            touchDrag: true,
            margin: 30,
            smartSpeed: 250,
            autoplaySpeed: 1000,
            nav: false,
            dots: false,
            responsiveClass:false,
            responsiveRefreshRate: 200,
            responsive: {
               
            }
        });
        $('.prev-dichvu').click(function() {
            $('.owl-dichvu').trigger('prev.owl.carousel');
        });
        $('.next-dichvu').click(function() {
            $('.owl-dichvu').trigger('next.owl.carousel');
        });
    }

     if($(".owl-tintuc").exists())
    {
        $('.owl-tintuc').owlCarousel({
            items: 2,
            rewind: true,
            autoplay: true,
            loop: false,
            lazyLoad: false,
            mouseDrag: true,
            touchDrag: true,
            margin: 30,
            smartSpeed: 250,
            autoplaySpeed: 1000,
            nav: false,
            dots: false,
            responsiveClass:false,
            responsiveRefreshRate: 200,
            responsive: {
               
            }
        });
        $('.prev-tintuc').click(function() {
            $('.owl-tintuc').trigger('prev.owl.carousel');
        });
        $('.next-tintuc').click(function() {
            $('.owl-tintuc').trigger('next.owl.carousel');
        });
    }
};

/* Owl pro detail */
NN_FRAMEWORK.OwlProDetail = function(){
    if($(".owl-thumb-pro").exists())
    {
        $('.owl-thumb-pro').owlCarousel({
            items: 4,
            lazyLoad: false,
            mouseDrag: true,
            touchDrag: true,
            margin: 10,
            smartSpeed: 250,
            nav: false,
            dots: false
        });
        $('.prev-thumb-pro').click(function() {
            $('.owl-thumb-pro').trigger('prev.owl.carousel');
        });
        $('.next-thumb-pro').click(function() {
            $('.owl-thumb-pro').trigger('next.owl.carousel');
        });
    }
};

/* Cart */
NN_FRAMEWORK.Cart = function(){
    $("body").on("click",".addcart",function(){
        var mau = ($(".color-pro-detail input:checked").val()) ? $(".color-pro-detail input:checked").val() : 0;
        var size = ($(".size-pro-detail input:checked").val()) ? $(".size-pro-detail input:checked").val() : 0;
        var id = $(this).data("id");
        var action = $(this).data("action");
        var quantity = ($(".qty-pro").val()) ? $(".qty-pro").val() : 1;

        if(id)
        {
            $.ajax({
                url:'ajax/ajax_cart.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: {cmd:'add-cart',id:id,mau:mau,size:size,quantity:quantity},
                success: function(result){
                    if(action=='addnow')
                    {
                        $('.count-cart').html(result.max);
                        $.ajax({
                            url:'ajax/ajax_cart.php',
                            type: "POST",
                            dataType: 'html',
                            async: false,
                            data: {cmd:'popup-cart'},
                            success: function(result){
                                $("#popup-cart .modal-body").html(result);
                                $('#popup-cart').modal('show');
                            }
                        });
                    }
                    else if(action=='buynow')
                    {
                        window.location = CONFIG_BASE + "gio-hang";
                    }
                }
            });
        }
    });

    $("body").on("click",".del-procart",function(){
        if(confirm(LANG['delete_product_from_cart']))
        {
            var code = $(this).data("code");
            var ship = $(".price-ship").val();

            $.ajax({
                type: "POST",
                url:'ajax/ajax_cart.php',
                dataType: 'json',
                data: {cmd:'delete-cart',code:code,ship:ship},
                success: function(result){
                    $('.count-cart').html(result.max);
                    if(result.max)
                    {
                        $('.price-temp').val(result.temp);
                        $('.load-price-temp').html(result.tempText);
                        $('.price-total').val(result.total);
                        $('.load-price-total').html(result.totalText);
                        $(".procart-"+code).remove();
                    }
                    else
                    {
                        $(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>'+LANG['no_products_in_cart']+'</p><span>'+LANG['back_to_home']+'</span></a>');
                    }
                }
            });
        }
    });

    $("body").on("click",".counter-procart",function(){
        var $button = $(this);
        var input = $button.parent().find("input");
        var id = input.data('pid');
        var code = input.data('code');
        var oldValue = $button.parent().find("input").val();
        if($button.text() == "+") quantity = parseFloat(oldValue) + 1;
        else if(oldValue > 1) quantity = parseFloat(oldValue) - 1;
        $button.parent().find("input").val(quantity);
        update_cart(id,code,quantity);
    });

    $("body").on("change","input.quantity-procat",function(){
        var quantity = $(this).val();
        var id = $(this).data("pid");
        var code = $(this).data("code");
        update_cart(id,code,quantity);
    });

    if($(".select-city-cart").exists())
    {
        $(".select-city-cart").change(function(){
            var id = $(this).val();
            load_district(id);
            load_ship();
        });
    }

    if($(".select-district-cart").exists())
    {
        $(".select-district-cart").change(function(){
            var id = $(this).val();
            load_wards(id);
            load_ship();
        });
    }

    if($(".select-wards-cart").exists())
    {
        $(".select-wards-cart").change(function(){
            var id = $(this).val();
            load_ship(id);
        });
    }

    if($(".payments-label").exists())
    {
        $(".payments-label").click(function(){
            var payments = $(this).data("payments");
            $(".payments-cart .payments-label, .payments-info").removeClass("active");
            $(this).addClass("active");
            $(".payments-info-"+payments).addClass("active");
        });
    }

    if($(".color-pro-detail").exists())
    {
        $(".color-pro-detail").click(function(){
            $(".color-pro-detail").removeClass("active");
            $(this).addClass("active");
            
            var id_mau=$("input[name=color-pro-detail]:checked").val();
            var idpro=$(this).data('idpro');

            $.ajax({
                url:'ajax/ajax_color.php',
                type: "POST",
                dataType: 'html',
                data: {id_mau:id_mau,idpro:idpro},
                success: function(result){
                    if(result!='')
                    {
                        $('.left-pro-detail').html(result);
                        MagicZoom.refresh("Zoom-1");
                        NN_FRAMEWORK.OwlProDetail();
                    }
                }
            });
        });
    }

    if($(".size-pro-detail").exists())
    {
        $(".size-pro-detail").click(function(){
            $(".size-pro-detail").removeClass("active");
            $(this).addClass("active");
        });
    }

    if($(".quantity-pro-detail span").exists())
    {
        $(".quantity-pro-detail span").click(function(){
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if($button.text() == "+")
            {
                var newVal = parseFloat(oldValue) + 1;
            }
            else
            {
                if(oldValue > 1) var newVal = parseFloat(oldValue) - 1;
                else var newVal = 1;
            }
            $button.parent().find("input").val(newVal);
        });
    }
};

/* Paging ajax */
NN_FRAMEWORK.PagingAjax = function(list,element,type,perpage){
    loadPagingAjax("ajax/ajax_paging.php?perpage="+perpage+"&idList="+list+"&type="+type,element);
};

/* Paging product */
NN_FRAMEWORK.PagingProduct = function(){
    if($(".paging-product-category").exists())
    {
        var list = $(".paging-product-category").data("list");
        NN_FRAMEWORK.PagingAjax(list, '.paging-product-category', 'product', 8);
        $(".product-list li").click(function(){
            list = $(this).data("list");
            $(".product-list li").removeClass("active");
            $(this).addClass("active");
            NN_FRAMEWORK.PagingAjax(list, '.paging-product-category', 'product', 8);
        });
    }
};

/* ToggleSearch */
NN_FRAMEWORK.ToggleSearch = function(){
    if($(".btn-search").exists())
    {
        $(".search_open").click(function(){
            $(".search_box_hide").toggleClass('opening');
        });
    }
};

/* Ready */
$(document).ready(function(){
    NN_FRAMEWORK.Tools();
    NN_FRAMEWORK.Popup();
    NN_FRAMEWORK.WowAnimation();
    NN_FRAMEWORK.AltImages();
    NN_FRAMEWORK.BackToTop();
    NN_FRAMEWORK.FixMenu();
    NN_FRAMEWORK.Mmenu();
    NN_FRAMEWORK.OwlPage();
    NN_FRAMEWORK.OwlProDetail();
    NN_FRAMEWORK.Toc();
    NN_FRAMEWORK.Cart();
    NN_FRAMEWORK.SimplyScroll();
    NN_FRAMEWORK.Tabs();
    NN_FRAMEWORK.Videos();
    NN_FRAMEWORK.Photobox();
    NN_FRAMEWORK.Search();
    NN_FRAMEWORK.DatetimePicker();
    // NN_FRAMEWORK.ToggleSearch();
    // NN_FRAMEWORK.PagingProduct();
});