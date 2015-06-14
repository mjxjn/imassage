<?php
/**
* 
*/
class UserAction extends Action
{
	
	function index()
	{
		$uid = I('uid');
		$User = M('User');
		$info = $User->where('id='.$uid)->find();
		$this->assign('info',$info);
		$this->display();
	}

}
?>