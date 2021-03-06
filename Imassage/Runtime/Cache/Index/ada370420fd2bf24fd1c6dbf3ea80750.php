<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0063)http://w.gfxiong.com/wx/detail/product/5491b86be4b0c4895219f2c1 -->
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
var consoleObject = ['log', 'debug', 'warn', 'error'];
function array_shift(a){
	return Array.prototype.shift.call(a);
}

window.addEventListener('error', function (e){
	if(!e.error){
		console.log('发生ScriptError');
		return;
	}
	var etext = '发生错误: ' + e.error.toString() + '\n\tFile: ' + e.filename + '\n\tLine: ' + e.lineno;
	
	global_handle_error(e);
	
	console.error(etext);
});

function global_handle_error_object(obj){
	var c = currentFile(1, obj.stack).split(':');
	var e = {error: obj, message: obj.message, filename: c[0], lineno: c[1], colno: c[2]};
	var etext = '(手动)发生错误: ' + e.error.toString() + '\n\tFile: ' + e.filename + '\n\tLine: ' + e.lineno;
	console.error(etext);
	global_handle_error(e);
}
function global_handle_error(e){
	var errorObj = {
		message     : e.message,
		location    : location.href,
		name        : e.error.name,
		errorMessage: e.error.toString(),
		file        : e.filename,
		line        : e.lineno,
		column      : e.colno,
		stack       : e.error.stack
	};
	var i = 0;
	while(++i){
		if(!localStorage.getItem('errorupload' + i)){
			break;
		}
	}
	localStorage.setItem('errorupload' + i, JSON.stringify(errorObj));
	setTimeout(global_submit_error, 100);
}
function global_submit_error(){
	var i = 0;
	var elist = [];
	while(++i){
		var e = localStorage.getItem('errorupload' + i);
		if(!e){
			break;
		}
		elist.push(JSON.parse(e));
		localStorage.removeItem('errorupload' + i);
	}
	if(elist.length > 0){
		console.log('will submit error data...');
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.addEventListener("load", function (){
			console.log('js error upload complete!');
		}, false);
		xmlhttp.open("PUT", "", true);
		xmlhttp.send(JSON.stringify(elist));
	}
}
window.addEventListener('load', global_submit_error, false);

function start_remote_debug(sesskey){
	var timeout = 0, data = [];

	function wrap(type){
		return function (text){
			data.push([type, text, stackTrace()]);
			if(timeout){
				return;
			}
			timeout = setTimeout(function (){
				timeout = 0;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("PUT", "", true);
				xmlhttp.onerror=function(){
					alert('remote debug send failed');
				};
				xmlhttp.send(JSON.stringify(data));
				data = [];
			}, 0);
		};
	}

	consoleObject.forEach(function (name){
		wrap_console_function(name, wrap(name));
	});
	console.log('remote debugging started on page %s', location.href);
}
function wrap_console_function(type, fn){
	var lastFn = (console[type] || console.log);
	console[type] = function (){
		var format = arguments[0];
		var index = 1, text = '';
		var args = arguments;
		if(format && format.replace){
			text = format.replace(/%[a-zA-Z]/g, function (){
				return getText(args[index++]);
			});
		} else{
			index = 0;
		}
		for(; index < arguments.length; index++){
			text += ' ' + getText(arguments[index]);
		}
		fn(text);
		try{
			lastFn.apply(console, arguments);
		} catch(e){
			lastFn.apply(console, arguments);
		}
	};
}

function getText(v){
	switch(typeof v){
	case 'object':
		v = JSON.stringify(v);
		break;
	case 'boolean':
		v = v? 'true' : 'false';
		break;
	default :
		v = '' + v;
	}
	return v;
}

function attach_debug(cb){
	function real_attach(){
		var o = document.body;
		var waitArr = [1, 2, 3, 2, 1, 2], itr = 0;
		o.addEventListener('touchstart', touch_change);
		o.addEventListener('touchend', touch_change);
		function touch_change(e){
			if(waitArr[itr] == e.touches.length){
				itr++;
			} else{
				itr = 0;
				return;
			}
			if(itr == waitArr.length){
				cb();
				itr = 0;
			}
		}
	}

	if(document.body){
		real_attach();
	} else{
		document.addEventListener('DOMContentLoaded', real_attach);
	}
}

