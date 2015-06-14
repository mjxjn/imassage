<?php
class CouponsAction extends Action{
	public function index(){
		$uid = I('uid');
		$Coupons_info = M('Coupons_info');
		$list = $Coupons_info->where('usetime is null and uid='.$uid)->select();
		$Coupons = M('Coupons');
		foreach ($list as $key => $value) {
			$map['id'] = $value['cid'];
			$cinfo = $Coupons->where($map)->find();
			if (!empty($cinfo)) {
				$list[$key]['title'] = $cinfo['title'];
				$list[$key]['minpirce'] = $cinfo['minprice'];
				$list[$key]['minnum'] = $cinfo['minnum'];
				$list[$key]['endtime'] = $cinfo['endtime'];
				$list[$key]['price'] = $cinfo['price'];
			}
		}
		$this->assign('list',$list);
		$this->display();
	}
}
?>