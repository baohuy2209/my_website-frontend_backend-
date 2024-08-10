<?php
	if(!defined('SOURCES')) die("Error");		

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();

	/* Tỉnh thành */
	$city = $d->rawQuery("select ten, id from #_city order by id asc");

	/* Hình thức thanh toán */
	$httt = $d->rawQuery("select ten$lang as ten, mota$lang as mota, id from #_news where type = ? order by stt,id desc",array('hinh-thuc-thanh-toan'));

	if(isset($_POST['thanhtoan']))
	{
		/* Gán giá trị gửi email */
		$madonhang = strtoupper($func->stringRandom(6));
	    $hoten = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
	    $email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
	    $dienthoai = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : '';
	    $city = (isset($_POST['city'])) ? htmlspecialchars($_POST['city']) : 0;
	    $district = (isset($_POST['district'])) ? htmlspecialchars($_POST['district']) : 0;
	    $wards = (isset($_POST['wards'])) ? htmlspecialchars($_POST['wards']) : 0;
	    $diachi = htmlspecialchars($_POST['diachi']).', '.$func->get_places("wards",$wards).', '.$func->get_places("district",$district).', '.$func->get_places("city",$city);
	    $httt = (isset($_POST['payments'])) ? htmlspecialchars($_POST['payments']) : 0;
	    $htttText = ($httt) ? $func->get_payments($httt) : '';
	    $yeucaukhac = (isset($_POST['yeucaukhac'])) ? htmlspecialchars($_POST['yeucaukhac']) : '';
		$tamtinh = (isset($_POST['price-temp'])) ? htmlspecialchars($_POST['price-temp']) : 0;
		$ship = (isset($_POST['price-ship'])) ? htmlspecialchars($_POST['price-ship']) : 0;
		$total = (isset($_POST['price-total'])) ? htmlspecialchars($_POST['price-total']) : 0;
	    $ngaydangky = time();
	    $chitietdonhang = '';
	    $max = (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;

	    for($i=0;$i<$max;$i++)
	    {
	    	$pid = $_SESSION['cart'][$i]['productid'];
			$q = $_SESSION['cart'][$i]['qty'];
			$color = $_SESSION['cart'][$i]['mau'];					
			$size = $_SESSION['cart'][$i]['size'];
			$code = $_SESSION['cart'][$i]['code'];
			$proinfo = $cart->get_product_info($pid);
			$pmau = $cart->get_product_mau($color);
			$psize = $cart->get_product_size($size);
			$textsm='';
			if($pmau!='' && $psize!='') $textsm = $pmau." - ".$psize;
			else if($pmau!='') $textsm = $pmau;
			else if($psize!='') $textsm = $psize;

			if($q==0) continue;
	    	$chitietdonhang.='<tbody bgcolor="';
	    	if($i%2==0) $chitietdonhang.='#eee';
	    	else $chitietdonhang.='#e6e6e6';

	    	$chitietdonhang.='" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"><tr>';
	    	$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top">';
	    	$chitietdonhang.='<span style="display:block;font-weight:bold">'.$proinfo['ten'.$lang].'</span>';
	    	if($textsm!='') $chitietdonhang.='<span style="display:block;font-size:12px">'.$textsm.'</span>';
	    	$chitietdonhang.='</td>';
	    	if($proinfo['giamoi'])
	    	{
	    		$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top">';
	    		$chitietdonhang.='<span style="display:block;color:#ff0000;">'.$func->format_money($proinfo['giamoi']).'</span>';
	    		$chitietdonhang.='<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.$func->format_money($proinfo['gia']).'</span>';
	    		$chitietdonhang.='</td>';
	    	}
	    	else
	    	{
	    		$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.$func->format_money($proinfo['gia']).'</span></td>';
	    	}
	    	$chitietdonhang.='<td align="center" style="padding:3px 9px" valign="top">'.$q.'</td>';
	    	if($proinfo['giamoi'])
	    	{
	    		$chitietdonhang.='<td align="right" style="padding:3px 9px" valign="top">';
	    		$chitietdonhang.='<span style="display:block;color:#ff0000;">'.$func->format_money($proinfo['giamoi']*$q).'</span>';
	    		$chitietdonhang.='<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.$func->format_money($proinfo['gia']*$q).'</span>';
	    		$chitietdonhang.='</td>';
	    	}
	    	else
	    	{
	    		$chitietdonhang.='<td align="right" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.$func->format_money($proinfo['gia']*$q).'</span></td>';
	    	}
	    	$chitietdonhang.='</tr></tbody>';
	    }

	    $chitietdonhang.='
		<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
			<tr>
				<td align="right" colspan="3" style="padding:5px 9px">Tạm tính</td>
				<td align="right" style="padding:5px 9px"><span>'.$func->format_money($tamtinh).'</span></td>
			</tr>';
			if($ship)
			{
				$chitietdonhang.=
				'<tr>
					<td align="right" colspan="3" style="padding:5px 9px">Phí vận chuyển</td>
					<td align="right" style="padding:5px 9px"><span>'.$func->format_money($ship).'</span></td>
				</tr>';
			}
			$chitietdonhang.='
			<tr bgcolor="#eee">
				<td align="right" colspan="3" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
				<td align="right" style="padding:7px 9px"><strong><big><span>'.$func->format_money($total).'</span> </big> </strong></td>
			</tr>
		</tfoot>';

		/* Nội dung gửi email cho admin */
		$contentAdmin = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Quý khách nhận được thông tin đặt hàng tại website '.$emailer->getEmail('company:website').'</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin đơn hàng #'.$madonhang.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày '.date('d',$emailer->getEmail('datesend')).' tháng '.date('m',$emailer->getEmail('datesend')).' năm '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
												<tr>
													<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<thead>
															<tr>
																<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin thanh toán</th>
																<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Địa chỉ giao hàng</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
																<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
																'.$dienthoai.'</td>
																<td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
																 <a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
																'.$diachi.'<br>
																 Tel: '.$dienthoai.'</td>
															</tr>
															<tr>
																<td colspan="2" style="padding:7px 0px 0px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
																<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> '.$htttText.'';
																if($ship)
																{
																	$contentAdmin.='<br><strong>Phí vận chuyển: </strong> '.$func->format_money($ship);
																}
																$contentAdmin.='</td>
															</tr>
														</tbody>
													</table>
													</td>
												</tr>
												<tr>
													<td>
													<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Yêu cầu khác:</strong> <i>'.$yeucaukhac.'</i></p>
													</td>
												</tr>
												<tr>
													<td>
													<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:'.$emailer->getEmail('color').'">CHI TIẾT ĐƠN HÀNG</h2>
													<table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
														<thead>
															<tr>
																<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
																<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
																<th align="center" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;min-width:55px;">Số lượng</th>
																<th align="right" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
															</tr>
														</thead>
														'.$chitietdonhang.'
													</table>
													</td>
												</tr>
												<tr>
													<td>
													<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;margin-top:10px;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã mua hàng tại '.$emailer->getEmail('company:website').'.<br>
								Để chắc chắn luôn nhận được email thông báo, xác nhận mua hàng từ '.$emailer->getEmail('company:website').', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* Nội dung gửi email cho khách hàng */
		$contentCustomer = '
		<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
				<tr>
					<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
							<tbody>
								<tr>
									<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
										<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
											<tbody>
												<tr>
													<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
														<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
														<div style="display:flex;justify-content:space-between;align-items:center;">
															<table style="width:100%;">
																<tbody>
																	<tr>
																		<td>
																			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
																		</td>
																		<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr style="background:#fff">
									<td align="left" height="auto" style="padding:15px" width="600">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đặt hàng tại '.$emailer->getEmail('company:website').'</h1>
														<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Chúng tôi rất vui thông báo đơn hàng #'.$madonhang.' của quý khách đã được tiếp nhận và đang trong quá trình xử lý. '.$emailer->getEmail('company:website').' sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
														<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin đơn hàng #'.$madonhang.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày '.date('d',$emailer->getEmail('datesend')).' tháng '.date('m',$emailer->getEmail('datesend')).' năm '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
													</td>
												</tr>
											<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin thanh toán</th>
														<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Địa chỉ giao hàng</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
														<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
														'.$dienthoai.'</td>
														<td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
														 <a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
														'.$diachi.'<br>
														 Tel: '.$dienthoai.'</td>
													</tr>
													<tr>
														<td colspan="2" style="padding:7px 0px 0px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
														<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> '.$htttText.'';
														if($ship)
														{
															$contentCustomer.='<br><strong>Phí vận chuyển: </strong> '.$func->format_money($ship);
														}
														$contentCustomer.='</td>
													</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>
											<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Yêu cầu khác:</strong> <i>'.$yeucaukhac.'</i></p>
											</td>
										</tr>
										<tr>
											<td>
											<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:'.$emailer->getEmail('color').'">CHI TIẾT ĐƠN HÀNG</h2>

											<table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
												<thead>
													<tr>
														<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
														<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
														<th align="center" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;min-width:55px;">Số lượng</th>
														<th align="right" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
													</tr>
												</thead>
												'.$chitietdonhang.'
											</table>
											<div style="margin:auto;text-align:center"><a href="'.$emailer->getEmail('home').'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-top:5px" target="_blank">Chi tiết đơn hàng tại '.$emailer->getEmail('company:website').'</a></div>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, hoặc gọi về hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
											</td>
										</tr>
										<tr>
											<td>&nbsp;
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa '.$emailer->getEmail('company:website').' cảm ơn quý khách.</p>
											<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<table width="600">
						<tbody>
							<tr>
								<td>
								<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã mua hàng tại '.$emailer->getEmail('company:website').'.<br>
								Để chắc chắn luôn nhận được email thông báo, xác nhận mua hàng từ '.$emailer->getEmail('company:website').', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
								<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		/* lưu đơn hàng */
		$data_donhang = array();
		$data_donhang['id_user'] = (isset($_SESSION[$login_member]['id'])) ? $_SESSION[$login_member]['id'] : 0;
		$data_donhang['madonhang'] = $madonhang;
		$data_donhang['hoten'] = $hoten;
		$data_donhang['dienthoai'] = $dienthoai;
		$data_donhang['diachi'] = $diachi;
		$data_donhang['email'] = $email;
		$data_donhang['httt'] = $httt;
		$data_donhang['phiship'] = $ship;
		$data_donhang['tamtinh'] = $tamtinh;
		$data_donhang['tonggia'] = $total;
		$data_donhang['yeucaukhac'] = $yeucaukhac;
		$data_donhang['ngaytao'] = $ngaydangky;
		$data_donhang['tinhtrang'] = 1;
		$data_donhang['city'] = $city;
		$data_donhang['district'] = $district;
		$data_donhang['wards'] = $wards;
		$data_donhang['stt'] = 1;
		$id_insert = $d->insert('order',$data_donhang);

		/* lưu đơn hàng chi tiết */
		if($id_insert)
		{
			for($i=0;$i<$max;$i++)
			{
				$pid = $_SESSION['cart'][$i]['productid'];
				$q = $_SESSION['cart'][$i]['qty'];
				$proinfo = $cart->get_product_info($pid);
				$gia = $proinfo['gia'];
				$giamoi = $proinfo['giamoi'];
				$color = $cart->get_product_mau($_SESSION['cart'][$i]['mau']);
				$size = $cart->get_product_size($_SESSION['cart'][$i]['size']);
				$code = $_SESSION['cart'][$i]['code'];
				
				if($q==0) continue;

				$data_donhangchitiet = array();
				$data_donhangchitiet['id_product'] = $pid;
				$data_donhangchitiet['id_order'] = $id_insert;
				$data_donhangchitiet['photo'] = $proinfo['photo'];
				$data_donhangchitiet['ten'] = $proinfo['ten'.$lang];
				$data_donhangchitiet['code'] = $code;
				$data_donhangchitiet['mau'] = $color;
				$data_donhangchitiet['size'] = $size;
				$data_donhangchitiet['gia'] = $gia;
				$data_donhangchitiet['giamoi'] = $giamoi;
				$data_donhangchitiet['soluong'] = $q;
				$d->insert('order_detail',$data_donhangchitiet);
			}
		}

		/* Send email admin */
		$arrayEmail = null;
		$subject = "Thông tin đơn hàng từ ".$setting['ten'.$lang];
		$message = $contentAdmin;
		$file = '';
		$emailer->sendEmail("admin", $arrayEmail, $subject, $message, $file);

		/* Send email customer */
		$arrayEmail = array(
			"dataEmail" => array(
				"name" => $hoten,
				"email" => $email
			)
		);
		$subject = "Thông tin đơn hàng từ ".$setting['ten'.$lang];
		$message = $contentCustomer;
		$file = '';
		$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file);

	    /* Xóa giỏ hàng */
        unset($_SESSION['cart']);
		$func->transfer("Thông tin đơn hàng đã được gửi thành công.", $config_base);
	}
?>