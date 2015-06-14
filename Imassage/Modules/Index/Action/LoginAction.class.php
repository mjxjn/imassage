<?php
/**
* 
*/
class LoginAction extends Action
{
	
	function index()
	{
		$openid = I('openid');
		$this->assign('openid',$openid);
		$this->display();
	}

	function sendPhone(){
		set_time_limit(0);
		Vendor('YImei.include.Client');
		$gwUrl = C('gwUrl');
		$serialNumber = C('serialNumber');
		$password = C('password');
		$sessionKey = C('sessionKey');

		$connectTimeOut = 2;
		$readTimeOut = 10;
		$proxyhost = false;
		$proxyport = false;
		$proxyusername = false;
		$proxypassword = false;
		$client = new Client($gwUrl,$serialNumber,$password,$sessionKey,$proxyhost,$proxyport,$proxyusername,$proxypassword,$connectTimeOut,$readTimeOut);
		$client->setOutgoingEncoding("UTF-8");

		$phone = I('phone');
		$Verfiy = M('Verfiy');
		$data['phone'] = $phone;
		$code = rand(10000,99999);
		$data['code'] = $code;
		$data['endtime'] = time()+600; // 有效时间10分钟
		$Verfiy->add($data);

		$statusCode = $client->sendSMS(array($phone),"【爱按摩】验证码:$code,请即时输入。您正在进行手机号注册。");  
		//成功返回 0
		if ($statusCode!=null && $statusCode=="0") {
			$status = 1;
		}else{
			$status = 2;
			$info = "发送失败,返回:".$statusCode;
		}
		$this->ajaxReturn($data,$info,$status);
	}

	function saveuser(){
		$phone = I('phone');
		$code = I('verfiy');
		$openid = I('openid');
		$Verfiy = M('Verfiy');
		$info = $Verfiy->where('used=0 and endtime > '.time().' and code='.$code.' and phone="'.$phone.'"')->find();
		if (empty($info)) {
			header("Content-Type: text/html; charset=utf-8");
			echo '<script type="text/javascript" crossorigin="anonymous">alert("验证码错误！");history.back()</script>';
		}else{
			$data['used'] = 1;
			$Verfiy->where('id='.$info['id'])->save($data);
			$User = M('User');
			$udata['phone'] = $phone;
			$udata['openid'] = $openid;
			$udata['lastlogin'] = time();
			$User->add($udata);
			Header("Location: http://".$_SERVER['HTTP_HOST']."/index.php/user"); 
		}
	}
}
?>