<?php
	class CssMinify
	{
		private $pathCss = array();
		private $debugCss;
		private $cacheName = '';
		private $cacheFile = 'assets/css/';
		private $cacheSize = false;

		function __construct($debugCss, $func)
		{
			$this->debugCss = $debugCss;
			$this->func = $func;
		}

		public function setCss($path)
		{
			$this->pathCss[] = $path;
		}

		public function getCss()
		{
			if(empty($this->pathCss)) die("No files to optimize");
			return ($this->debugCss) ? $this->defaultCss() : $this->miniCss();
		}

		public function setCache($name)
		{
			$this->cacheName = $name;
			$this->cacheFile = $this->cacheFile.$this->cacheName.'.css';
			$this->cacheSize = (file_exists($this->cacheFile)) ? filesize($this->cacheFile) : 0;
		}

		private function miniCss()
		{
			$strCss = '';
			$extension = '';

			if(!$this->cacheSize)
			{
				foreach($this->pathCss as $path)
				{
					$path_parts = pathinfo($path);
					$extension = strtolower($path_parts['extension']);
					if($extension != 'css') die("Invalid file");
					$myfile = fopen($path, "r") or die("Unable to open file");
					$sizefile = filesize($path);
			        if($sizefile) $strCss .= $this->compressCss(fread($myfile,$sizefile));
					fclose($myfile);
				}

				if($strCss)
				{
					$file = fopen($this->cacheFile, "w") or die("Unable to open file");
					fwrite($file, $strCss);
					fclose($file);
				}
			}

			return '<link href="'.$this->cacheFile.'" rel="stylesheet">';
		}

		private function defaultCss()
		{
			$linkCss = '';
			$extension = '';

			if($this->cacheSize)
			{
				$file = fopen($this->cacheFile, "r+") or die("Unable to open file");
				ftruncate($file, 0);
				fclose($file);
			}

			foreach($this->pathCss as $path)
			{
				$path_parts = pathinfo($path);
				$extension = strtolower($path_parts['extension']);
				if($extension != 'css') die("Invalid file");
				$linkCss .= '<link href="'.$path.'?v='.$this->func->stringRandom(10).'" rel="stylesheet">'.PHP_EOL;
			}

			return $linkCss;
		}

		private function compressCss($buffer)
		{
		    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		    $buffer = str_replace(': ', ':', $buffer);
		    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		    return $buffer;
		}
	}
?>