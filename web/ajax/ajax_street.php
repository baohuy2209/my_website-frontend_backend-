<?php
	include "ajax_config.php";
	
	$id_wards = (isset($_POST['id_wards']) && $_POST['id_wards'] > 0) ? htmlspecialchars($_POST['id_wards']) : 0;
	$street = null;
	if($id_wards) $street = $d->rawQuery("select ten, id from #_street where id_wards = ? order by id asc",array($id_wards));

	if($street)
	{ ?>
		<option value=""><?=duong?></option>
		<?php for($i=0;$i<count($street);$i++) { ?>
			<option value="<?=$street[$i]['id']?>"><?=$street[$i]['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=duong?></option>
	<?php }
?>