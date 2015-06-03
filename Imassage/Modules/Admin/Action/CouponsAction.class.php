<?php
/**
* 
*/
class CouponsAction extends CommonAction
{
	
	function index()
	{
		$Coupons = M('Coupons');
		import('ORG.Util.Page');// 导入分页类
		$count      = $Coupons->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		 // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Coupons->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	function add()
	{
		if ($_POST) {
			$endtime = I('endtime');
			$t1a = explode('/', $endtime);
			$num1 = strtotime($t1a['2'].'-'.$t1a['0'].'-'.$t1a['1']." 00:00:00");
			if($num1 == 0){
				$this->error('选择到期时间');
				exit();
			}
			$title = I('title');
			if (empty($name)) {
				$this->error('选择标题');
			}
			$minnum = I('minnum');
			if (empty($minnum)) {
				$this->error('选择最小人数');
			}
			$minprice = I('minprice');
			if (empty($minprice)) {
				$this->error('选择最小订单金额');
			}
			$data['endtime'] = $num1;
			$data['title'] = $title;
			$data['price'] = decPrc(I('price'));
			$data['minnum'] = $minnum;
			$data['minprice'] = decPrc($minprice);
			$Coupons = M('Coupons');
			if($Coupons->add($data)){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
			exit();
		}
		$this->display();
	}

	function view()
	{
		$id = I('id');
		$Model = M('CouponsInfo');
		if ($_POST) {
			$num = I('num');
			
		}
		import('ORG.Util.Page');// 导入分页类
		$count      = $Model->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		 // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Model->table('CouponsInfo c')->join('User u on u.id=c.uid')->field('c.*,u.name')->where('c.cid='.$id)->order('c.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	function del()
	{
		$id = I('id');
		$data['id'] = $id;
		$Model = M('Coupons');
		if($Model->where($data)->delete())
		{
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
}

?>