<?php
/**
* 
*/
class UserAction extends CommonAction
{
	
	public function index()
	{
		$Model = D('User');
		import('ORG.Util.Page');// 导入分页类
		$count      = $Model->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		$list = $Model->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	public function edit()
	{
		$id = I('id');
		$Model = D('User');
		if ($_POST) {
			if (!$Model->create()){
			    // 如果创建失败 表示验证没有通过 输出错误提示信息
			    echo "<script>alert(\"".$Model->getError()."\"); history.back();</script>";
			 	exit();
			 }else{
			    // 验证通过 可以进行其他数据操作
			    $Model->save();
			    echo "<script>alert(\"修改成功\"); </script>";
			 }
		}
		$info = $Model->where('id='.$id)->find();
		if (empty($info)) {
			$this->error('数据错误');
		}
		$this->assign('info',$info);
		$this->display();
	}
}
?>