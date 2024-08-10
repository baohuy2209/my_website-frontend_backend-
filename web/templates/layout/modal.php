<?php if(isset($popup) && $popup['hienthi'] == 1) { ?>
	<!-- Modal popup -->
	<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<a href="<?=$popup['link']?>"><img src="<?=THUMBS?>/800x530x1/<?=UPLOAD_PHOTO_L.$popup['photo']?>" alt="Popup"></a>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<!-- Modal notify -->
<div class="modal modal-custom fade" id="popup-notify" tabindex="-1" role="dialog" aria-labelledby="popup-notify-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="popup-notify-label"><?=thongbao?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><?=thoat?></button>
			</div>
		</div>
	</div>
</div>

<?php if(isset($config['cart'])){ ?>
<!-- Modal cart -->
<div class="modal fade" id="popup-cart" tabindex="-1" role="dialog" aria-labelledby="popup-cart-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="popup-cart-label"><?=giohangcuaban?></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>
<?php } ?>