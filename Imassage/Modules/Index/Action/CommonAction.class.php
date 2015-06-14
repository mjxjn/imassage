<?php
/**
* 
*/
class CommonAction extends Action
{
	
	public function _initialize()
	{
		Vendor('Weixin.jssdk');
	  	$jssdk = new JSSDK("wx20ec6953f13e5975", "e8ae6545b510c1d653e42fcbfb05feb4");
		$signPackage = $jssdk->GetSignPackage();
		$this->assign('signPackage',$signPackage);

		// 获取openid
		$code = $_GET['code'];
		if(!empty($code)){
			$appid = "wx20ec6953f13e5975";
			$appsecret = "e8ae6545b510c1d653e42fcbfb05feb4";//获取openid
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
			$result = https_request($url);
			$jsoninfo = json_decode($result, true);
			$openid = $jsoninfo["openid"];//从返回json结果中读出openid

			$User = M('User');
			$userinfo = $User->field('id')->where('openid="'.$openid.'"')->find();
			if (empty($userinfo)) {
				$islogin = false;
			}else{
				$uid = $userinfo['id'];
				$this->assign('uid',$uid);
			}
		}
		
	}
}
?>