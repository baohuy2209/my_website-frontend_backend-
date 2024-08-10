<?php
	if(!defined('LIBRARIES')) die("Error");
	
	/* Root */
	define('ROOT',__DIR__);

	/* Timezone */
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	/* Cấu hình coder */
	define('NN_MSHD','MSHD');
	define('NN_AUTHOR','nguyenhuungocduy.nina@gmail.com');

	/* Cấu hình chung */
	$config = array(
		'author' => array(
			'name' => 'Huỳnh Ngọc Chính',
			'email' => 'chinhhuynh.nina@gmail.com',
			'timefinish' => '10/2020'
		),
		'arrayDomainSSL' => array(),
		'database' => array(
			'server-name' => $_SERVER["SERVER_NAME"],
			'url' => '/chinh_18606/trankimhue_2841220w/',
			'type' => 'mysql',
			'host' => 'localhost',
			'username' => 'demo49_sondb',
			'password' => 'xPBPmiJu',
			'dbname' => 'demo49_sondb',
			'port' => 3306,
			'prefix' => 'table_',
			'charset' => 'utf8'
		),
		'website' => array(
			'error-reporting' => true,
			'secret' => '$nina@',
			'salt' => '0jc@])oYpb',
			'default_pass' => 'VQBNC7',
			'default_md5' => 'c0069ffd09243375e9f3374724d82c08',
			'debug-developer' => true,
			'debug-css' => true,
			'debug-js' => true,
			'index' => false,
			'upload' => array(
				'max-width' => 1600,
				'max-height' => 1600
			),
			'lang' => array(
				'vi'=>'Tiếng Việt',
				// 'en'=>'Tiếng Anh'
			),
			'lang-doc' => 'vi|en',
			'slug' => array(
				'vi'=>'Tiếng Việt',
				// 'en'=>'Tiếng Anh'
			),
			'seo' => array(
				'vi'=>'Tiếng Việt',
				// 'en'=>'Tiếng Anh'
			),
			'comlang' => array(
				"gioi-thieu" => array("vi"=>"gioi-thieu","en"=>"about-us"),
				"san-pham" => array("vi"=>"san-pham","en"=>"product"),
				"tin-tuc" => array("vi"=>"tin-tuc","en"=>"news"),
				"thu-vien-anh" => array("vi"=>"thu-vien-anh","en"=>"gallery"),
				"video" => array("vi"=>"video","en"=>"video"),
				"lien-he" => array("vi"=>"lien-he","en"=>"contact")
			)
		),
		'googleAPI' => array(
			'recaptcha' => array(
				'active' => false,
				'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
				'sitekey' => '6LezS5kUAAAAAF2A6ICaSvm7R5M-BUAcVOgJT_31',
				'secretkey' => '6LezS5kUAAAAAGCGtfV7C1DyiqlPFFuxvacuJfdq'
			)
		),
		'cart' => array(
			'active' => false
		),
		'order' => array(
			'ship' => false
		),
		'oneSignal' => array(
			'active' => false,
			'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
			'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
		),
		'login' => array(
			'admin' => 'LoginAdmin'.NN_MSHD,
			'member' => 'LoginMember'.NN_MSHD,
			'attempt' => 5,
			'delay' => 15
		),
		'license' => array(
			'version' => "7.0.0",
			'powered' => "nguyenhuungocduy.nina@gmail.com"
		)
	);

	/* Error reporting */
	error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

	/* Cấu hình base */
	$http = 'http://';
	$config_url = $config['database']['server-name'].$config['database']['url'];
	$config_base = $http.$config_url;

	/* Cấu hình login */
	$login_admin = $config['login']['admin'];
	$login_member = $config['login']['member'];

	/* Cấu hình upload */
	require_once LIBRARIES."constant.php";
?>