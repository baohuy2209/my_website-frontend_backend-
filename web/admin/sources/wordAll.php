<?php
	define('LIBRARIES','./libraries/');

	require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $injection = new AntiSQLInjection();
    $d = new PDODb($config['database']);
    $func = new Functions($d);
	
	/* Kiểm tra có đăng nhập chưa */
	if($func->check_login()==false && $act!="login")
	{
		$func->redirect("index.php?com=user&act=login");
	}

	/* Kiểm tra active export word */
	if(!isset($config['order']['wordall']) || $config['order']['wordall'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Setting */
	$setting = $d->rawQueryOne("select * from #_setting limit 0,1");
	$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;

	/* Thông tin đơn hàng */
	$time = time();
	$sql = "select * from #_order where id<>0";

	$listid = (isset($_REQUEST['listid'])) ? htmlspecialchars($_REQUEST['listid']) : '';
	$tinhtrang = (isset($_REQUEST['tinhtrang'])) ? htmlspecialchars($_REQUEST['tinhtrang']) : 0;
	$httt = (isset($_REQUEST['httt'])) ? htmlspecialchars($_REQUEST['httt']) : 0;
	$ngaydat = (isset($_REQUEST['ngaydat'])) ? htmlspecialchars($_REQUEST['ngaydat']) : '';
	$khoanggia = (isset($_REQUEST['khoanggia'])) ? htmlspecialchars($_REQUEST['khoanggia']) : '';
	$city = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;
	$district = (isset($_REQUEST['id_district'])) ? htmlspecialchars($_REQUEST['id_district']) : 0;
	$wards = (isset($_REQUEST['id_wards'])) ? htmlspecialchars($_REQUEST['id_wards']) : 0;

	if($listid) $sql .= " and id IN ($listid)";
	if($tinhtrang) $sql .= " and tinhtrang=$tinhtrang";
	if($httt) $sql .= " and httt=$httt";
	if($ngaydat)
	{
		$ngaydat = explode("-",$ngaydat);
		$ngaytu = trim($ngaydat[0]);
		$ngayden = trim($ngaydat[1]);
		$ngaytu = strtotime(str_replace("/","-",$ngaytu));
		$ngayden = strtotime(str_replace("/","-",$ngayden));
		$sql .= " and ngaytao<=$ngayden and ngaytao>=$ngaytu";
	}
	if($khoanggia)
	{
		$khoanggia = explode(";",$khoanggia);
		$giatu = trim($khoanggia[0]);
		$giaden = trim($khoanggia[1]);
		$sql .= " and tonggia<=$giaden and tonggia>=$giatu";
	}
	if($city) $sql .= " and city=$city";
	if($district) $sql .= " and district=$district";
	if($wards) $sql .= " and wards=$wards";
	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$sql .= " and (hoten LIKE '%$keyword%' or email LIKE '%$keyword%' or dienthoai LIKE '%$keyword%' or madonhang LIKE '%$keyword%')";
	}

	$sql .= " order by ngaytao desc";
	$donhang = $d->rawQuery($sql);

	/* PHPWord */
	require_once LIBRARIES.'PHPWord.php';

	/* Khởi tạo PHPWord */
	$PHPWord = new PHPWord();

	/* file sample */
	$filemau = LIBRARIES.'sample/orderlist.docx';

	/* Load file Word mẫu */
	$document = $PHPWord->loadTemplate($filemau);

	/* Thông tin công ty */
	$document->setValue('{tencty}', $setting["tenvi"]);
	$document->setValue('{hotlinecty}', $optsetting["hotline"]);
	$document->setValue('{emailcty}', $optsetting["email"]);
	$document->setValue('{diachicty}', $optsetting["diachi"]);

	/* Tạo danh sách đơn hàng */
	$data = array();
	for($i=0;$i<count($donhang);$i++) 
	{
		/* Phí ship */
		if(isset($donhang[$i]['phiship']) && $donhang[$i]['phiship'] > 0) $phiship = $func->format_money(@$donhang[$i]['phiship']);
		else $phiship = "Không";

		/* Trang thái */
		$trangthai = $d->rawQueryOne("select trangthai from #_status where id = ? limit 0,1",array($donhang[$i]['tinhtrang']));

		/* STT */
		$data["stt"][$i] = $i+1;

		/* Thông tin đơn hàng */
		$data["madonhang"][$i] = @$donhang[$i]['madonhang'];
		$data["ngaydat"][$i] = date('H:i A d-m-Y',@$donhang[$i]['ngaytao']);
		$data["tinhtrang"][$i] = $trangthai['trangthai'];
		$data["httt"][$i] = $func->get_payments(@$donhang[$i]['httt']);

		/* Thông tin khách hàng */
		$data["hotenkh"][$i] = @$donhang[$i]['hoten'];
		$data["dienthoaikh"][$i] = @$donhang[$i]['dienthoai'];
		$data["emailkh"][$i] = @$donhang[$i]['email'];
		$data["diachikh"][$i] = @$donhang[$i]['diachi'];

		/* Tính thành tiền */
		$data["tamtinh"][$i] = $func->format_money(@$donhang[$i]['tamtinh']);
		$data["phiship"][$i] = $phiship;
		$data["tonggia"][$i] = $func->format_money(@$donhang[$i]['tonggia']);
	}
	
	/* Thiết lập đối tượng dữ liệu từng dòng */
	$document->cloneRow('TB', $data);
	
	/* Xuất file */
	$filename = "orders_list".$time."_".date('d_m_Y').".docx";
	$document->save($filename);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: '. filesize($filename));
	flush();
	readfile($filename);
	unlink($filename);
?>