<?php
/**
* 
*/
class OrderAction extends Action
{
	
	function index()
	{
		$uid = I('uid');
		if(empty($uid)){
			Header("Location: http://".$_SERVER['HTTP_HOST']."/index.php");
			exit();
		}
		$pid = I('id');
		$level = I('e');
		$bid = I('bid');
		if(empty($bid)){
			$level = getLevel($level);
		}else{
			$Blindman = M('Blindman');
			$binfo = $Blindman->field('level')->where('id='.$bid)->find();
			$level = $binfo['level'];
		}
		$num = I('multiplier');
		$User = M('User');
		$uinfo = $User->field('phone')->where('id='.$uid)->find();
		$this->assign('pid',$pid);
		$this->assign('num',$num);
		$this->assign('level',$level);
		$this->assign('bid',$bid);
		$this->assign('uid',$uid);
		$this->assign('phone',$uinfo['phone']);
		$this->display();
	}

	function step2(){
		$pid = I('pid');
		$level = I('level');
		$bid = I('bid');
		$num = I('num');
		$uid = I('uid');
		$phone = I('phone');
		$name = I('name');
		$address = I('address');
		$lou = I('lou');
		$beizhu = I('beizhu');

		$this->assign('pid',$pid);
		$this->assign('num',$num);
		$this->assign('level',$level);
		$this->assign('bid',$bid);
		$this->assign('uid',$uid);
		$this->assign('phone',$phone);
		$this->assign('name',$name);
		$this->assign('address',$address);
		$this->assign('lou',$lou);
		$this->assign('beizhu',$beizhu);

		//时间
		$today = strtotime(date('Y-m-d')." 10:00:00");
		$tomorrow = $today + 86400;
		$aftertomorrow = $tomorrow + 86400;

		//车程时间
		$System = M('System');
		$config = $System->field('addtime')->where('id=1')->find();

		$k = 24;
		$Btime = M('Btime');
		if (empty($bid)) {
			//没有特定按摩师
			// 今天
			for ($i=0; $i < $k; $i++) {
				$nowtime = strtotime(date('Y-m-d H:i').":00");
				if ($nowtime < $today + 1800*$i - $config['addtime']){
					$info = $Btime->field('isok')->where('tid='.$i." and bdate=".$today)->find();
					if(empty($info)){
						$todayarr[$i]['status'] = "isok";
					}else{
						if ($info['isok']==1) {
							$todayarr[$i]['status'] = "isok";
						}else{
							$todayarr[$i]['status'] = "";
						}
					}
				}else{
					$todayarr[$i]['status'] = "";
				}
				$todayarr[$i]['timeclock'] = date('H:i',$today + 1800*$i);
			}
			// 明天
			for ($i=0; $i < $k; $i++) {
				$info = $Btime->field('isok')->where('tid='.$i." and bdate=".$tomorrow)->find();
				if(empty($info)){
					$tomorrowarr[$i]['status'] = "isok";
				}else{
					if ($info['isok']==1) {
						$tomorrowarr[$i]['status'] = "isok";
					}else{
						$tomorrowarr[$i]['status'] = "";
					}
				}
				$tomorrowarr[$i]['timeclock'] = date('H:i',$tomorrow + 1800*$i);
			}
			// 后天
			for ($i=0; $i < $k; $i++) {
				$info = $Btime->field('isok')->where('tid='.$i." and bdate=".$aftertomorrow)->find();
				if(empty($info)){
					$aftertomorrowarr[$i]['status'] = "isok";
				}else{
					if ($info['isok']==1) {
						$aftertomorrowarr[$i]['status'] = "isok";
					}else{
						$aftertomorrowarr[$i]['status'] = "";
					}
				}
				$aftertomorrowarr[$i]['timeclock'] = date('H:i',$aftertomorrow + 1800*$i);
			}
		}else{
			// 有固定按摩师
			// 今天
			for ($i=0; $i < $k; $i++) {
				$nowtime = strtotime(date('Y-m-d H:i').":00");
				if ($nowtime < $today + 1800*$i - $config['addtime']){
					$info = $Btime->field('isok,blindmans')->where('tid='.$i." and bdate=".$today)->find();
					if(empty($info)){
						$todayarr[$i]['status'] = "isok";
					}else{
						if ($info['isok']==1) {
							$blindmansarr = json_decode($info['blindmans'],true);
							if(in_array($bid,$blindmansarr)){
								$todayarr[$i]['status'] = "";
							} else{
								$todayarr[$i]['status'] = "isok";
							}
						}else{
							$todayarr[$i]['status'] = "";
						}
					}
				}else{
					$todayarr[$i]['status'] = "";
				}
				$todayarr[$i]['timeclock'] = date('H:i',$today + 1800*$i);
			}
			// 明天
			for ($i=0; $i < $k; $i++) {
				$info = $Btime->field('isok,blindmans')->where('tid='.$i." and bdate=".$tomorrow)->find();
				if(empty($info)){
					$tomorrowarr[$i]['status'] = "isok";
				}else{
					if ($info['isok']==1) {
						$blindmansarr = json_decode($info['blindmans'],true);
						if(in_array($bid,$blindmansarr)){
							$tomorrowarr[$i]['status'] = "";
						} else{
							$tomorrowarr[$i]['status'] = "isok";
						}
					}else{
						$tomorrowarr[$i]['status'] = "";
					}
				}
				$tomorrowarr[$i]['timeclock'] = date('H:i',$tomorrow + 1800*$i);
			}
			// 后天
			for ($i=0; $i < $k; $i++) {
				$info = $Btime->field('isok,blindmans')->where('tid='.$i." and bdate=".$aftertomorrow)->find();
				if(empty($info)){
					$aftertomorrowarr[$i]['status'] = "isok";
				}else{
					if ($info['isok']==1) {
						$blindmansarr = json_decode($info['blindmans'],true);
						if(in_array($bid,$blindmansarr)){
							$aftertomorrowarr[$i]['status'] = "";
						} else{
							$aftertomorrowarr[$i]['status'] = "isok";
						}
					}else{
						$aftertomorrowarr[$i]['status'] = "";
					}
				}
				$aftertomorrowarr[$i]['timeclock'] = date('H:i',$aftertomorrow + 1800*$i);
			}
		}
		$this->assign('todayarr',$todayarr);
		$this->assign('tomorrowarr',$tomorrowarr);
		$this->assign('aftertomorrowarr',$aftertomorrowarr);
		$this->display();
	}

