<?php
	include "ajax_config.php";

	if(isset($_POST["id"]))
	{
		$level = (isset($_POST["level"])) ? htmlspecialchars($_POST["level"]) : 0;
		$table = (isset($_POST["table"])) ? htmlspecialchars($_POST["table"]) : '';
		$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]) : 0;
		$type = (isset($_POST["type"])) ? htmlspecialchars($_POST["type"]) : '';
		$row = null;

		switch($level)
		{
			case '0':
				$id_temp = "id_list";
				break;

			case '1':
				$id_temp = "id_cat";
				break;

			case '2':
				$id_temp = "id_item";
				break;

			default:
				echo 'error ajax';
				exit();
				break;
		}

		if($id)
		{
			$row = $d->rawQuery("select tenvi, id from $table where $id_temp = ? and type = ? order by stt,id desc",array($id,$type));
		}

		$str = '<option value="0">Chọn danh mục</option>';
		if($row)
		{
			foreach($row as $v)
			{
				$str .= '<option value='.$v["id"].'>'.$v["tenvi"].'</option>';
			}
		}
		echo $str;
	}
?>