<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Imassage爱按摩</title>
	<meta name="viewport" content="width=320,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	
	<link rel="icon" href="__PUBLIC__/img/favicon.png" type="image/png">
	<link rel="shortcut icon" href="__PUBLIC__/img/favicon.png" type="image/png">
	
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/global.css">
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/global.wx.css">
	
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/p_detail.css">
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/p_list.css">
	
	<script type="text/javascript" crossorigin="anonymous">
		window.CONSTANT = {
			CACHE_VERSION: "100",
			isDebugEnv: false,
			JQuerySourceUrl: "__PUBLIC__/js/jquery.min.js"
		};
		if(CONSTANT.CACHE_VERSION != localStorage.CACHE_VERSION){
			console.warn('Clear local cache!!!');
			localStorage.clear();
			localStorage.CACHE_VERSION = CONSTANT.CACHE_VERSION;
		}
	</script>
	<script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/detail.product.create.js"></script>
	<script type="text/javascript" crossorigin="anonymous">
	$(document).ready(function(){
		var u = navigator.userAgent
		if(u.indexOf('iPhone') > -1){
			$("body").addClass("iOs iphone");
		}
		$(".back-select").click(function(){
			window.history.go(-1);
		});
	})
	</script>
</head>
<body class="">
		<div id="AppointType">
		<div class="wrap">
			<div style="line-height:45px; color:#fff;"><?php echo ($info["title"]); ?></div>
			<div id="citySelect" class="back-select">
				<i class="back-loc"></i>
			</div>
		</div>
		</div>
		<div id="AppointTypeSpace"></div>
<form id="product_submit_form" style="display:block" action="__APP__/Order" method="get" onsubmit="return check_input();">
	<input id="id" type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
	<div class="p-dt">
		<div class="p-dt-box">
			<img class="pose" async-src="__PUBLIC__/img/andriod_tag_<?php echo ($info["typeid"]); ?>.png" height="50" src="__PUBLIC__/img/andriod_tag_<?php echo ($info["typeid"]); ?>.png">
			<img async-src="<?php echo (substr($info["img"],1)); ?>" width="100%" title="<?php echo ($vo["title"]); ?>" class="titleImage" src="<?php echo (substr($info["img"],1)); ?>">
			
		</div>
		<div class="p-dt-box-r">
				<div class="line1"><strong><?php echo ($info["title"]); ?></strong></div>
				<div class="line2">
					
					<span><?php echo ($info["timelong"]); ?>分钟</span>
				</div>
				<div class="clear"></div>
				<div class="line3">
					<span id="singlePrice">￥<?php echo (incprc($info["price"])); ?></span>
				</div>
				<div class="line4"><?php echo ($info["minpeople"]); ?>人起订
				</div>
			</div>
		<div class="p-dt-title">选择套餐内容</div>
		<div class="p-dt-ul-box">
			<div class="wrap">
			<?php if(empty($bid)): ?><div class="line_select">
					<span class="name">推拿师等级</span>
					<div class="select_input">
						<div class="left"></div>
						<input type="hidden" id="engineerLevel" name="e" value="1">
						<div id="levelSelect">
                            
							<ul>

							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
									<span data-value="<?php echo ($i); ?>" <?php if(($i) == "0"): ?>class="active"<?php endif; ?>><?php echo ($vo["title"]); ?></span>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>

							</ul>
						</div>
						<div class="right"></div>
					</div>
				</div>
			<?php else: ?>
				<div class="line_select">
					<span class="name">推拿师</span>
					<div class="select_input">
						<div class="left"></div>
						<input type="hidden" id="engineerLevel" name="e" value="1">
						<input type="hidden" id="" name="bid" value="<?php echo ($bid); ?>">
						<div class="right"><?php echo ($info["blindman"]); ?></div>
					</div>
				</div><?php endif; ?>
				<div class="line_number">
					<span class="name">购买数量</span>
					<div class="number_input right">
						<div class="left"></div>
						<input type="number" min="<?php echo ($info["minpeople"]); ?>" max="6" id="multiply" name="multiplier" value="<?php echo ($info["minpeople"]); ?>">
						<div class="right"></div>
					</div>
				</div>

				<div class="options hide">
                        <script id="ProductOptionsTemplate" type="text/html">
                                <div class="extra_line type{type}" data-value="{price}">
                                    <span>{name}</span>
                                    <div class="right">
                                        <div class="checker">
                                            <img src="__PUBLIC__/img/checked.png" class="checked" height="23" width="23"/>
                                            <img src="__PUBLIC__/img/uncheck.png" class="unckeck" height="23" width="23"/>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                        </script>
					<div class="list"></div>
				</div>
			</div>
		</div>

		<div class="p-dt-tab-btn">
			<div id="tab-btn1" class="p-dt-tab-li active" onclick="tab_change(this,'#tab-box1')">
				<span>服务内容</span>
			</div>
			<div class="spline"></div>
			<div id="tab-btn2" class="p-dt-tab-li" onclick="tab_change(this,'#tab-box2')">
				<span>禁忌症状</span>
			</div>
			<div class="spline"></div>
			<div id="tab-btn3" class="p-dt-tab-li" onclick="tab_change(this,'#tab-box3')">
				<span>下单须知</span>
			</div>
		</div>

		<div class="p-dt-tab-box">
			<div id="tab-box1" class="p-dt-tab-ct active"><?php echo ($info["content"]); ?></div>
			<div id="tab-box2" class="p-dt-tab-ct">推拿疗法的禁忌症，指不适宜推拿或在某种情况下，手法可能使病情加重恶化的情况。

