<?php
/**
* 
*/
class CheckAction extends Action
{
	
	//public function _initialize()
	public function index()
	{
		Vendor('Weixin.WxPayPubHelper.WxPayPubHelper');
		//使用jsapi接口
		$jsApi = new JsApi_pub();

		//=========步骤1：网页授权获取用户openid============
		//通过code获得openid
		if (!isset($_GET['code']))
		{
			$callbackurl = $_GET['state'];
			//触发微信返回code码
			$url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL,$callbackurl);
			Header("Location: $url"); 
			exit();
		}
		else
		{
			//获取code码，以获取openid
		    $code = $_GET['code'];
		    $state = $_GET['state'];
			$jsApi->setCode($code);
			$openid = $jsApi->getOpenId();
		}
		$User = M('User');
		$userinfo = $User->field('id,phone')->where('openid="'.$openid.'"')->find();
		
		if (!empty($userinfo)) {
			//
			//Header("Location: http://".$_SERVER['HTTP_HOST']."/index.php/login/sendPhone");
			//dump($userinfo);
			//$this->redirect("login/index/openid/".$openid);
			//$uid = $userinfo['id'];
			//$phone = $userinfo['phone'];
			Header("Location: http://".$_SERVER['HTTP_HOST']."/index.php".$state.'/uid/'.$userinfo['id']);
			exit();
		}else{
			Header("Location: http://".$_SERVER['HTTP_HOST']."/index.php/login/index/openid/".$openid);
			exit();
		}

	}

}
?>