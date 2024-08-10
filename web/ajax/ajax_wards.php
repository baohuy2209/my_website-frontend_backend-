<?php
	include "ajax_config.php";
	
	$id_district = (isset($_POST['id_district']) && $_POST['id_district'] > 0) ? htmlspecialchars($_POST['id_district']) : 0;
	$wards = null;
	if($id_district) $wards = $d->rawQuery("select ten, id from #_wards where id_district = ? order by id asc",array($id_district));

	if($wards)
	{ ?>  
		<option value=""><?=phuongxa?></option>
		<?php for($i=0;$i<count($wards);$i++) { ?>
			<option value="<?=$wards[$i]['id']?>"><?=$wards[$i]['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=phuongxa?></option>
	<?php }
?>