1、诊断不明的急性脊髓损伤或伴有脊髓症状的患者，在未排除脊椎骨折时切忌推拿。出现脑脊髓症状时须排除蛛网膜下腔出血，这也是推拿禁忌症。
2、各种骨折、骨关节结核、骨髓炎、骨肿瘤、严重的老年性骨质疏松症患者，推拿可能引起病理性骨折，肿瘤扩散转移或炎症发展扩散。因此也属于推拿禁忌症。
3、严重的心、肺、肝、肾功能衰竭的病人或身体过于虚弱者，由于不承受强刺激，因此一般不宜接受推拿治疗。应该采取措施，及时抢救。
4、各种急性传染病、急性腹膜炎包括胃、十二指肠溃疡穿孔者，禁忌推拿治疗。应考虑手术剖腹探查。
5、有出血倾向或有血液病的患者，推拿可能引起局部皮下出血，故不宜推拿治疗。
6、避免在有皮肤损伤的部位施手法。但在有褥疮的周围施轻手法改善局部血液循环，可使缺血性坏死的创面逐渐愈合。这是70年代在治疗外伤性截瘫患者时的意外发现。
7、妊娠3个月以上的妇女的腹部、臀部、腰骶部，为了防止流产，不宜在这些部位施手法。
8、精神病患者或精神过度紧张时不宜推拿治疗。</div>
			<div id="tab-box3" class="p-dt-tab-ct">【订单修改】
1、订单修改需提前与推拿师或者客服联系，提前一小时以上修改订单不收取任何费用。
2、提前半小时以上修改订单日期和时间，收取订单费用的20%（现金）。

【订单取消】
1、提前一小时以上取消订单，不收取任何违约金。
2、提前半小时以上取消订单，收取订单金额的50%。
3、提前半小时内，或者推拿师到达后临时取消订单，收取订单金额的80%。

【订单等待】
推拿师按规定时间到达后，在推拿师有其他订单的情况下，等待时间不能超过30分钟，超过30分钟收取订单费用的80%，且订单无法完成。

【付款前须知】
1.请阅读项目的详细内容、适应人群、禁忌症，爱按摩推拿属于舒缓调理，并非医疗，如需治疗请到医院就诊。
2.爱按摩按摩师只提供专业正规服务，对于不正当的行为和要求我们有权拒绝服务，并保留诉诸法律的权利。</div>
		</div>

	</div>

	
	

	<div class="p-dt-submit">			
		<div class="submit-l">
			<div class="time_display">
				<div class="line_time">
					<span>时长:</span>
					<span class="right">
					<span class="time"><?php echo ($info["timelong"]); ?></span>
					分钟
					</span>
				</div>
			</div>
			<div class="price_display">
				<div class="line_total_price">
					<span class="right">合计:</span>
					<span class="right">
					<span class="price"><?php echo (incprc($info["price"])); ?></span>
					元
					</span>
				</div>
			</div>
		</div>
		<input class="medium_button primary" type="submit" value="下单" />
		<input type="hidden" name="uid" value="<?php echo ($uid); ?>">
	</div>
