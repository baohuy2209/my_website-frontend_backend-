<?php
	require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $injection = new AntiSQLInjection();
    $d = new PDODb($config['database']);
    $func = new Functions($d);
	
	/* Kiểm tra có đăng nhập chưa */
	if($func->check_login() == false && $act != "login")
	{
		$func->redirect("index.php?com=user&act=login");
	}

	/* Kiểm tra active export excel */
	if(!isset($config['order']['excelall']) || $config['order']['excelall'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	
	/* Setting */
	$setting = $d->rawQueryOne("select * from #_setting limit 0,1");
	$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;
		
	/* Thông tin đơn hàng */
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
	
	/* PHPExcel */
	require_once LIBRARIES.'PHPExcel.php';

	/* Khởi tọa đối tượng */
	$PHPExcel = new PHPExcel();
	$PHPExcelStyleTitle = new PHPExcel_Style();
	$PHPExcelStyleContent = new PHPExcel_Style();

	/* Khởi tạo thông tin người tạo */
	$PHPExcel->getProperties()->setCreator($setting['tenvi']);
	$PHPExcel->getProperties()->setLastModifiedBy($setting['tenvi']);
	$PHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
	$PHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
	$PHPExcel->getProperties()->setDescription("Document for Office 2007 XLSX, generated using PHP classes.");

	/* Merge cells */
	$PHPExcel->setActiveSheetIndex(0);
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A1:L1');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A2:L2');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A3:L3');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A4:L4');

	/* set Cell Value */
	$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
	$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
	$PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$setting['tenvi']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Hotline: '.$optsetting['hotline']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A3','Email: '.$optsetting['email']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A4','Địa chỉ: '.$optsetting['diachi']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A6','STT');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('B6','Mã đơn hàng');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('C6','Ngày đặt');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('D6','Tình trạng');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('E6','Hình thức thanh toán');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('F6','Họ tên');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('G6','Điện thoại');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('H6','Email');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('I6','Địa chỉ');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('J6','Tạm tính');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('K6','Phí vận chuyển');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('L6','Tổng giá trị đơn hàng');

	/* Style */
	$PHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
		array(
			'font'=>array(
				'color'=>array(
					'rgb'=>'000000'
				),
				'name'=>'Arial',
				'bold'=>true,
				'italic'=>false,
				'size' => 14
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(
		array(
			'font'=>array(
				'size'=>11
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray(
		array(
			'font'=>array(
				'size'=>11
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray(
		array(
			'font'=>array(
				'size'=>11
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$PHPExcelStyleTitle->applyFromArray(
		array(
			'font'=>array(
				'color'=>array('rgb'=>'000000'),
				'name'=>'Calibri',
				'bold'=>true,
				'italic'=>false,
				'size'=> 10
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			),
			'borders'=>array(
				'top'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		)
	);
	$PHPExcel->getActiveSheet()->setSharedStyle($PHPExcelStyleTitle, 'A6:L6');

	/* Lấy và Xuất dữ liệu */
	$vitri = 7;
	for($i=0;$i<count($donhang);$i++)
	{
		/* Phí ship */
		if(isset($donhang[$i]['phiship']) && $donhang[$i]['phiship'] > 0) $phiship = $func->format_money(@$donhang[$i]['phiship']);
		else $phiship = "Không";
	
		/* Trang thái */
		$trangthai = $d->rawQueryOne("select trangthai from #_status where id = ? limit 0,1",array($donhang[$i]['tinhtrang']));

		/* Gán giá trị */
		$PHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$vitri, $i+1)
		->setCellValue('B'.$vitri, htmlspecialchars_decode(@$donhang[$i]['madonhang']))
		->setCellValue('C'.$vitri, date('H:i A d-m-Y',@$donhang[$i]['ngaytao']))
		->setCellValue('D'.$vitri, htmlspecialchars_decode($trangthai['trangthai']))
		->setCellValue('E'.$vitri, htmlspecialchars_decode($func->get_payments(@$donhang[$i]['httt'])))
		->setCellValue('F'.$vitri, htmlspecialchars_decode(@$donhang[$i]['hoten']))
		->setCellValue('G'.$vitri, htmlspecialchars_decode(@$donhang[$i]['dienthoai']))
		->setCellValue('H'.$vitri, htmlspecialchars_decode(@$donhang[$i]['email']))
		->setCellValue('I'.$vitri, htmlspecialchars_decode(@$donhang[$i]['diachi']))
		->setCellValue('J'.$vitri, $func->format_money(@$donhang[$i]['tamtinh']))
		->setCellValue('K'.$vitri, htmlspecialchars_decode($phiship))
		->setCellValue('L'.$vitri, $func->format_money(@$donhang[$i]['tonggia']));

		$PHPExcelStyleContent->applyFromArray(
			array(
				'alignment'=>array(
					'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap'=>true
				),
				'borders'=>array(
					'top'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'right'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'bottom'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
					'left'=>array('style' => PHPExcel_Style_Border::BORDER_THIN),
				)
			)
		);
		$PHPExcel->getActiveSheet()->setSharedStyle($PHPExcelStyleContent, 'A'.$vitri.':L'.$vitri);
		$vitri++;
	}

	/* Rename title */
	$PHPExcel->getActiveSheet()->setTitle('Orders List');

	/* Khởi tạo chỉ mục ở đầu sheet */
	$PHPExcel->setActiveSheetIndex(0);

	/* Xuất file */
	$time = time();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="orders_list_'.$time.'_'.date('d_m_Y').'.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit();
?>