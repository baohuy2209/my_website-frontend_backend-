<?php
	class AddonsOnline
	{
		private $arrayScript = array();

		function __construct()
		{

		}

		public function setScript($element='', $type='', $scrolltop=1)
		{
			$script = '';

			if($element && $type)
			{
				$script = '<script type="text/javascript">$(function(){var a=!1;$(window).scroll(function(){$(window).scrollTop()>'.$scrolltop.' && !a&&($("#'.$element.'").load("ajax/ajax_addons.php?type='.$type.'"),a=!0)})});</script>';
				$this->arrayScript[] = $script;
			}
		}

		public function setAddons($element='', $type='', $scrolltop=1)
		{
			$elementAddons = '';

			if($element && $type)
			{
				$elementAddons = '<div id="'.$element.'"></div>';
				$this->setScript($element, $type, $scrolltop);
			}

			return $elementAddons;
		}

		public function getAddons()
		{
			$textAddons = '';

			if($this->arrayScript)
			{
				foreach($this->arrayScript as $v)
				{
					$textAddons .= $v;
				}
			}

			return $textAddons;
		}
	}
?>