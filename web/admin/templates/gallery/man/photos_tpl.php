<?php
    $linkParent = "index.php?com=".$com."&act=".$kind."&type=".$type."&p=".$curPage;
    $linkMan = "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
    $linkAdd = "index.php?com=".$com."&act=add_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
    $linkEdit = "index.php?com=".$com."&act=edit_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
    $linkDelete = "index.php?com=".$com."&act=delete_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý <?=$config[$com][$type][$dfgallery][$val]['title_main_photo']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <a class="btn btn-sm bg-gradient-secondary" href="<?=$linkParent?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách <?=$config[$com][$type][$dfgallery][$val]['title_main_photo']?></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle text-center" width="10%">STT</th>
                        <?php if(isset($config[$com][$type][$dfgallery][$val]['avatar_photo']) && $config[$com][$type][$dfgallery][$val]['avatar_photo'] == true) { ?>
                        	<th class="align-middle text-center" width="8%">Hình</th>
				        <?php } ?>
                        <?php if(isset($config[$com][$type][$dfgallery][$val]['tieude_photo']) && $config[$com][$type][$dfgallery][$val]['tieude_photo'] == true) { ?>
				        	<th class="align-middle" style="width:30%">Tiêu đề</th>
				        <?php } ?>
				        <?php if(isset($config[$com][$type][$dfgallery][$val]['cart_photo']) && $config[$com][$type][$dfgallery][$val]['cart_photo'] == true) { ?>
				        	<th class="align-middle">Màu sắc (Giỏ hàng)</th>
				        <?php } ?>
				        <?php if(isset($config[$com][$type][$dfgallery][$val]['file_photo']) && $config[$com][$type][$dfgallery][$val]['file_photo'] == true) { ?>
				        	<th class="align-middle">Tập tin</th>
				        <?php } ?>
				        <?php if(isset($config[$com][$type][$dfgallery][$val]['video_photo']) && $config[$com][$type][$dfgallery][$val]['video_photo'] == true) { ?>
				        	<th class="align-middle">Video</th>
				        <?php } ?>
                        <th class="align-middle text-center">Hiển thị</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                </thead>
                <?php if(empty($items)) { ?>
                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                <?php } else { ?>
                    <tbody>
                        <?php for($i=0;$i<count($items);$i++) { ?>
                            <tr>
                                <td class="align-middle">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="gallery">
                                </td>
                                <?php if(isset($config[$com][$type][$dfgallery][$val]['avatar_photo']) && $config[$com][$type][$dfgallery][$val]['avatar_photo'] == true) { ?>
	                                <td class="align-middle text-center">
	                                    <a href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/<?=$config[$com][$type][$dfgallery][$val]['thumb_photo']?>/<?="upload/".$com."/".$items[$i]['photo']?>" alt="<?=$items[$i]['tenvi']?>"></a>
	                                </td>
	                            <?php } ?>
                                <?php if(isset($config[$com][$type][$dfgallery][$val]['tieude_photo']) && $config[$com][$type][$dfgallery][$val]['tieude_photo'] == true) { ?>
	                                <td class="align-middle">
	                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><?=$items[$i]['tenvi']?></a>
	                                </td>
	                            <?php } ?>
                                <?php if(isset($config[$com][$type][$dfgallery][$val]['cart_photo']) && $config[$com][$type][$dfgallery][$val]['cart_photo'] == true) { ?>
						        	<td class="align-middle">
						        		<?php $mauDetail = $func->get_color_cart($items[$i]['id_mau']); ?>
										<?php if(isset($mauDetail['loaihienthi']) && $mauDetail['loaihienthi']==0) { ?>
                                            <span class="color-preview rounded" style="background-color:#<?=$mauDetail['mau']?>"></span>
										<?php } else { ?>
											<img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=UPLOAD_COLOR_L.$mauDetail['photo']?>" alt="<?=$mauDetail['tenvi']?>">
										<?php } ?>
						        	</td>
						        <?php } ?>
						        <?php if(isset($config[$com][$type][$dfgallery][$val]['file_photo']) && $config[$com][$type][$dfgallery][$val]['file_photo'] == true) { ?>
						        	<td class="align-middle">
						        		<?php if(isset($items[$i]['taptin']) && ($items[$i]['taptin'] != '')) { ?>
											<a class="btn btn-sm bg-gradient-primary text-white d-inline-block p-1 rounded" href="<?=UPLOAD_FILE.$items[$i]['taptin']?>" title="Download tập tin"><i class="fas fa-download mr-2"></i>Download tập tin</a>
										<?php } else { ?>
											<a class="bg-gradient-secondary text-white d-inline-block p-1 rounded" href="#" title="Tập tin trống"><i class="fas fa-download mr-2"></i>Tập tin trống</a>
										<?php } ?>
						        	</td>
						        <?php } ?>
                                <?php if(isset($config[$com][$type][$dfgallery][$val]['video_photo']) && $config[$com][$type][$dfgallery][$val]['video_photo'] == true) { ?>
                                	<td class="align-middle"><?=$items[$i]['link_video']?></td>
                                <?php } ?>
								<td class="align-middle text-center">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="gallery" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                        <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">
                                    <a class="text-primary mr-2" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                    <a class="text-danger" id="delete-item" data-url="<?=$linkDelete?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php if($paging) { ?>
        <div class="card-footer text-sm pb-0">
            <?=$paging?>
        </div>
    <?php } ?>
    <div class="card-footer text-sm">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <a class="btn btn-sm bg-gradient-secondary" href="<?=$linkParent?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
</section>