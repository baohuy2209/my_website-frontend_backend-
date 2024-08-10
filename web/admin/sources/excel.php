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
	if(!isset($config['order']['excel']) || $config['order']['excel'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	
	/* Setting */
	$setting = $d->rawQueryOne("select * from #_setting limit 0,1");
	$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;
	
	/* Thông tin đơn hàng */
	$iddh = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
	if(!$iddh) $func->transfer("Dữ liệu không có thực", "index.php?com=order&act=man", false);
	$donhang = $d->rawQueryOne("select * from #_order where id = ? limit 0,1",array($iddh));

	/* Gán giá trị đơn hàng */
	$madonhang = @$donhang['madonhang'];
	$tinhtrang = @$donhang['tinhtrang'];
	$tamtinh = $func->format_money(@$donhang['tamtinh']);
	$tonggia = $func->format_money(@$donhang['tonggia']);
	$phiship = @$donhang['phiship'];
	if($phiship) $phiship = $func->format_money($phiship);
	else $phiship = "Không";

	/* Trang thái */
	$trangthai = $d->rawQueryOne("select trangthai from #_status where id = ? limit 0,1",array($tinhtrang));
	
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
	$PHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

	/* Merge cells */
	$PHPExcel->setActiveSheetIndex(0);
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A2:F2');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A3:F3');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A4:F4');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A6:C6');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A7:C7');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A8:C8');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('D6:F6');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('D7:F7');
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('D8:F8');

	/* set Cell Value */
	$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
	$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
	$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$setting['tenvi']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A2','Hotline: '.$optsetting['hotline']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A3','Email: '.$optsetting['email']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A4','Địa chỉ: '.$optsetting['diachi']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A6','Họ tên: '.@$donhang['hoten']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A7','Điện thoại: '.@$donhang['dienthoai']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A8','Địa chỉ: '.@$donhang['diachi']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('D6','Mã đơn hàng: '.$madonhang);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('D7','Ngày đặt: '.date('H:i A d-m-Y',@$donhang['ngaytao']));
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('D8','Tình trạng: '.$trangthai['trangthai']);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A10','STT');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('B10','Sản phẩm');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('C10','Số lượng');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('D10','Giá');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('E10','Giá mới');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('F10','Tạm tính');

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
	$PHPExcel->getActiveSheet()->setSharedStyle($PHPExcelStyleTitle, 'A10:F10');

	/* Lấy và Xuất dữ liệu */
	$vitri = 11;
	$items = $d->rawQuery("select * from #_order_detail where id_order = ?",array($iddh));

	for($i=0;$i<count($items);$i++) 
	{
		$gia = $func->format_money(@$items[$i]['gia']);
		$giamoi = $func->format_money(@$items[$i]['giamoi']);
		$thanhtien = 0;
		if(isset($items[$i]['giamoi']) && $items[$i]['giamoi'] > 0) $thanhtien = $func->format_money(@$items[$i]['giamoi']*@$items[$i]['soluong']);
		else $thanhtien = $func->format_money(@$items[$i]['gia']*@$items[$i]['soluong']);

		$PHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$vitri, $i+1)
		->setCellValue('B'.$vitri, @$items[$i]['ten'])
		->setCellValue('C'.$vitri, @$items[$i]['soluong'])
		->setCellValue('D'.$vitri, @$gia)
		->setCellValue('E'.$vitri, @$giamoi)
		->setCellValue('F'.$vitri, @$thanhtien);
		
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
		$PHPExcel->getActiveSheet()->setSharedStyle($PHPExcelStyleContent, 'A'.$vitri.':F'.$vitri);
		$vitri++;
	}

	/* Tính thành tiền */
	$vitri++;
	if($config['order']['ship'])
	{
		/* Tạm tính */
		$PHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$vitri.':E'.$vitri);
		$PHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$vitri,'Tạm tính');
		$PHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$vitri,@$tamtinh);
		$PHPExcel->getActiveSheet()->getStyle('A'.$vitri.':F'.$vitri)->applyFromArray(
			array(
				'font'=>array(
					'color'=>array('rgb'=>'000000'),
					'name'=>'Calibri',
					'bold'=>true,
					'italic'=>false,
					'size'=>10
				),
				'alignment'=>array(
					'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
					'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap'=>true
				)
			)
		);
		$vitri++;
	}

	/* Phí vận chuyển */
	if($config['order']['ship'])
	{
		$PHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$vitri.':E'.$vitri);
		$PHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$vitri,'Phí vận chuyển');
		$PHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$vitri,@$phiship);
		$PHPExcel->getActiveSheet()->getStyle('A'.$vitri.':F'.$vitri)->applyFromArray(
			array(
				'font'=>array(
					'color'=>array('rgb'=>'000000'),
					'name'=>'Calibri',
					'bold'=>true,
					'italic'=>false,
					'size'=>10
				),
				'alignment'=>array(
					'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
					'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap'=>true
				)
			)
		);
		$vitri++;
	}

	/* Tổng tiền */
	$PHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$vitri.':E'.$vitri);
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$vitri,'Tổng giá trị đơn hàng');
	$PHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$vitri,@$tonggia);
	$PHPExcel->getActiveSheet()->getStyle('A'.$vitri.':F'.$vitri)->applyFromArray(
		array(
			'font'=>array(
				'color'=>array('rgb'=>'000000'),
				'name'=>'Calibri',
				'bold'=>true,
				'italic'=>false,
				'size'=>10
			),
			'alignment'=>array(
				'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'wrap'=>true
			)
		)
	);
	$vitri++;

	/* Rename title */
	$PHPExcel->getActiveSheet()->setTitle('Order');

	/* Khởi tạo chỉ mục ở đầu sheet */
	$PHPExcel->setActiveSheetIndex(0);

	/* Xuất file */
	$time = time();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="order_'.$madonhang.'_'.$time.'_'.date('d_m_Y').'.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit();
?>