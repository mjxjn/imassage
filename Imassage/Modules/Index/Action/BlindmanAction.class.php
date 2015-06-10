<?php
/**
* 
*/
class BlindmanAction extends CommonAction
{
	
	function index()
	{
		// $code = $_GET['code'];
		// $appid = "wx20ec6953f13e5975";
		// $appsecret = "e8ae6545b510c1d653e42fcbfb05feb4";//获取openid
		// $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
		// $result = $this->https_request($url);
		// $jsoninfo = json_decode($result, true);
		// $openid = $jsoninfo["openid"];//从返回json结果中读出openid
		
		$Blindman = M('Blindman');
		$list = $Blindman->order('id')->select();
		$this->assign('list',$list);
		$this->display();
	}
	function info()
	{
		$id = I('id');
		$Blindman = M('Blindman');
		$info = $Blindman->where('id='.$id)->find();
		if(!empty($info['products'])){
			$Product = M("Product");
			$proarr = json_decode($info['products'],true);
			foreach ($proarr as $key => $value) {
				$list[$key] = $Product->where('id='.$value['pid'])->find();
			}
		}
		
		$this->assign('list',$list);
		$this->assign('info',$info);
		$this->display();
	}
}
?>