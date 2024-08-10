<div id="menu-mobile">
    <div class="menu-bar-res">
        <a id="hamburger" href="#mmenu" title="Menu"><span></span></a>
    </div>
    <nav id="mmenu">
        <ul>
            <div class="search_mobi">
                <input type="text" id="keyword2" placeholder="<?=nhaptukhoatimkiem?>" onkeypress="doEnter(event,'keyword2');" value="">
                <i class="fa fa-search" aria-hidden="true" onclick="onSearch('keyword2');"></i>
            </div>
            <?php if(count($splistmenu)) { ?>
            <li class="heading"><?=danhmucsanpham?></li>
                <?php for($i=0;$i<count($splistmenu); $i++) {
                    $spcatmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_product_cat where id_list = ? and hienthi > 0 order by stt,id desc",array($splistmenu[$i]['id'])); ?>
                    <li>
                        <a class="transition" title="<?=$splistmenu[$i]['ten']?>" href="<?=$splistmenu[$i][$sluglang]?>"><h2><?=$splistmenu[$i]['ten']?></h2></a>
                        <?php if(count($spcatmenu)>0) { ?>
                            <ul>
                                <?php for($j=0;$j<count($spcatmenu);$j++) {
                                    $spitemmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_product_item where id_cat = ? and hienthi > 0 order by stt,id desc",array($spcatmenu[$j]['id'])); ?>
                                    <li>
                                        <a class="transition" title="<?=$spcatmenu[$j]['ten']?>" href="<?=$spcatmenu[$j][$sluglang]?>"><h2><?=$spcatmenu[$j]['ten']?></h2></a>
                                        <?php if(count($spitemmenu)) { ?>
                                            <ul>
                                                <?php for($u=0;$u<count($spitemmenu);$u++) {
                                                    $spsubmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_product_sub where id_item = ? and hienthi > 0 order by stt,id desc",array($spitemmenu[$u]['id'])); ?>
                                                    <li>
                                                        <a class="transition" title="<?=$spitemmenu[$u]['ten']?>" href="<?=$spitemmenu[$u][$sluglang]?>"><h2><?=$spitemmenu[$u]['ten']?></h2></a>
                                                        <?php if(count($spsubmenu)) { ?>
                                                            <ul>
                                                                <?php for($s=0;$s<count($spsubmenu);$s++) { ?>
                                                                    <li>
                                                                        <a class="transition" title="<?=$spsubmenu[$s]['ten']?>" href="<?=$spsubmenu[$s][$sluglang]?>"><h2><?=$spsubmenu[$s]['ten']?></h2></a>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            <?php } ?>

            <li class="heading"><?=chuyenmuc?></li>
            <li>
                <a class="transition <?php if($com=='' || $com=='index') echo 'active'; ?>" href="" title="<?=trangchu?>"><?=trangchu?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='gioi-thieu') echo 'active'; ?>" href="gioi-thieu" title="<?=gioithieu?>"><?=gioithieu?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='san-pham') echo 'active'; ?>" href="san-pham" title="<?=sanpham?>"><?=sanpham?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='tin-tuc') echo 'active'; ?>" href="tin-tuc" title="<?=tintuc?>"><?=tintuc?></a>
                <?php if(count($ttlistmenu)) { ?>
                    <ul>
                        <?php for($i=0;$i<count($ttlistmenu); $i++) {
                            $ttcatmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_news_cat where id_list = ? and hienthi > 0 order by stt,id desc",array($ttlistmenu[$i]['id'])); ?>
                            <li>
                                <a class="transition" title="<?=$ttlistmenu[$i]['ten']?>" href="<?=$ttlistmenu[$i][$sluglang]?>"><h2><?=$ttlistmenu[$i]['ten']?></h2></a>
                                <?php if(count($ttcatmenu)>0) { ?>
                                    <ul>
                                        <?php for($j=0;$j<count($ttcatmenu);$j++) {
                                            $ttitemmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_news_item where id_cat = ? and hienthi > 0 order by stt,id desc",array($ttcatmenu[$j]['id'])); ?>
                                            <li>
                                                <a class="transition" title="<?=$ttcatmenu[$j]['ten']?>" href="<?=$ttcatmenu[$j][$sluglang]?>"><h2><?=$ttcatmenu[$j]['ten']?></h2></a>
                                                <?php if(count($ttitemmenu)) { ?>
                                                    <ul>
                                                        <?php for($u=0;$u<count($ttitemmenu);$u++) {
                                                            $ttsubmenu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen, id from #_news_sub where id_item = ? and hienthi > 0 order by stt,id desc",array($ttitemmenu[$u]['id'])); ?>
                                                            <li>
                                                                <a class="transition" title="<?=$ttitemmenu[$u]['ten']?>" href="<?=$ttitemmenu[$u][$sluglang]?>"><h2><?=$ttitemmenu[$u]['ten']?></h2></a>
                                                                <?php if(count($ttsubmenu)) { ?>
                                                                    <ul>
                                                                        <?php for($s=0;$s<count($ttsubmenu);$s++) { ?>
                                                                            <li>
                                                                                <a class="transition" title="<?=$ttsubmenu[$s]['ten']?>" href="<?=$ttsubmenu[$s][$sluglang]?>"><h2><?=$ttsubmenu[$s]['ten']?></h2></a>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                <?php } ?>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
            <li>
                <a class="transition <?php if($com=='tuyen-dung') echo 'active'; ?>" href="tuyen-dung" title="<?=tuyendung?>"><?=tuyendung?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='thu-vien-anh') echo 'active'; ?>" href="thu-vien-anh" title="<?=thuvienanh?>"><?=thuvienanh?></a>
            </li>
            <li>
                <a class="transition <?php if($com=='video') echo 'active'; ?>" href="video" title="Video">Video</a>
            </li>
            <li>
                <a class="transition <?php if($com=='lien-he') echo 'active'; ?>" href="lien-he" title="<?=lienhe?>"><?=lienhe?></a>
            </li>
        </ul>
    </nav>
</div>