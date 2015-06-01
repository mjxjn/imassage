<?php
/**
* 
*/
class OrderAction extends CommonAction
{
	
	public function index()
	{
		$Model = M('Orders');
		import('ORG.Util.Page');// 导入分页类
		$count      = $Model->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		 // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Model->table('Orders o')->join('User u on o.uid=u.id')->join('Product p on o.pid = p.id')->join('Blindman b on o.bid = b.id')->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->field("o.id,o.status,o.bid,o.uid,o.pid,o.num,o.total,o.starttime,u.name,u.phone,p.title,b.name as blindman")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出

		$data['status'] = array('not in', array('5','7','8'));
		$unlist = $Model->table('Orders o')->join('User u on o.uid=u.id')->join('Product p on o.pid = p.id')->join('Blindman b on o.bid = b.id')->order('id desc')->where($data)->field("o.id,o.status,o.bid,o.uid,o.pid,o.num,o.total,u.name,u.phone,p.title,b.name as blindman")->select();
		$this->assign('unlist',$unlist);
		$this->display();
	}

	public function view()
	{
		$id = I('id');
		$Model = M('Orders');
		$info = $Model->table('Orders o')->join('User u on o.uid=u.id')->join('Product p on o.pid = p.id')->join('Blindman b on o.bid = b.id')->join('Coupons c on o.cid=c.id')->field("o.*,u.name,u.phone,u.address,p.title,b.name as blindman, c.title as coupons, c.price as coupons_price")->where('o.id='.$id)->find();
		if (empty($info)) {
			$status = -1;
		}else{
			$data = $info;
			$status = 1;
		}
		$this->ajaxReturn($data,$info,$status,'json');
	}

	// public function edit()
	// {
	// 	$id = I('id');
	// 	$Model = M('Orders');
	// 	$info = $Model->table('Orders o')->join('User u on o.uid=u.id')->join('Product p on o.pid = p.id')->join('Blindman b on o.bid = b.id')->join('Coupons c on o.cid=c.id')->field("o.*,u.name,u.phone,p.title,b.name as blindman, c.title as coupons, c.price as coupons_price")->where('o.id='.$id)->find();
	// 	if (empty($info)) {
	// 		$this->error('数据错误');
	// 	}

	// 	$this->assign('info',$info);
	// 	$this->display();
		
	// }

	public function changeOrder()
	{
		$id = I('id');
		$data['id'] = $id;
		$status = I('status');
		$Model = M('Orders');
		$info = $Model->where($data)->find();
		if (empty($info)) {
			$this->error('数据错误');
		}
		$tmp_status = $info['tmp_status'];
		switch ($status) {
			case '1':
				$data['status'] = 8; //取消订单
				break;
			case '2':
				$data['status'] = 3; //已付款，未按摩
				break;
			case '3':
				$data['status'] = 4; //已按摩
				break;
			case '4':
				$data['status'] = 5; // 完成
				break;
			case '5':
				$data['status'] = 7; // 已退款
				break;
			case '6':
				$data['status'] = $tmp_status; // 不用同意退款。退回申请退款前订单状态。
				break;
			default:
				$this->error('提交参数错误');
				break;
		}
		if($Model->where('id='.$id)->save($data)){
			if($status == '5'){
				//退款处理
				$User = M('User');
				$User->where('id='.$info['uid'])->setInc('money',$info['total']);
			}
			$this->success('订单状态修改成功');
		}else{
			$this->error('订单状态修改失败');
		}
	}
	
	//订单统计
	public function census()
	{
		if ($_POST) {
			$time1 = I('time1');
			$time2 = I('time2');
			$blindid = I('blindid');
			$t1a = explode('/', $time1);
			$t2a = explode('/', $time2);
			$num1 = strtotime($t1a['2'].'-'.$t1a['0'].'-'.$t1a['1']." 00:00:00");
			$num2 = strtotime($t2a['2'].'-'.$t2a['0'].'-'.$t2a['1']." 00:00:00");
			if ($num1 > $num2) {
				$min = strtotime($t2a['2'].'-'.$t2a['0'].'-'.$t2a['1']." 00:00:00");
				$max = strtotime($t1a['2'].'-'.$t1a['0'].'-'.$t1a['1']." 23:59:59");
			}else{
				$min = strtotime($t1a['2'].'-'.$t1a['0'].'-'.$t1a['1']." 00:00:00");
				$max = strtotime($t2a['2'].'-'.$t2a['0'].'-'.$t2a['1']." 23:59:59");
			}
			if (!empty($blindid)) {
				$map['bid'] = $blindid;
				$where['bid'] = $blindid;
			}
			$Model = M('Orders');
			$map['status'] = array('not in','1,6,7,8');
			$map['addtime'] = array('between',$min.','.$max); 
			$where['addtime'] = array('between',$min.','.$max); 
			$data['num'] = $Model->where($map)->count();
			$list = $Model->where($map)->select();
			$total = 0;
			foreach ($list as $key => $value) {
				$total += $value['total'];
			}
			$datap['total'] = incPrc($total);
			$data['price'] = incPrc($total / $data['num']);
			$where['status'] = array('in','4,5');
			$data['finish'] = $Model->where($where)->count();
			$where['status'] = array('in','7');
			$data['remoney'] = $Model->where($where)->count();
			$where['status'] = array('in','8');
			$data['cancel'] = $Model->where($where)->count();

			if (empty($list)) {
				$status = 2;
			}else{
				$status = 1;
			}

			$this->ajaxReturn($data,$info,$status,$type);
		}
		$Blindman = M('Blindman');
		$blist = $Blindman->select();
		$this->assign('blist',$blist);
		$this->display();
	}
}
?>