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
	
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/p_blindmanlist.css">

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
	})
	</script>
</head>
<body class="">

<form id="product_submit_form" style="display:block" action="__APP__/order/index" method="get" onsubmit="return check_input();">
	<input id="id" type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
	<div class="p-dt">
		<div class="p-dt-box">
			<img src="__PUBLIC__/img/andriod_dark_back_normal.png" height="20" style="position: absolute;top: 10px;left: 10px;z-index: 10;" onclick="javascript:window.history.go(-1);" />
			<img src="__PUBLIC__/img/andriod_doctor_detail_bg.png" width="100%" class="doctor_bg">
			<div class="p-dt-box-l">
				<img src="<?php echo (substr($info["img"],1)); ?>" height="75" width="75" alt="">
			</div>
			<div class="p-dt-box-r">
				<div class="line1"><?php echo ($info["name"]); ?></div>
				<div class="line2">
					<span><?php echo ($info["level"]); ?>按摩师</span>
				</div>
				<div class="line3">
					<div class="order_icon">
						<img src="__PUBLIC__/img/andriod_icon_order_number.png" width="25" />
					</div>
					<span id="singlePrice"><?php echo ($info["ordernum"]); ?>单</span>
				</div>
				<div class="line4">
					<div class="comment_icon">
						<img src="__PUBLIC__/img/andriod_icon_comment_number.png" width="25" />
					</div>
					<span id="singlePrice">122条评论</span>
				</div>
			</div>
			<div class="clear"></div>
			<div class="gzjy"><strong>[工作经验]</strong>：<?php echo ($info["content"]); ?></div>
		</div>
		<div class="fwxm">服务项目</div>
		<ul id="Main" class="container">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="p<?php echo ($vo["id"]); ?>" >
                    <img class="pose" async-src="__PUBLIC__/img/andriod_tag_<?php echo ($vo["typeid"]); ?>.png" height="30" src="__PUBLIC__/img/andriod_tag_<?php echo ($vo["typeid"]); ?>.png">
            		<img async-src="<?php echo (substr($vo["img"],1)); ?>" height="75" width="75" title="<?php echo ($vo["title"]); ?>" class="titleImage" src="<?php echo (substr($vo["img"],1)); ?>">
            		<div class="title"><?php echo ($vo["title"]); ?>
            			<span class="price">￥<?php echo (incprc($vo["price"])); ?>
            			<span class="font-smaller">起</span>
            			</span>
            		</div>
            		<div class="fwdesc">
            			<span>
                            <?php echo ($vo["timelong"]); ?>分钟
            			(<?php echo ($vo["minpeople"]); ?>人起订)
            			</span>
            		</div>
            		<div class="btn" onclick="selectcoupons(this,<?php echo ($vo["id"]); ?>,<?php echo (incprc($vo["price"])); ?>)">
            			<?php if(($key) == "0"): ?><img src="__PUBLIC__/img/checked.png" height="23" width="23">
						<?php else: ?>
						<img src="__PUBLIC__/img/uncheck.png" height="23" width="23"><?php endif; ?>
            		</div>
            		<div class="clear"></div>
        	</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>

	</div>
	<input type="hidden" name="bid" value="<?php echo ($list["0"]["id"]); ?>">
	
	<div id="BottomMenuSpace"></div>
	<div class="p-dt-submit">
		<input class="medium_button primary" type="submit" value="下单">
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
	function selectcoupons(self,id,price){
	$('.btn').empty().html('<img src="__PUBLIC__/img/uncheck.png" height="23" width="23">');
	$(self).empty().html('<img src="__PUBLIC__/img/checked.png" height="23" width="23">');
	$('input[name=bid]').val(id);
	
}
</script>


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