function start_local_debug(){
	function whitespace(text){
		return text.replace(/ /g, '&nbsp').replace(/\n/g, '<br/>');
	}

	function wrap(type){
		return function (text){
			text = whitespace(text);
			document.getElementById('DebugLog').innerHTML += '<div class="' + type + '">' + text + '</div>'
		};
	}

	if(/micromessenger/.test(navigator.userAgent.toLowerCase())){
		if(document.body){
			consoleObject.forEach(function (name){
				wrap_console_function(name, wrap(name));
			});
		} else{
			consoleObject.forEach(function (name){
				var cached = [];
				var oFn = console[name];
				console[name] = function (){
					cached.push(arguments);
				};
				document.addEventListener('DOMContentLoaded', function (){
					console[name] = oFn;
					wrap_console_function(name, wrap(name));
					setTimeout(function (){
						cached.forEach(function (arg){
							console[name].apply(console, arg);
						});
						cached = null;
					}, 0)
				});
			});
		}

		// debug mask
		attach_debug(function (){
			document.querySelector('#DebugLog').style.display = 'block';
		});
	} else{
		consoleObject.forEach(function (name){
			if(!console[name]){
				console[name] = console.log;
			}
		});
	}
}

start_local_debug();


function stackTrace(){
	var e = new Error();
	var lines = e.stack;
	var data = lines.split(/\n/g);
	data.shift(); // Error: ;
	data.shift(); //    at currentFile();
	data.shift(); //    at wrapped console.xxx
	data.shift(); //    at console.xxx()

	return data.map(function (l){
		return l.trim().replace(/http:\/\/.*?\//g, '/').replace(/v=[0-9]+/g, '').replace(/\?(:|$)/, ':');
	}).join("\n").replace('at ', '');
}
function currentFile(skip, stack){
	if(!stack){
		var e = new Error();
		var lines = e.stack;
		var data = lines.split(/\n/g);
		data.shift(); // Error: ;
		data.shift(); //    at currentFile();

		if(skip && skip > 0){
			while(--skip >= 0){
				data.shift();
			}
		}
	} else{
		data = stack.split(/\n/g);
		data.shift(); // Error: ;
	}
	return data.shift().trim().replace(/^at .*\(http:\/\/.*?\/(.*?)\)/, '$1').replace(/v=[0-9]+/g, '').replace(/\?(:|$)/, ':');
}
</script>

		<script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/debug.js"></script>
	
	<script type="text/javascript" crossorigin="anonymous">
		window.CONSTANT = {
			CACHE_VERSION: "100",
			isDebugEnv: true,
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

<form id="product_submit_form" style="display:block" action="###" method="get" onsubmit="return check_input();">
	<input id="id" type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
	<div class="p-dt">
		<div class="p-dt-box">
			<div class="p-dt-box-l">
				<img src="<?php echo ($info["img"]); ?>" height="75" width="75" alt="">
			</div>
			<div class="p-dt-box-r">
				<div class="line1"><strong><?php echo ($info["name"]); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:12px; color:#aaa;"><?php echo (getsex($vo["sex"])); ?></span></div>
				<div class="line2">
					<i></i>
					<span><?php echo ($info["level"]); ?>按摩师</span>
				</div>
				<div class="line3">
					<span id="singlePrice">订单数：<?php echo ($info["ordernum"]); ?>单</span>
				</div>
			</div>
			<div class="clear">
				工作经验：<?php echo ($info["content"]); ?>
			</div>
		</div>
		<div class="p-dt-box">
			<div class="" style="width:50%;float:left;">全部评价（185条）</div>
			<div class="right" style="color:#249caa">好评率（98%）</div>
		</div>

		<ul id="Main" class="container">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="p<?php echo ($vo["id"]); ?>" onclick="location.href='__APP__/Product/index/id/<?php echo ($vo["id"]); ?>/bid/<?php echo ($info["id"]); ?>'">
                    <img class="pose" async-src="__PUBLIC__/img/product_pose<?php echo ($vo["typeid"]); ?>.png" height="30" src="__PUBLIC__/img/product_pose<?php echo ($vo["typeid"]); ?>.png">
            		<img async-src="<?php echo ($vo["img"]); ?>" height="75" width="75" title="<?php echo ($vo["title"]); ?>" class="titleImage" src="<?php echo ($vo["img"]); ?>">
            		<div class="title"><?php echo ($vo["title"]); ?>
            			<span class="price">￥<?php echo (incprc($vo["price"])); ?>
            			<span class="font-smaller">起</span>
            			</span>
            		</div>
            		<div class="desc">
            			<img async-src="__PUBLIC__/img/clock.png" height="13" src="__PUBLIC__/img/clock.png">
            			<span>
                            <?php echo ($vo["timelong"]); ?>分钟
            			(<?php echo ($vo["minpeople"]); ?>人起订)
            			</span>
            		</div>
            		<div class="btn">
            			<a>立即预约</a>
            		</div>
            		<div class="clear"></div>
        	</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>

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