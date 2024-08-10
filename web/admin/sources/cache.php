<?php	
	if(!defined('SOURCES')) die("Error");

	switch($act)
	{
		case "delete":
			deleteCache();
			break;

		default:
			$template = "404";
	}

	/* Delete cache */
	function deleteCache()
	{
		global $func, $cache;

		if($cache->DeleteCache()) $func->transfer("Xóa cache thành công", "index.php");
		else $func->transfer("Xóa cache thất bại", "index.php", false);
	}
?>