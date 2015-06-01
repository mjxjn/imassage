<?php
class LoginAction extends Action{
	public function index(){
		$this->display();
	}

	public function ajaxlogin(){
		$name = I('username');
		$password = I('password');

		$Admin = D('Admin');
		$password = md5($password);
		$isLogin = $Admin->boolLogin($name,$password); //如果成功，返回管理员ID
		if($isLogin){
			session(C ( 'USER_AUTH_KEY' ),$isLogin);
			session(C ( 'USER_AUTH_NAME' ),$name);

			$data['id'] = $isLogin;
			$data['lastlogin'] = time();
			$Admin->save($data);
		}
		$data = $isLogin;
		$info = '';
		$status = 1;
		$type = 'json';
		$this->ajaxReturn($data,$info,$status,$type);
	}
}