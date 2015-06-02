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
?>