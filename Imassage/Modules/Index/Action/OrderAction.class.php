<?php
/**
* 
*/
class OrderAction extends Action
{
	
	function index()
	{
		//$uid = I('uid');
		//if(empty($uid)){
			Vendor('Weixin.WxPayPubHelper.WxPayPubHelper');
			//使用jsapi接口
			$jsApi = new JsApi_pub();

			//=========步骤1：网页授权获取用户openid============
			//通过code获得openid
			if (!isset($_GET['code']))
			{
				$callbackurl = json_encode($_GET);
				
				//触发微信返回code码
				$url = $jsApi->createOauthUrlForCode("http://w.jiningjianye.com/index.php/order",$callbackurl);
				Header("Location: $url"); 
				exit();
			}
			else
			{
				//获取code码，以获取openid
			    $code = $_GET['code'];
			    $state = $_GET['state'];
				$jsApi->setCode($code);
				$openid = $jsApi->getOpenId();
			}
			if (empty($openid)) {
				echo "没有openid";
				exit();
			}
			$User = M('User');
			$userinfo = $User->field('id,phone,name,address,lou')->where('openid="'.$openid.'"')->find();
			$uid = $userinfo['id'];
		//}
		$state = json_decode($state,true);
		
		$pid = $state['pid'];
		
		$level = $state['e'];
		$num = $state['multiplier'];
		if(empty($num)){
			$selectnum = 1; //添加数量选择
		}else{
			$selectnum = 2;
		}
		$bid = $state['bid'];
		$Product = M('Product');
		$pinfo = $Product->field('minpeople')->where('id='.$pid)->find();
		if(empty($bid)){
			$level = getLevel($level);
		}else{
			$Blindman = M('Blindman');
			$binfo = $Blindman->field('level')->where('id='.$bid)->find();
			$level = $binfo['level'];
		}

		//$User = M('User');
		//$uinfo = $User->field('phone')->where('id='.$uid)->find();
		$this->assign('pid',$pid);
		$this->assign('num',$num);
		$this->assign('selectnum',$selectnum);
		$this->assign('level',$level);
		$this->assign('bid',$bid);
		$this->assign('uid',$uid);
		$this->assign('userinfo',$userinfo);
		$this->assign('pinfo',$pinfo);
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

		
		$User = M('User');
		$uinfo = $User->field('address')->where('id='.$uid)->find();
		if(empty($uinfo)){
			$udata['address'] = $address;
			$udata['name'] = $name;
			$udata['lou'] = $lou;
			$User->where('id='.$uid)->save($udata);
		}

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
		$Product = M('Product');
		$pinfo = $Product->field('timelong')->where('id='.$pid)->find();

		$g = 24;
		$Btime = M('Btime');
		
		if (empty($bid)) {
			//没有特定按摩师
			$Blindman = M('Blindman');
			$bllist = $Blindman->field('id')->where('level = "'.$level.'"')->select(); //(7，9)
			$bllistarr = array();
			foreach ($bllist as $key => $value) {
				array_push($bllistarr, $value['id']);
			}
			sort($bllistarr);
			// 今天
			for ($i=0; $i < $g; $i++) {
				$nowtime = strtotime(date('Y-m-d H:i').":00");
				if ($nowtime < $today + 1800*$i - $config['addtime']){
					// $info = $Btime->field('isok')->where('tid='.$i." and bdate=".$today)->find();
					// if(empty($info)){
					// 	$todayarr[$i]['status'] = "isok";
					// }else{
					// 	if ($info['isok']==1) {
					// 		$todayarr[$i]['status'] = "isok";
					// 	}else{
					// 		$todayarr[$i]['status'] = "";
					// 	}
					// }
					

					$info = $Btime->field('blindmans')->where('tid='.$i." and bdate=".$today)->find();
					$blist = json_decode($info['blindmans'],true); //(1,5)
					sort($blist);
					if ($bllistarr == array_intersect($blist, $bllistarr)) { //()
						//没按摩师了
						
						$todayarr[$i]['status'] = "";
					}else{
						$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
						$barr = array();
						
						for ($k = 0; $k <= $j; $k++) { 
							$newstiem = $i+$k;
							
							$info = $Btime->field('blindmans')->where('tid='.$newstiem.' and bdate='.$today)->find();
							//echo $Btime->getlastsql();

							$blindmansarr = json_decode($info['blindmans'],true); // (7，9)
							
							sort($blindmansarr);
							if ($bllistarr == array_intersect($blindmansarr, $bllistarr)) { //()
								//没按摩师了
								$flag = 1;
								$todayarr[$i]['status'] = "";
								break;
							}else{
								$flag = 2;
								$todayarr[$i]['status'] = "isok";
							}
							
						}
						

					}
				}else{
					$todayarr[$i]['status'] = "";
				}
				$todayarr[$i]['timeclock'] = date('H:i',$today + 1800*$i);
			}
			// 明天
			for ($i=0; $i < $g; $i++) {
				$info = $Btime->field('blindmans')->where('tid='.$i." and bdate=".$tomorrow)->find();
				$blist = json_decode($info['blindmans'],true); //(1,5)
				sort($blist);
				if ($bllist == array_intersect($blist, $bllist)) { //()
					//没按摩师了
					$tomorrowarr[$i]['status'] = "";
				}else{
					$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
						$barr = array();
						
						for ($k = 0; $k <= $j; $k++) { 
							$newstiem = $i+$k;
							
							$info = $Btime->field('blindmans')->where('tid='.$newstiem.' and bdate='.$tomorrow)->find();
							//echo $Btime->getlastsql();

							$blindmansarr = json_decode($info['blindmans'],true); // (7，9)
							
							sort($blindmansarr);
							if ($bllistarr == array_intersect($blindmansarr, $bllistarr)) { //()
								//没按摩师了
								$flag = 1;
								$tomorrowarr[$i]['status'] = "";
								break;
							}else{
								$flag = 2;
								$tomorrowarr[$i]['status'] = "isok";
							}
							
						}
					
				}
				// if(empty($info)){
				// 	$tomorrowarr[$i]['status'] = "isok";
				// }else{
				// 	if ($info['isok']==1) {
				// 		$tomorrowarr[$i]['status'] = "isok";
				// 	}else{
				// 		$tomorrowarr[$i]['status'] = "";
				// 	}
				// }

				$tomorrowarr[$i]['timeclock'] = date('H:i',$tomorrow + 1800*$i);
			}
			// 后天
			for ($i=0; $i < $g; $i++) {
				$info = $Btime->field('blindmans')->where('tid='.$i." and bdate=".$aftertomorrow)->find();
				$blist = json_decode($info['blindmans'],true); //(1,5)
				if ($bllist == array_intersect($blist, $bllist)) { //()
					//没按摩师了
					$aftertomorrowarr[$i]['status'] = "";
				}else{
					$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
						$barr = array();
						
						for ($k = 0; $k <= $j; $k++) { 
							$newstiem = $i+$k;
							
							$info = $Btime->field('blindmans')->where('tid='.$newstiem.' and bdate='.$aftertomorrow)->find();
							//echo $Btime->getlastsql();

							$blindmansarr = json_decode($info['blindmans'],true); // (7，9)
							
							sort($blindmansarr);
							if ($bllistarr == array_intersect($blindmansarr, $bllistarr)) { //()
								//没按摩师了
								$flag = 1;
								$aftertomorrowarr[$i]['status'] = "";
								break;
							}else{
								$flag = 2;
								$aftertomorrowarr[$i]['status'] = "isok";
							}
							
						}
					
				}
				// if(empty($info)){
				// 	$aftertomorrowarr[$i]['status'] = "isok";
				// }else{
				// 	if ($info['isok']==1) {
				// 		$aftertomorrowarr[$i]['status'] = "isok";
				// 	}else{
				// 		$aftertomorrowarr[$i]['status'] = "";
				// 	}
				// }
				$aftertomorrowarr[$i]['timeclock'] = date('H:i',$aftertomorrow + 1800*$i);
			}
		}else{
			// 有固定按摩师
			// 今天
			for ($i=0; $i < $g; $i++) {
				$nowtime = strtotime(date('Y-m-d H:i').":00");
				if ($nowtime < $today + 1800*$i - $config['addtime']){
					$info = $Btime->field('blindmans')->where('tid='.$i." and bdate=".$today)->find();
					if(empty($info)){
						$todayarr[$i]['status'] = "isok";
					}else{
						
						$blindmansarr = json_decode($info['blindmans'],true);
						if(in_array($bid,$blindmansarr)){
							$todayarr[$i]['status'] = "";
						} else{
							$todayarr[$i]['status'] = "isok";
						}
						
					}
				}else{
					$todayarr[$i]['status'] = "";
				}
				$todayarr[$i]['timeclock'] = date('H:i',$today + 1800*$i);
			}
			// 明天
			for ($i=0; $i < $g; $i++) {
				$info = $Btime->field('blindmans')->where('tid='.$i." and bdate=".$tomorrow)->find();
				if(empty($info)){
					$tomorrowarr[$i]['status'] = "isok";
				}else{
					
						$blindmansarr = json_decode($info['blindmans'],true);
						if(in_array($bid,$blindmansarr)){
							$tomorrowarr[$i]['status'] = "";
						} else{
							$tomorrowarr[$i]['status'] = "isok";
						}
					
				}
				$tomorrowarr[$i]['timeclock'] = date('H:i',$tomorrow + 1800*$i);
			}
			// 后天
			for ($i=0; $i < $g; $i++) {
				$info = $Btime->field('blindmans')->where('tid='.$i." and bdate=".$aftertomorrow)->find();
				if(empty($info)){
					$aftertomorrowarr[$i]['status'] = "isok";
				}else{
					
						$blindmansarr = json_decode($info['blindmans'],true);
						if(in_array($bid,$blindmansarr)){
							$aftertomorrowarr[$i]['status'] = "";
						} else{
							$aftertomorrowarr[$i]['status'] = "isok";
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
		$barr = array();
		switch ($sdate) {
			case '0':
				$starttime = date("m月d号 H:i",$today + $stime * 1800);
				$endtime = date("H:i",$today + $stime * 1800 + $pinfo['timelong']*60*$num);
				$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
				
				for ($i=0; $i <= $j; $i++) { 
					$newstiem = $stime+$i;
					$info = $Btime->field('blindmans')->where('tid='.$newstiem.' and bdate='.$today)->find();
					//echo $Btime->getlastsql();
					$blindmansarr = json_decode($info['blindmans'],true);
					if (!empty($blindmansarr)) {
						$barr = array_unique(array_merge($blindmansarr,$barr));
					}
				}
				break;
			case '1':
				$starttime = date("m月d号 H:i",$tomorrow + $stime * 1800);
				$endtime = date("H:i",$tomorrow + $stime * 1800 + $pinfo['timelong']*60*$num);
				$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
				for ($i=0; $i <= $j; $i++) { 
					$newstiem = $stime+$i;
					$info = $Btime->field('blindmans')->where('tid='.$newstiem.' and bdate='.$tomorrow)->find();
					$blindmansarr = json_decode($info['blindmans'],true);
					
					if (!empty($blindmansarr)) {
						$barr = array_unique(array_merge($blindmansarr,$barr));
					}

				}
				break;
			case '2':
				$starttime = date("m月d号 H:i",$aftertomorrow + $stime * 1800);
				$endtime = date("H:i",$aftertomorrow + $stime * 1800 + $pinfo['timelong']*60*$num);
				$j = ceil(($pinfo['timelong']*60*$num + $config['addtime'])/1800);
				for ($i=0; $i <= $j; $i++) { 
					$newstiem = $stime+$i;
					$info = $Btime->field('blindmans')->where('tid='.$newstiem.' and bdate='.$aftertomorrow)->find();
					$blindmansarr = json_decode($info['blindmans'],true);
					if (!empty($blindmansarr)) {
						$barr = array_unique(array_merge($blindmansarr,$barr));
					}
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
		$k=0;
		foreach ($clist as $key => $value) {
			$map['id'] = $value['cid'];
			$map['minnum'] = array('elt',$num);
			$map['minprice'] = array('elt',$num*$pinfo['price']);
			$map['endtime'] = array('gt', time());
			$cinfo = $Coupons->where($map)->find();
			if (!empty($cinfo)) {
				$coulist[$k]['id'] = $value['id'];
				$coulist[$k]['title'] = $cinfo['title'];
				$coulist[$k]['price'] = $cinfo['price'];
				$k++;
			}
		}
		$this->assign('coulist',$coulist);

		$total = $num*$pinfo['price'];
		if (empty($coulist)) {
			$paymoney = $total;
		}else{
			$paymoney = $num*$pinfo['price'] - $coulist[0]['price'];
		}
		$this->assign('total',$total);
		$this->assign('paymoney',$paymoney);

		$User = M('User');
		$uinfo = $User->field('money')->where('id='.$uid)->find();
		$this->assign('money',$uinfo['money']);

		$Product = M('Product');
		$prinfo = $Product->field('img,title,typeid')->where('id='.$pid)->find();
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
		header("Content-Type: text/html; charset=utf-8");
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

		if (!empty($cid)) {
			$Coupons_info = M('Coupons_info');
			$Coupons = M('Coupons');
			$cinfo = $Coupons_info->field('cid')->where('id='.$cid)->find();
			$couinfo = $Coupons->field('price')->where('id='.$cinfo['cid'])->find();
			$cprice = $couinfo['price'];
		}else{
			$cprice = 0;
		}

		$Btime = M('Btime');
			for ($i=0; $i <= $timestep; $i++) {
				$stime += 1;
				$btinfo = $Btime->field('id,blindmans')->where('tid='.$stime.' and bdate='.$bdate)->find();
				if (empty($btinfo)) {
					$btdata['tid'] = $stime;
					$btdata['blindmans'] = json_encode(array($bid));
					$btdata['bdate'] = $bdate;
					$Btime->add($btdata);
				}else{
					$blindmans = json_decode($btinfo['blindmans'],true);
					if(in_array($bid, $blindmans)){
						echo "<script type='text/javascript'>";
						echo "alert('该按摩师时间安排满了！');";
						echo "window.history.back(-1);";
						echo "</script>";
						exit();
					}else{
						array_push($blindmans, $bid);
						$btdata['blindmans'] = json_encode($blindmans);
						$Btime->where('id='.$btinfo['id'])->save($btdata);
					}	
				}
			}

		$timeStamp = time();
		$Orders = M('Orders');
		$data['uid'] = $uid;
		$data['bid'] = $bid;
		$data['pid'] = $pid;
		$data['num'] = $num;
		$data['price'] = $pinfo['price'];
		$data['total'] = $pinfo['price']*$num - $cprice;
		$data['cid'] = $cid;
		$data['status'] = 1;
		$data['addtime'] = time();
		$data['out_trade_no'] = $timeStamp;
		$data['starttime'] = $starttime;
		$data['address'] = $address;
		$data['lou'] = $lou;
		$data['name'] = $name;
		$data['phone'] = $phone;
		$data['beizhu'] = $beizhu;
		if ($Orders->add($data)) {
			if (!empty($cid)) {
				$couponsdata['usetime'] = time();
				$Coupons_info->where('id='.$cid)->save($couponsdata);
			}
			

			$Blindman = M('Blindman');
			$Blindman->where('id='.$bid)->setInc('ordernum');

			
			Vendor('Weixin.WxPayPubHelper.WxPayPubHelper');
			//=========步骤1：网页授权获取用户openid============
			$User = M('User');
			$uinfo = $User->field('openid')->where('id='.$uid)->find();
			$openid = $uinfo['openid'];

			//=========步骤2：使用统一支付接口，获取prepay_id============
			$unifiedOrder = new UnifiedOrder_pub();
			$unifiedOrder->setParameter("openid","$openid");//商品描述
			$unifiedOrder->setParameter("body",$prinfo['title']);//商品描述
			
			$out_trade_no = $timeStamp;
			$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
			$unifiedOrder->setParameter("total_fee",$data['total']);//总金额
			$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
			$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
			$prepay_id = $unifiedOrder->getPrepayId();

			$jsApi = new JsApi_pub();
			//=========步骤3：使用jsapi调起支付============
			$jsApi->setPrepayId($prepay_id);

			$jsApiParameters = $jsApi->getParameters();
//echo $jsApiParameters;
			echo "<html>
<head>
    <meta http-equiv='content-type' content='text/html;charset=utf-8'/>
    <title>微信安全支付</title>";
			echo "</head><body><script type='text/javascript'>";
			echo "//调用微信JS api 支付
					function jsApiCall()
					{
						WeixinJSBridge.invoke(
							'getBrandWCPayRequest',
							".$jsApiParameters.",
							function(res){
								WeixinJSBridge.log(res.err_msg);
								if(res.err_msg == 'get_brand_wcpay_request:ok' ) {
									alert('支付成功');
									
								}else{
									alert('支付失败');
									
								}
								window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/order/orderlist';
								//alert(res.err_code+res.err_desc+res.err_msg);
							}
						);
					}
					function callpay()
					{
						if (typeof WeixinJSBridge == 'undefined'){
						    if( document.addEventListener ){
						        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
						    }else if (document.attachEvent){
						        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
						        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
						    }
						}else{
						    jsApiCall();
						}
					}
					";

			echo "callpay()";
			echo "</script></body>
</html>";
		}else{
			$this->error('订单提交失败！');
		}

	}

	function orderlist(){
		$Orders = M('Orders');
		$uid = I('uid');
		$page = I('page','1');
		$count = 5;
		$list = $Orders->where('uid='.$uid)->order('id desc')->limit($count * ($page-1).','.$count)->select();
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
		$oinfo = $Orders->where('id='.$id.' and uid='.$uid)->find();
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
	function changeorder(){
		header("Content-Type: text/html; charset=utf-8");
		$id = I('id');
		$uid = I('uid');
		$Orders = M('Orders');
		$oinfo = $Orders->field('status,out_trade_no,pid,total')->where('id='.$id.' and uid='.$uid)->find();
		switch ($oinfo['status']) {
			case '1':
				$Product = M('Product');
				$prinfo = $Product->field('title')->where('id='.$oinfo['pid'])->find();
				Vendor('Weixin.WxPayPubHelper.WxPayPubHelper');
				$User = M('User');
				$uinfo = $User->field('openid')->where('id='.$uid)->find();
				$openid = $uinfo['openid'];
				$unifiedOrder = new UnifiedOrder_pub();
				$unifiedOrder->setParameter("openid","$openid");//商品描述
				$unifiedOrder->setParameter("body",$prinfo['title']);//商品描述
				
				$out_trade_no = $oinfo['out_trade_no'];
				$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
				$unifiedOrder->setParameter("total_fee",$oinfo['total']);//总金额
				$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
				$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
				$prepay_id = $unifiedOrder->getPrepayId();
//echo $uid."|||".$prepay_id;exit();
				$jsApi = new JsApi_pub();
				//=========步骤3：使用jsapi调起支付============
				$jsApi->setPrepayId($prepay_id);

				$jsApiParameters = $jsApi->getParameters();

				Vendor('Weixin.jssdk');
	  			$jssdk = new JSSDK("wx20ec6953f13e5975", "e8ae6545b510c1d653e42fcbfb05feb4");
				$signPackage = $jssdk->GetSignPackage();
				echo "<html>
<head>
    <meta http-equiv='content-type' content='text/html;charset=utf-8'/>
    <title>微信安全支付</title>";
			echo "</head><body><script type='text/javascript'>";
			echo "
					
					//调用微信JS api 支付
					function jsApiCall()
					{
						WeixinJSBridge.invoke(
							'getBrandWCPayRequest',
							".$jsApiParameters.",
							function(res){
								WeixinJSBridge.log(res.err_msg);
								if(res.err_msg == 'get_brand_wcpay_request:ok' ) {
									alert('支付成功');
									
								}else{
									alert('支付失败');
									
								}
								window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/order/orderlist';
								//alert(res.err_code+res.err_desc+res.err_msg);
							}
						);
					}
					function callpay()
					{
						if (typeof WeixinJSBridge == 'undefined'){
						    if( document.addEventListener ){
						        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
						    }else if (document.attachEvent){
						        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
						        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
						    }
						}else{
						    jsApiCall();
						}
					}
					";

			echo "callpay()";
			echo "</script></body>
</html>";
				break;
			case '2':
				$data['tmp_status'] = 2;
				$data['status'] = 6;
				if($Orders->where('id='.$id)->save($data)){
					echo "<script type='text/javascript'>";
					echo "alert('提交成功，等待审核处理！');";
					echo "window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/order/orderlist';";
					echo "</script>";
				}else{
					echo "<script type='text/javascript'>";
					echo "alert('提交失败！');";
					echo "window.history.back(-1);";
					echo "</script>";
				}
				break;
			case '3':
				$data['tmp_status'] = 3;
				$data['status'] = 6;
				if($Orders->where('id='.$id)->save($data)){
					echo "<script type='text/javascript'>";
					echo "alert('提交成功，等待审核处理！');";
					echo "window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/order/orderlist';";
					echo "</script>";
				}else{
					echo "<script type='text/javascript'>";
					echo "alert('提交失败！');";
					echo "window.history.back(-1);";
					echo "</script>";
				}
				break;
			case '4':
				if(empty($oinfo['commentid'])){
					echo "<script type='text/javascript'>";
					echo "window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/order/comment';";
					echo "</script>";
				}else{
					echo "<script type='text/javascript'>";
					echo "alert('此订单已经评论过！');";
					echo "window.history.back(-1);";
					echo "</script>";
				}
				break;
			case '5':
				if(empty($oinfo['commentid'])){
					echo "<script type='text/javascript'>";
					echo "window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/order/comment/id/".$oinfo['id']."';";
					echo "</script>";
				}else{
					echo "<script type='text/javascript'>";
					echo "alert('此订单已经评论过！');";
					echo "window.history.back(-1);";
					echo "</script>";
				}
				break;
			default:
					echo "<script type='text/javascript'>";
					echo "alert('出错！');";
					echo "window.history.back(-1);";
					echo "</script>";
				break;
		}
	}

	public function comment(){
		$uid = I('uid'); 
		$oid = I('id');
		if($_POST){
			$Orders = M('Orders');
			$oinfo = $Orders->field('bid,pid')->where('id='.$oid)->find();
			$data['uid'] = $uid;
			$data['bid'] = $oinfo['bid'];
			$data['pid'] = $oinfo['pid'];
			$data['content'] = I('content');
			$data['addtime'] = time();
			$Comment = M('Comment');
			if($Comment->add($data)){
					echo "<script type='text/javascript'>";
					echo "alert('谢谢您的评论！');";
					echo "window.location.href='http://".$_SERVER['HTTP_HOST']."/index.php/Check/index?state=/order/orderlist';";
					echo "</script>";
			}else{
					echo "<script type='text/javascript'>";
					echo "alert('评论失败！');";
					echo "window.history.back(-1);";
					echo "</script>";
			}
			exit();
		}
		$this->display();
	}

	public function notify_url(){
		Vendor('Weixin.WxPayPubHelper.WxPayPubHelper');
		//使用通用通知接口
		$notify = new Notify_pub();

		//存储微信的回调
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
		$notify->saveData($xml);
		
		//验证签名，并回应微信。
		//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
		//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
		//尽可能提高通知的成功率，但微信不保证通知最终能成功。
		if($notify->checkSign() == FALSE){
			$notify->setReturnParameter("return_code","FAIL");//返回状态码
			$notify->setReturnParameter("return_msg","签名失败");//返回信息
		}else{
			$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
		}
		$returnXml = $notify->returnXml();
		echo $returnXml;
		if($notify->checkSign() == TRUE)
		{
			if ($notify->data["return_code"] == "FAIL") {
				//此处应该更新一下订单状态，商户自行增删操作
				//$log_->log_result($log_name,"【通信出错】:\n".$xml."\n");
			}
			elseif($notify->data["result_code"] == "FAIL"){
				//此处应该更新一下订单状态，商户自行增删操作
				//$log_->log_result($log_name,"【业务出错】:\n".$xml."\n");
			}
			else{
				//此处应该更新一下订单状态，商户自行增删操作
				//$log_->log_result($log_name,"【支付成功】:\n".$xml."\n");
				$out_trade_no = $notify->data['out_trade_no'];
				$Orders = M('Orders');
				$info = $Orders->field('id')->where('out_trade_no='.$out_trade_no)->find();
				if (!empty($info)) {
					$data['status'] = 2;
					$Orders->where('id='.$info['id'])->save($data);
				}
			}
			
			//商户自行增加处理流程,
			//例如：更新订单状态
			//例如：数据库操作
			//例如：推送支付完成信息
		}
	}
}
?>