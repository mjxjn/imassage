<?php
// *100
function decPrc($p)
{
	return $p * 100;
}
// /100
function incPrc($p)
{
	return $p / 100;
}
// 获取性别
function getSex($k)
{
	switch ($k) {
		case '1':
			$sex = "男";
			break;
		case '2':
			$sex = "女";
			break;
		default:
			$sex = "";
			break;
	}
	return $sex;
}
//获取支付状态
/**
 * 1  待支付
 * 2  已支付
 * 3  未按摩
 * 4  已按摩
 * 5  已完成
 * 6  待退款
 * 7  已退款
 * 8  取消订单
 */
function payStatus($key){
	switch ($key) {
		case '1':
			$status = "待支付";
			break;
		case '2':
			$status = "已支付";
			break;
		case '3':
			$status = "未按摩";
			break;
		case '4':
			$status = "已按摩";
			break;
		case '5':
			$status = "已完成";
			break;
		case '6':
			$status = "待退款";
			break;
		case '7':
			$status = "已退款";
			break;
		case '8':
			$status = "取消订单";
			break;
		default:
			$status = "无";
			break;
	}
	return $status;
}

//评论是否显示
function isShow($s){
	if ($s == 0) {
		$status = "隐藏";
	}else{
		$status = "显示";
	}
	return $status;
}

function getTime(){
	return time();
}

function randpw($len=8,$format='ALL'){
	$is_abc = $is_numer = 0;
	$password = $tmp ='';  
	switch($format){
	case 'ALL':
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	break;
	case 'CHAR':
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	break;
	case 'NUMBER':
	$chars='0123456789';
	break;
	default :
	$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	break;
	} 
	mt_srand((double)microtime()*1000000*getmypid());
	while(strlen($password)<$len){
	$tmp =substr($chars,(mt_rand()%strlen($chars)),1);
	if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
	$is_numer = 1;
	}
	if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
	$is_abc = 1;
	}
	$password.= $tmp;
	}
	if($is_numer <> 1 || $is_abc <> 1 || empty($password) ){
	$password = randpw($len,$format);
	}
	return $password;
}
function https_request($url,$data = null){
  $curl = curl_init();   
  curl_setopt($curl, CURLOPT_URL, $url);   
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);   
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);    
  if (!empty($data)){    
  curl_setopt($curl, CURLOPT_POST, 1);  
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);   
  }    
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($curl);    
  curl_close($curl);    
  return $output;
 }
?>