<?php
	class Cart
	{
		private $d;

		function __construct($d)
		{
			$this->d = $d;
		}

		public function get_product_info($pid=0)
		{
			$row = null;
			if($pid)
			{
				$row = $this->d->rawQueryOne("select * from #_product where id = ? limit 0,1",array($pid));
			}
			return $row;
		}
		
		public function get_product_mau($mau=0)
		{
			$str = '';
			if($mau)
			{
				$row = $this->d->rawQueryOne("select tenvi from #_product_mau where id = ? limit 0,1",array($mau));
				$str = $row['tenvi'];
			}
			return $str;
		}
		
		public function get_product_size($size=0)
		{
			$str = '';
			if($size)
			{
				$row = $this->d->rawQueryOne("select tenvi from #_product_size where id = ? limit 0,1",array($size));
				$str = $row['tenvi'];
			}
			return $str;
		}
		
		public function remove_product($code='')
		{
			if(isset($_SESSION['cart']) && $code != '')
			{
				$max = count($_SESSION['cart']);

				for($i=0;$i<$max;$i++)
				{
					if($code == $_SESSION['cart'][$i]['code'])
					{
						unset($_SESSION['cart'][$i]);
						break;
					}
				}

				$_SESSION['cart'] = array_values($_SESSION['cart']);
			}
		}
		
		public function get_order_total()
		{
			$sum = 0;

			if(isset($_SESSION['cart']))
			{
				$max = count($_SESSION['cart']);

				for($i=0;$i<$max;$i++)
				{
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$proinfo = $this->get_product_info($pid);

					if($proinfo['giamoi']) $price = $proinfo['giamoi'];
					else $price = $proinfo['gia'];
					$sum += ($price * $q);
				}
			}

			return $sum;
		}
		
		public function addtocart($q=1, $pid=0, $mau=0, $size=0)
		{
			if($pid<1 or $q<1) return;
			
			$code = md5($pid.$mau.$size);

			if(isset($_SESSION['cart']))
			{
				if(!$this->product_exists($code,$q))
				{
					$max = count($_SESSION['cart']);
					$_SESSION['cart'][$max]['productid'] = $pid;
					$_SESSION['cart'][$max]['qty'] = $q;
					$_SESSION['cart'][$max]['mau'] = $mau;
					$_SESSION['cart'][$max]['size'] = $size;
					$_SESSION['cart'][$max]['code'] = $code;
				}
			}
			else
			{
				$_SESSION['cart'] = array();
				$_SESSION['cart'][0]['productid'] = $pid;
				$_SESSION['cart'][0]['qty'] = $q;
				$_SESSION['cart'][0]['mau'] = $mau;
				$_SESSION['cart'][0]['size'] = $size;
				$_SESSION['cart'][0]['code'] = $code;
			}
		}
		
		private function product_exists($code='', $q=1)
		{
			$flag = 0;
			
			if(isset($_SESSION['cart']) && $code != '')
			{
				$q = ($q>1)?$q:1;
				$max = count($_SESSION['cart']);

				for($i=0;$i<$max;$i++)
				{
					if($code == $_SESSION['cart'][$i]['code'])
					{
						$_SESSION['cart'][$i]['qty'] += $q;
						$flag = 1;
					}
				}
			}

			return $flag;
		}
	}
?>