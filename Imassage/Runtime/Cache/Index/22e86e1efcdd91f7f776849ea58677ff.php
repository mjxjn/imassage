<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0035)http://w.gfxiong.com/wx/lst/product -->
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
	<script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/jquery.js"></script><script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/jquery.cookie.js"></script><script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/geolib.min.js"></script><script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/geo_distance.js"></script>
	<script type="text/javascript" crossorigin="anonymous">
	$(document).ready(function(){
		var u = navigator.userAgent
		if(u.indexOf('iPhone') > -1){
			$("body").addClass("iOs iphone");
		}
	})
	</script>
	</head>
	<body class="no-location">
		<div id="AppointType">
		<div class="wrap">
			<div style="line-height:45px; color:#fff;">按摩师</div>
			<div id="citySelect" class="city-select">
				<i class="city-loc"></i>
				<div id="currentChoice" class="current-choice">上海</div>
			</div>
		</div>
		</div>
		<div id="AppointTypeSpace"></div>
		<ul id="Main" class="container">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="p<?php echo ($vo["id"]); ?>" onclick="location.href='__URL__/info/id/<?php echo ($vo["id"]); ?>'">
            		<img async-src="<?php echo (substr($vo["img"],1)); ?>" height="75" width="75" title="<?php echo ($vo["name"]); ?>" class="blindImage" src="<?php echo (substr($vo["img"],1)); ?>">

            		<div class="title"><?php echo ($vo["name"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
            		<?php if(($vo["level"]) == "高级"): ?><font style="color:#ff9538">[高级按摩师]</font><?php endif; ?>
            		<?php if(($vo["level"]) == "特级"): ?><font style="color:#f45a55">[高级按摩师]</font><?php endif; ?>
            		<?php if(($vo["level"]) == "专家"): ?><font style="color:#2074c2">[专家级按摩师]</font><?php endif; ?>
            		</span>
            		</div>
            		<br />
            		<div class="desc">
            			<!-- <img async-src="__PUBLIC__/img/clock.png" height="13" src="__PUBLIC__/img/clock.png"> -->
            			<div class="icon_dingdan">
                            <img src="__PUBLIC__/img/andriod_icon_dingdan.png" width="11" style="padding-right:5px;"><?php echo ($vo["ordernum"]); ?>单
            			</div>
            			<div style="text-align:left;line-height: 20px;">
            			<?php echo (msubstr($vo["content"],0,35,'utf-8',true)); ?>
            			</div>
            		</div>

            		
            		<div class="clear"></div>
        	</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<div id="BottomMenuSpace"></div>
		<table id="BottomMenu">
		<tbody>
		<tr>
			<td id="home" class="">
				<a href="__APP__/index">
				<span class="icon">
				<img async-src="__PUBLIC__/img/andriod_icon_subject_normal.png" width="20" height="25" src="__PUBLIC__/img/andriod_icon_subject_normal.png">
				</span>
				<span class="title">推拿项目</span>
				</a>
			</td>
			<td id="myorder" class="active">
				<a href="###">
				<span class="icon">
				<img async-src="__PUBLIC__/img/andriod_icon_doctor_click.png" width="20" height="25" src="__PUBLIC__/img/andriod_icon_doctor_click.png">
				</span>
				<span class="title">按摩师</span>
				</a>
			</td>
			<td id="people" class="">
				<a href="__APP__/Check/index?state=/user/index">
				<span class="icon">
				<img async-src="__PUBLIC__/img/andriod_icon_me_normal.png" width="20" height="25" src="__PUBLIC__/img/andriod_icon_me_normal.png">
				</span>
				<span class="title">个人中心</span>
				</a>
			</td>
		</tr>
		</tbody>
		</table>
		<div id="DebugLog" style="display:none;">
			<div>
				<a onclick="document.querySelector('#DebugLog').style.display ='none';return false;">关闭</a>
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
					title  : "Imassage盲人按摩服务", // 分享标题
					link   : "http://baidu.com", // 分享链接
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
					title  : "", // 分享标题
					desc   : "", // 分享描述
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
	</body>
</html>