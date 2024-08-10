<?php
//$config['arrayDomainSSL']=array("yourdomainssl.com.vn"); // copy dong nay vao file config.php và cấu hình cho những domain cài ssl

$Protocol=getProtocol();///  biến nhận về giao thức truy cập để cấu hình các đường dẩn base url ,css,js...

/*<?php if($Protocol=='https://'){?>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?php }?>*/
//Bật hàm bên dưới nếu báo lỗi stream_context_get_params() undefined
/*function stream_context_get_params($stream_or_context) {
	return array("options"=>stream_context_get_options($stream_or_context));
}*/
function redirectphp($url){
	$url=str_replace('https//','',$url);
	$url=str_replace('https/','https://',$url);
	$arrayurl=explode('://',$url);
	if(count($arrayurl)==3){
		$url=$arrayurl[0].'://'.$arrayurl[2];
	}
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $url");
}

 

function getCurrentPageURLSSL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    return $pageURL;
}

function getProtocol() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    return $pageURL;
}



function checkTimeSSL($domainName){
	$url = $domainName;

	$orignal_parse = parse_url($url, PHP_URL_HOST);

	$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
	stream_context_set_option($get, 'ssl', 'verify_peer', false);
	$read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
	$cert = stream_context_get_params($read);
	$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
	if (strpos($orignal_parse, 'www') !== false) {
	   $orignal_parse=str_replace("www.", "", $orignal_parse);
	}
	if($certinfo['extensions']['subjectAltName']!=""){
		$cer_domainlist=explode(",", $certinfo['extensions']['subjectAltName']);
		$cer_domainlist = array_map('trim', $cer_domainlist);
		$check_domain="DNS:".$orignal_parse;
		if(!in_array($check_domain,$cer_domainlist)){
			$arrayInfossl=array('songay'=>0,'version'=>$certinfo['version']);
		}else{
			$arrayInfossl=array('songay'=>$certinfo['validTo_time_t'],'version'=>$certinfo['version']);
		}
	}else{
		$arrayInfossl=array('songay'=>$certinfo['validTo_time_t'],'version'=>$certinfo['version']);
	}
	return $arrayInfossl;
}

function changeDomainssl($domainName){
  	$arrayDomain=explode("://",$domainName);	
	if($arrayDomain[0]=='http') {
			$stringDomainName=str_replace('http:','https:',$domainName);
			redirectphp($stringDomainName);
	}
}

function CheckChangSLL($runDomainName,$arrayConfig){
	$flagdomain=1;
	
	$DomainRun=$_SERVER["SERVER_NAME"];
	if(in_array($DomainRun,$arrayConfig)){	  
	  	$flagdomain=1;
	}else{
	    $flagdomain=0;
	  	$runDomainName='http://'.$arrayConfig['0'].$_SERVER["REQUEST_URI"];
	}

	//kiem tra han
	$arrayinfossl=checkTimeSSL($runDomainName);
	/*if($arrayinfossl['songay']=='' && $arrayinfossl['version']==''){
		die("Error: Unable to check certificate. Please check function checkTimeSSL() !");
	}*/
	$timeSLL=$arrayinfossl['songay'];
	$version=$arrayinfossl['version'];

 	$NgayHienTai=date('d-m-Y',time());
	$soNgayConLaitInt=$timeSLL- strtotime($NgayHienTai);
	$soNgayConLai=(int)($soNgayConLaitInt/24/60/60);

	$arrayDomain=explode("://",$runDomainName);

	if($soNgayConLai >=1 && $version>0){
		changeDomainssl($runDomainName);
	}else{
		if($flagdomain==0){
			//do nothing
		}else{					
			if($arrayDomain[0]=='https') {
				$stringDomainName=str_replace('https:','http:',$runDomainName);				
			    redirectphp($stringDomainName);
			}
		}
 
	}
}

// run main 
$runDomainName=getCurrentPageURLSSL(); // cấu hình domain  
CheckChangSLL($runDomainName,$config['arrayDomainSSL']);
?>