	function selectblindman(){
		$pid = I('pid');
		$level = I('level');
		$num = I('num');
		$uid = I('uid');
		$phone = I('phone');
		$name = I('name');
		$address = I('address');
		$lou = I('lou');
		$beizhu = I('beizhu');

		$this->assign('pid',$pid);
		$this->assign('num',$num);
		$this->assign('level',$level);
		$this->assign('uid',$uid);
		$this->assign('phone',$phone);
		$this->assign('name',$name);
		$this->assign('address',$address);
		$this->assign('lou',$lou);
		$this->assign('beizhu',$beizhu);

		$sdate = I('sdate');
		$stime = I('stime');

		$this->assign('sdate',$sdate);
		$this->assign('stime',$stime);

		$today = strtotime(date('Y-m-d')." 10:00:00");
		$tomorrow = $today + 86400;
		$aftertomorrow = $tomorrow + 86400;

		$Product = M('Product');
		$pinfo = $Product->field('timelong')->where('id='.$pid)->find();

		//车程时间
		$System = M('System');
		$config = $System->field('addtime')->where('id=1')->find();
		$Btime = M('Btime');

		switch ($sdate) {
			case '0':
				$starttime = date("m月d号 H:i",$today + $stime * 1800);
				$endtime = date("H:i",$today + $stime * 1800 + $pinfo['timelong']*60*$num);
				$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
				for ($i=0; $i <= $j; $i++) { 
					$info = $Btime->field('blindmans')->where('tid='.$stime+$i.' and bdate='.$today)->find();
					$blindmansarr = json_decode($info['blindmans'],true);
					$barr = array_merge($blindmansarr,$barr);
				}
				break;
			case '1':
				$starttime = date("m月d号 H:i",$tomorrow + $stime * 1800);
				$endtime = date("H:i",$tomorrow + $stime * 1800 + $pinfo['timelong']*60*$num);
				$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
				for ($i=0; $i <= $j; $i++) { 
					$info = $Btime->field('blindmans')->where('tid='.$stime+$i.' and bdate='.$tomorrow)->find();
					$blindmansarr = json_decode($info['blindmans'],true);
					$barr = array_merge($blindmansarr,$barr);
				}
				break;
			case '2':
				$starttime = date("m月d号 H:i",$aftertomorrow + $stime * 1800);
				$endtime = date("H:i",$aftertomorrow + $stime * 1800 + $pinfo['timelong']*60*$num);
				$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
				for ($i=0; $i <= $j; $i++) { 
					$info = $Btime->field('blindmans')->where('tid='.$stime+$i.' and bdate='.$aftertomorrow)->find();
					$blindmansarr = json_decode($info['blindmans'],true);
					$barr = array_merge($blindmansarr,$barr);
				}
				break;
			default:
				$this->error('参数错误');
				break;
		}

		$this->assign('starttime',$starttime);
		$this->assign('endtime',$endtime);
		$this->assign('timestep',$j);
		$Blindman = M('Blindman');
		$map['level'] = $level;
		if(empty($barr)){
			$list = $Blindman->field('img,id,name,ordernum,sex')->where($map)->select();
		}else{
			$map['id'] = array('not in',$barr);
			$list = $Blindman->field('img,id,name,ordernum,sex')->where($map)->select();
		}
		$this->assign('bid',$list['0']['id']);
		$this->assign('list',$list);
		$this->display();
	}

