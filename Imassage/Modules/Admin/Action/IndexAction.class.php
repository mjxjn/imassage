<?php
class IndexAction extends CommonAction
{
	public function index(){
		$this->display();
	}
	public function logout(){
		session(null);
		$this->redirect('Login/index', '', 0, '页面跳转中...');
	}
}