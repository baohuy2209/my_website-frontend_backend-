<?php
	include "ajax_config.php";
	
	$id_city = (isset($_POST['id_city']) && $_POST['id_city'] > 0) ? htmlspecialchars($_POST['id_city']) : 0;
	$district = null;
	if($id_city) $district = $d->rawQuery("select ten, id from #_district where id_city = ? order by id asc",array($id_city));

	if($district)
	{ ?>  
		<option value=""><?=quanhuyen?></option>
		<?php for($i=0;$i<count($district);$i++) { ?>
			<option value="<?=$district[$i]['id']?>"><?=$district[$i]['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=quanhuyen?></option>
	<?php }
?>