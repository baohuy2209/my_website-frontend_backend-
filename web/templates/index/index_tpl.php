<?php if($gioithieu['mota'] != '' || $gioithieu['photo'] != '') { ?>
	<div id="gioithieu">
		<div class="center d-flex flex-wrap align-items-start justify-content-between">
			<div class="gioithieu-trai">
				<div class="gioithieu-tit">
					<p><?=$gioithieu['ten']?></p>
					<div><span><?=$setting['ten'.$lang]?></span></div>
				</div>
				<div class="gioithieu-desc">
					<?=htmlspecialchars_decode($gioithieu['mota'])?>
				</div>
				<a class="xemthem text-decoration-none" href="gioi-thieu"><?=xemthem?></a>
			</div>
			<div class="gioithieu-phai">
				<a class="text-decoration-none scale-img" href="gioi-thieu">
					<img onerror="this.src='<?=THUMBS?>/580x432x2/assets/images/noimage.png';" src="<?=THUMBS?>/580x432x1/<?=UPLOAD_NEWS_L.$gioithieu['photo']?>"/>
				</a>
			</div>
		</div>
	</div>
<?php } ?>

<?php if(count($danhmuc1sanphamnb)) { ?>
	<div id="sanpham">
		<?php for($i=0,$count=count($danhmuc1sanphamnb); $i < $count; $i++) { ?>
			<div class="sanpham center">
				<div class="title-main"><span><?=$danhmuc1sanphamnb[$i]['ten']?></span></div>
				<div class="paging-product-category paging-product-category-<?=$danhmuc1sanphamnb[$i]['id']?>" data-list="<?=$danhmuc1sanphamnb[$i]['id']?>"></div>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<?php if(count($dichvunb)) { ?>
<div id="dichvu1">
	<div class="center">
		<div class="box-title">
			<h2 class="title-intro">Dịch vụ</h2>
		</div>
		<div class="w-clear">
			<div class="d-flex justify-content-between">
				<div class="owl-carousel owl-theme owl-dichvu">
					<?php for($i=0,$count=count($dichvunb); $i < $count; $i++) { ?>
						<div class="box-dichvu">
							<div class="pic-product">
								<a class="text-decoration-none scale-img" href="<?=$dichvunb[$i][$sluglang]?>" title="<?=$dichvunb[$i]['ten']?>">
								<img onerror="this.src='<?=THUMBS?>/373x273x2/assets/images/noimage.png';" src="<?=THUMBS?>/373x273x1/<?=UPLOAD_NEWS_L.$dichvunb[$i]['photo']?>" alt="<?=$dichvunb[$i]['ten']?>">
								</a>
							</div>
							<div class="content-product d-flex">
								<div class="content-main-dichvu">
									<h2 class="name-dichvu">
										<a class="text-decoration-none text-split text-split-2" href="<?=$dichvunb[$j][$sluglang]?>" title="">
											<?=$dichvunb[$i]['ten']?>
										</a>
									</h2>
									<div class="description">
										<p class=" text-split "> 
											<?=htmlspecialchars_decode($dichvunb[$i]['mota'])?>
										</p>
									</div>
								</div>
							</div>
						</div>	
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<?php if(isset($quangcao) && $quangcao['photo']!='') { ?>
	<div id="quangcao">
		<a href="<?=$quangcao['link']?>" target="_blank"><img onerror="this.src='<?=THUMBS?>/1366x350x2/assets/images/noimage.png';" src="<?=THUMBS?>/1366x350x1/<?=UPLOAD_PHOTO_L.$quangcao['photo']?>" alt="<?=$quangcao['ten']?>"/></a>
	</div>
<?php } ?>

<?php if(count($tintucnb)) { ?>
	<div id="bottom">
		<div class="center ">
			<div class="bottom-title"><h2>Tin tức mới</h2></div>
			<div class="w-clear">
				<div class="d-flex justify-content-between">
					<div class="owl-carousel owl-theme owl-tintuc">
						<?php for($i=0,$count=count($tintucnb); $i < $count; $i++) { ?>
							<div class="box-tintuc">
								<div class="pic-tintuc">
									<a class="text-decoration-none scale-img" href="<?=$tintucnb[$i][$sluglang]?>" title="<?=$tintucnb[$i]['ten']?>">
									<img onerror="this.src='<?=THUMBS?>/310x270x2/assets/images/noimage.png';" src="<?=THUMBS?>/310x270x1/<?=UPLOAD_NEWS_L.$tintucnb[$i]['photo']?>" alt="<?=$tintucnb[$i]['ten']?>">
									</a>
								</div>
								<div class="content-main-tintuc">
									<div class="time-news"><?=ngaydang?>: <?=date("d/m/Y",$tintucnb[$i]['ngaytao'])?></div>
									<h2 class="name-tintuc">
										<a class="text-decoration-none text-split text-split-2" href="<?=$tintucnb[$i][$sluglang]?>" title="<?=$tintucnb[$i]['ten']?>">
											<?=$tintucnb[$i]['ten']?>
										</a>
									</h2>
									<div class="description">
										<p class=" text-split "> 
											<?=htmlspecialchars_decode($tintucnb[$i]['mota'])?>
										</p>
									</div>
									<a class="link-detail" href="<?=$tintucnb[$i][$sluglang]?>">Xem chi tiết</a>
								</div>
							</div>	
						<?php } ?>
					</div>
				</div>
			</div>       
		</div>
	</div>
<?php } ?>

<div id="subsribe">
	<div class="center">
		<div class="form-subscribe">
			<div class="title-subscribe">
				<h2>Liên hệ tư vấn</h2>
			</div>
			<div class="form-to-subscribe">
				<form class="form-contact validation-contact" novalidate method="post" action="" enctype="multipart/form-data">
						<div class="general-information">
				            <div class="row m-0">
				                <div class="input-contact col-sm-6 pr-lg-2 pr-md-2 pr-sm-2 p-0">
				                    <input type="text" class="form-control" id="ten" name="ten" placeholder="<?=hoten?>" required />
				                    <div class="invalid-feedback"><?=vuilongnhaphoten?></div>
				                </div>
				                <div class="input-contact col-sm-6 pl-lg-2 pl-md-2 pl-sm-2 p-0">
				                    <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?=sodienthoai?>" required />
				                    <div class="invalid-feedback"><?=vuilongnhapsodienthoai?></div>
				                </div>
				            </div>
				            <div class="row m-0">
				                <div class="input-contact col-sm-6 pr-lg-2 pr-md-2 pr-sm-2 p-0">
				                    <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?=diachi?>" required />
				                    <div class="invalid-feedback"><?=vuilongnhapdiachi?></div>
				                </div>
				                <div class="input-contact col-sm-6 pl-lg-2 pl-md-2 pl-sm-2 p-0">
				                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
				                    <div class="invalid-feedback"><?=vuilongnhapdiachiemail?></div>
				                </div>
				            </div>
				        </div>
			            <div class="input-contact content-enclosed row m-0">
			                <textarea class="form-control" id="noidung" name="noidung" placeholder="<?=noidung?>" required /></textarea>
			                <div class="invalid-feedback"><?=vuilongnhapnoidung?></div>
			            </div>
			             <input type="submit" class="btn btn-primary btn-sent" name="submit-contact" value="Đặt bàn ngay" disabled />
			            <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
		        </form>
			</div>
		</div>
	</div>
</div>