	function step3(){
		$pid = I('pid');
		$level = I('level');
		$num = I('num');
		$uid = I('uid');
		$phone = I('phone');
		$name = I('name');
		$address = I('address');
		$lou = I('lou');
		$beizhu = I('beizhu');
		$bid = I('bid');

		$this->assign('pid',$pid);
		$this->assign('num',$num);
		$this->assign('level',$level);
		$this->assign('uid',$uid);
		$this->assign('phone',$phone);
		$this->assign('name',$name);
		$this->assign('address',$address);
		$this->assign('lou',$lou);
		$this->assign('beizhu',$beizhu);
		$this->assign('bid',$bid);

		$sdate = I('sdate');
		$stime = I('stime');

		$this->assign('sdate',$sdate);
		$this->assign('stime',$stime);

		$timestep = I('timestep');
		$this->assign('timestep',$timestep);

		$Package = M('Package');
		$pinfo = $Package->field('price')->where('pid = '.$pid.' and title="'.$level.'"')->find();

		$Coupons_info = M('Coupons_info');
		$Coupons = M('Coupons');
		$clist = $Coupons_info->where('uid='.$uid.' and usetime is null')->select();
		foreach ($clist as $key => $value) {
			$map['id'] = $value['cid'];
			$map['minnum'] = array('elt',$num);
			$map['minprice'] = array('elt',$num*$pinfo['price']);
			$map['endtime'] = array('gt', time());
			$cinfo = $Coupons->where($map)->limit('0,1')->find();
			if (!empty($cinfo)) {
				$cinfo['coupons'] = $value['id'];
				break;
			}
		}
		$this->assign('cinfo',$cinfo);

		$total = $num*$pinfo['price'];
		if (empty($cinfo)) {
			$paymoney = $total;
		}else{
			$paymoney = $num*$pinfo['price'] - $cinfo['price'];
		}
		$this->assign('total',$total);
		$this->assign('paymoney',$paymoney);

		$User = M('User');
		$uinfo = $User->field('money')->where('id='.$uid)->find();
		$this->assign('money',$uinfo['money']);

		$Product = M('Product');
		$prinfo = $Product->field('img,title')->where('id='.$pid)->find();
		$this->assign('prinfo',$prinfo);

		$Blindman = M('Blindman');
		$binfo = $Blindman->field('name')->where('id='.$bid)->find();
		$this->assign('blindman',$binfo['name']);

		$today = strtotime(date('Y-m-d')." 10:00:00");
		$tomorrow = $today + 86400;
		$aftertomorrow = $tomorrow + 86400;

		switch ($sdate) {
			case '0':
				$starttime = date("今天 H:i",$today + $stime * 1800);
				break;
			case '1':
				$starttime = date("明天 H:i",$tomorrow + $stime * 1800);
				break;
			case '2':
				$starttime = date("后天 H:i",$aftertomorrow + $stime * 1800);
				break;
		}
		$this->assign('starttime',$starttime);

		$this->display();
	}

