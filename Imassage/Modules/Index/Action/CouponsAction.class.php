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

	public function addcoupon(){
		header("Content-Type: text/html; charset=utf-8");
		$code = I('code');
		$uid = I('uid');
		$Coupons_info = M('Coupons_info');
		$info = $Coupons_info->where('code="'.$code.'"')->find();
		if (empty($info)) {
			echo "<script type='text/javascript'>";
			echo "alert('没有此优惠券！');";
			echo "window.history.back(-1);";
			echo "</script>";
		}else{
			if(empty($info['uid'])){
				$data['uid'] = $uid;
				if($Coupons_info->where('id='.$info['id'])->save($data)){
					echo "<script type='text/javascript'>";
					echo "alert('添加成功！');";
					echo "window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/coupons/index';";
					echo "</script>";
				}else{
					echo "<script type='text/javascript'>";
					echo "alert('添加失败！');";
					echo "window.history.back(-1);";
					echo "</script>";
				}
			}else{
				echo "<script type='text/javascript'>";
				echo "alert('此优惠券已经使用！');";
				echo "window.history.back(-1);";
				echo "</script>";
			}
		}
	}
}
?>