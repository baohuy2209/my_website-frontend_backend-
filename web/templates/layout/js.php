<!-- Js Config -->
<script type="text/javascript">
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var CONFIG_BASE = '<?=$config_base?>';
    var WEBSITE_NAME = '<?=(isset($setting['ten'.$lang]) && $setting['ten'.$lang] != '') ? addslashes($setting['ten'.$lang]) : ''?>';
    var TIMENOW = '<?=date("d/m/Y",time())?>';
    var SHIP_CART = <?=(isset($config['order']['ship']) && $config['order']['ship'] == true) ? 'true' : 'false'?>;
    var GOTOP = 'assets/images/top.png';
    var LANG = {
        'no_keywords': '<?=chuanhaptukhoatimkiem?>',
        'delete_product_from_cart': '<?=banmuonxoasanphamnay?>',
        'no_products_in_cart': '<?=khongtontaisanphamtronggiohang?>',
        'wards': '<?=phuongxa?>',
        'back_to_home': '<?=vetrangchu?>',
    };
</script>

<!-- Js Files -->
<?php
    $js->setCache("cached");
    $js->setJs("./assets/js/jquery.min.js");
    $js->setJs("./assets/bootstrap/bootstrap.js");
    $js->setJs("./assets/js/wow.min.js");
    $js->setJs("./assets/mmenu/mmenu.js");
    $js->setJs("./assets/simplyscroll/jquery.simplyscroll.js");
    $js->setJs("./assets/fotorama/fotorama.js");
    $js->setJs("./assets/owlcarousel2/owl.carousel.js");
    $js->setJs("./assets/magiczoomplus/magiczoomplus.js");
    // $js->setJs("./assets/slick/slick.js");
    $js->setJs("./assets/fancybox3/jquery.fancybox.js");
    $js->setJs("./assets/photobox/photobox.js");
    $js->setJs("./assets/datetimepicker/php-date-formatter.min.js");
    $js->setJs("./assets/datetimepicker/jquery.mousewheel.js");
    $js->setJs("./assets/datetimepicker/jquery.datetimepicker.js");
    $js->setJs("./assets/toc/toc.js");
    $js->setJs("./assets/js/functions.js");
    $js->setJs("./assets/js/apps.js");
    echo $js->getJs();
?>

<?php if(isset($config['googleAPI']['recaptcha']['active']) && $config['googleAPI']['recaptcha']['active'] == true) { ?>
    <!-- Js Google Recaptcha V3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?=$config['googleAPI']['recaptcha']['sitekey']?>"></script>
    <script type="text/javascript">
        grecaptcha.ready(function () {
            grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'Newsletter' }).then(function (token) {
                var recaptchaResponseNewsletter = document.getElementById('recaptchaResponseNewsletter');
                recaptchaResponseNewsletter.value = token;
            });
            <?php if($source=='contact') { ?>
                grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'contact' }).then(function (token) {
                    var recaptchaResponseContact = document.getElementById('recaptchaResponseContact');
                    recaptchaResponseContact.value = token;
                });
            <?php } ?>
        });
    </script>
<?php } ?>

<?php if(isset($config['oneSignal']['active']) && $config['oneSignal']['active'] == true) { ?>
    <!-- Js OneSignal -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript">
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?=$config['oneSignal']['id']?>"
            });
        });
    </script>
<?php } ?>

<!-- Js Structdata -->
<?php include TEMPLATE.LAYOUT."strucdata.php"; ?>

<!-- Js Addons -->
<?=$addons->setAddons('script-main', 'script-main', 0.5);?>
<?=$addons->getAddons();?>

<!-- Js Body -->
<?=htmlspecialchars_decode($setting['bodyjs'])?>