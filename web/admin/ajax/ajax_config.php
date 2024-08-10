<?php
	session_start();
	define('LIBRARIES','../../libraries/');
	define('SOURCES','../sources/');
	define('THUMBS','thumbs');

    require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $d = new PDODb($config['database']);
    $func = new Functions($d);
    $cache = new FileCache($d);

    if($func->check_login()==false) { die(); }
?>