<ul class="h-card hidden">
    <li class="h-fn fn"><?=$setting['ten'.$lang]?></li>
    <li class="h-org org"><?=$setting['ten'.$lang]?></li>
    <li class="h-tel tel"><?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?></li>
    <li><a class="u-url ul" href="<?=$config_base?>"><?=$config_base?></a></li>
</ul>
<?php if($source=='index'){ ?><h1 class="hidden-seoh"><?=$seo->getSeo('h1')?></h1><?php } ?>