	function submitorder(){
		$pid = I('pid');
		$level = I('level');
		$num = I('num');
		$uid = I('uid');
		$phone = I('phone');
		$name = I('name');
		$address = I('address');
		$lou = I('lou');
		$beizhu = I('beizhu');
		$bid = I('bid');
		$sdate = I('sdate');
		$stime = I('stime');
		$timestep = I('timestep');
		$cid = I('cid');

		$today = strtotime(date('Y-m-d')." 10:00:00");
		$tomorrow = $today + 86400;
		$aftertomorrow = $tomorrow + 86400;
		switch ($sdate) {
			case '0':
				$starttime = $today + $stime * 1800;
				$bdate = $today;
				break;
			case '1':
				$starttime = $tomorrow + $stime * 1800;
				$bdate = $tomorrow;
				break;
			case '2':
				$starttime = $aftertomorrow + $stime * 1800;
				$bdate = $aftertomorrow;
				break;
			default:
				$starttime = $today + $stime * 1800;
				$bdate = $today;
				break;
		}

		$Product = M('Product');
		$prinfo = $Product->field('title')->where('id='.$pid)->find();

		$Package = M('Package');
		$pinfo = $Package->field('price')->where('pid = '.$pid.' and title="'.$level.'"')->find();

		$Coupons_info = M('Coupons_info');
		$Coupons = M('Coupons');
		$cinfo = $Coupons_info->field('cid')->where('id='.$cid)->find();
		$couinfo = $Coupons->field('price')->where('id='.$cinfo['cid'])->find();

		$timeStamp = time();
		$Orders = M('Orders');
		$data['uid'] = $uid;
		$data['bid'] = $bid;
		$data['pid'] = $pid;
		$data['num'] = $num;
		$data['price'] = $pinfo['price'];
		$data['total'] = $pinfo['price']*$num - $couinfo['price'];
		$data['cid'] = $cid;
		$data['status'] = 1;
		$data['addtime'] = time();
		$data['out_trade_no'] = $timeStamp;
		$data['starttime'] = $starttime;
		$data['address'] $address;
		$data['lou'] = $lou;
		$data['name'] = $name;
		$data['phone'] = $phone;
		if ($Orders->add($data)) {
			$couponsdata['usetime'] = time();
			$Coupons_info->where('id='.$cid)->save($couponsdata);

			$Btime = M('Btime');
			for ($i=0; $i <= $timestep; $i++) {
				$stime += $i;
				$btinfo = $Btime->field('id,blindmans')->where('tid='.$stime.' and bdate='.$bdate)->find();
				$blindmans = json_decode($btinfo['blindmans'],true);
				array_push($blindmans, $bid);
				$btdata['blindmans'] = json_encode($blindmans);
				$Btime->where('id='.$btinfo['id'])->save($btdata);
			}
			Vendor('Weixin.WxPayPubHelper.WxPayPubHelper');
			$User = M('User');
			$uinfo = $User->field('openid')->where('id='.$uid)->find();
			$openid = $uinfo['openid'];
			$unifiedOrder = new UnifiedOrder_pub();
			$unifiedOrder->setParameter("openid","$openid");//商品描述
			$unifiedOrder->setParameter("body",$prinfo['title']);//商品描述
			
			$out_trade_no = $timeStamp;
			$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			$unifiedOrder->setParameter("total_fee",$data['total']);//总金额
			$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
			$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
			$prepay_id = $unifiedOrder->getPrepayId();
			//=========步骤3：使用jsapi调起支付============
			$jsApi->setPrepayId($prepay_id);

			$jsApiParameters = $jsApi->getParameters();

			echo "<script type='text/javascript'>";
			echo "//调用微信JS api 支付
					function jsApiCall()
					{
						WeixinJSBridge.invoke(
							'getBrandWCPayRequest',
							<?php echo $jsApiParameters; ?>,
							function(res){
								WeixinJSBridge.log(res.err_msg);
								//alert(res.err_code+res.err_desc+res.err_msg);
							}
						);
					}";
			echo "jsApiCall()";
			echo "</script>";
		}else{
			$this->error('订单提交失败！');
		}

	}

	function orderlist(){
		$Orders = M('Orders');
		$uid = I('uid');
		$page = I('page','1');
		$count = 5;
		$list = $Orders->where('uid='.$uid)->limit($count * ($page-1).','.$count)->select();
		if(empty($list)){
			$isempty = 2;
		}else{
			$Product = M('Product');
			foreach ($list as $key => $value) {
				 $pinfo = $Product->field('title,timelong,img')->where('id='.$value['pid'])->find();
				 $list[$key]['title'] = $pinfo['title'];
				 $list[$key]['timelong'] = $pinfo['timelong'];
				 $list[$key]['img'] = $pinfo['img'];
			}
			$isempty = 1;
		}
		$this->assign('isempty',$isempty);
		$this->assign('list',$list);
		$this->display();
	}
	function orderinfo(){
		$id = I('id');
		$uid = I('uid');
		$Orders = M('Orders');
		$oinfo = $Orders->where('id='.$id)->find();
		$Product = M('Product');
		$Blindman = M('Blindman');
		$Coupons = M('Coupons');
		$Coupons_info = M('Coupons_info');
		$pinfo = $Product->where('id='.$oinfo['pid'])->find();
		$binfo = $Blindman->where('id='.$oinfo['bid'])->find();
		$ciinfo = $Coupons_info->where('id='.$oinfo['cid'])->find();
		$cinfo = $Coupons->where('id='.$ciinfo['cid'])->find();
		$this->assign('pinfo',$pinfo);
		$this->assign('binfo',$binfo);
		$this->assign('oinfo',$oinfo);
		$this->assign('cinfo',$cinfo);
		$this->display();
	}
}
?>