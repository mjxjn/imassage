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
// 获取按摩师等级
function getLevel($l)
{
	switch ($l) {
		case '1':
			$level = "高级";
			break;
		case '2':
			$level = "特级";
			break;
		case '3':
			$level = "专家";
			break;
		default:
			$level = "高级";
			break;
	}
	return $level;
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

 function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)  
    {  
  if(function_exists("mb_substr")){  
              if($suffix)  
              return mb_substr($str, $start, $length, $charset)."...";  
              else
                   return mb_substr($str, $start, $length, $charset);  
         }  
         elseif(function_exists('iconv_substr')) {  
             if($suffix)  
                  return iconv_substr($str,$start,$length,$charset)."...";  
             else
                  return iconv_substr($str,$start,$length,$charset);  
         }  
         $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
                  [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";  
         $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";  
         $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";  
         $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";  
         preg_match_all($re[$charset], $str, $match);  
         $slice = join("",array_slice($match[0], $start, $length));  
         if($suffix) return $slice."…";  
         return $slice;
    }
?>