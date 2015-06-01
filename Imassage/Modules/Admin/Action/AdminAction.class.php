<?php
/**
* 
*/
class AdminAction extends CommonAction
{

	public function editpassword()
	{
		if($_POST){
			$oldpassword = I('oldpassword');
			$password = I('password');
			$compassword = I('compassword');

			if ($password != $compassword) {
				$status = -1;
			}else {
				$Admin = D('Admin');
				if($Admin->changedPassword($oldpassword,$password)){
					$status = 1;
				}else{
					$status = -2;
				}
			}
			$this->ajaxReturn($data,$info,$status,'json');
		}
		$this->display();
	}
}
?>