</form>

<script>
	function tab_change(self, value){
		var tab_box = $(".p-dt-tab-ct.active");
		var tab_li = $(".p-dt-tab-li.active");
		if(tab_li){
			tab_li.removeClass('active');
			tab_box.removeClass("active");
			// tab_box.classList.remove('active');
		}
		self.classList.add('active');
		document.querySelector(value).classList.add('active');

	}
</script>
<script type="text/javascript">

	window.productData = {
        displayConfig_price  : <?php echo ($pricearr); ?>,
		period       : <?php echo ($info["timelong"]); ?>,
		minMultiplier: <?php echo ($info["minpeople"]); ?>,
		maxMultiplier: 6,
		productId    : "<?php echo ($info["id"]); ?>",
		options      : {}
	};
</script>
<div id="DebugLog" style="display:none;">
	<div>
		<a onclick="document.querySelector('#DebugLog').style.display = 'none';return false;">关闭</a>
	</div>
</div>

	<script type="text/javascript" src="__PUBLIC__/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		var wx_success = true;
		
		jWeixin.ready(function (){
			console.log('init weixin object callback');
			if(!wx_success){
				alert('微信分享接口初始化失败，请您升级微信版本再试。');
				return;
			}
			console.log('init weixin success');
			if(window.$){
				$(document).trigger('wxready');
			}
						jWeixin.onMenuShareTimeline({
				title  : "<?php echo ($info["title"]); ?>", // 分享标题
				link   : "http://www.baidu.com", // 分享链接
				imgUrl : "http://static.gfxiong.com/img/logo-round.png", // 分享图标
				success: function (){
					share_success('timeline');
				},
				cancel : function (){
					share_cancel('timeline');
				}
			});
			console.log('onMenuShareTimeline');
						
						jWeixin.onMenuShareAppMessage({
				title  : "<?php echo ($info["title"]); ?>", // 分享标题
				desc   : "<?php echo ($info["title"]); ?>", // 分享描述
				link   : "http://www.baidu.com", // 分享链接
				imgUrl : "http://static.gfxiong.com/img/logo-round.png", // 分享图标
				type   : 'link', // 分享类型,music、video或link，不填默认为link
				dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
				success: function (){
					share_success('appmessage');
				},
				cancel : function (){
					share_cancel('appmessage');
				}
			});
			console.log('onMenuShareAppMessage');
					});
		jWeixin.error(function (res){
			if(window.$){
				$(document).trigger('wxerror', res);
			}
			wx_success = false;
		});
		jWeixin.config({
				debug    : CONSTANT.isDebugEnv, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
				appId    : '<?php echo ($signPackage["appId"]); ?>', // 必填，公众号的唯一标识
				timestamp: <?php echo ($signPackage["timestamp"]); ?>, // 必填，生成签名的时间戳
				nonceStr : '<?php echo ($signPackage["nonceStr"]); ?>', // 必填，生成签名的随机串
				signature: '<?php echo ($signPackage["signature"]); ?>',// 必填，签名，见附录1
				jsApiList: [
					'onMenuShareTimeline',
					'onMenuShareAppMessage',
					'previewImage',
					'getNetworkType',
					'getLocation',
					'openLocation',
					'hideOptionMenu',
					'scanQRCode',
					'chooseWXPay'
				] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
			});
		
		function share_success(type){
			if(window.$){
				$(document).trigger('sharesuccess', {type: type});
			}
			window.dispatchEvent(new CustomEvent('sharesuccess', {type: type}));
		}
		function share_cancel(type){
			if(window.$){
				$(document).trigger('sharecancel', {type: type});
			}
			window.dispatchEvent(new CustomEvent('sharecancel', {type: type}));
		}
	</script>


</body></html>