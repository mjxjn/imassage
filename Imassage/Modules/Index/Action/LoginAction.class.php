<?php
/**
* 
*/
class LoginAction extends Action
{
	
	public function _initialize()
	{
		// Vendor('Weixin.WxPayPubHelper.WxPayPubHelper');
		// //使用jsapi接口
		// $jsApi = new JsApi_pub();

		// //=========步骤1：网页授权获取用户openid============
		// //通过code获得openid
		// if (!isset($_GET['code']))
		// {
		// 	//触发微信返回code码
		// 	$url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL);
		// 	Header("Location: $url"); 
		// }else
		// {
		// 	//获取code码，以获取openid
		//     $code = $_GET['code'];
		// 	$jsApi->setCode($code);
		// 	$openid = $jsApi->getOpenId();
		// }
	}

}
?>