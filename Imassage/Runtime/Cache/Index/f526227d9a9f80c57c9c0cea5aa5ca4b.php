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
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/p_list.css">
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/order.css">
	
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

<script type="text/javascript" crossorigin="anonymous">
	$(document).ready(function(){
		var u = navigator.userAgent
		if(u.indexOf('iPhone') > -1){
			$("body").addClass("iOs iphone");
		}
	})
	</script>
	<style type="text/css">
	#Main .title{font-size: 12px;}
	</style>
</head>
<body class="">
<form action="__URL__/submitorder" method="post" onsubmit="return check_input();">
	<div id="Main" class="container">
		<div class="step_one" id="order_step">
			<img src="__PUBLIC__/img/order3.png" width="100%" />
		</div>
		<div class="coupons">
			<div class="couponstitle">优惠券:</div> 
			<?php if(is_array($coulist)): $i = 0; $__LIST__ = $coulist;if( count($__LIST__)==0 ) : echo "暂无优惠券可用" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="pay" onclick="selectcoupons(this,<?php echo ($vo["id"]); ?>,<?php echo (incprc($vo["price"])); ?>)" style="overflow: hidden;">
				<div style="float:left;padding-left:10px;line-height:44px;"><?php echo ($vo["title"]); ?> (金额：￥<?php echo (incprc($vo["price"])); ?>)</div>
				<div class="coupons_list" style="float:right;line-height:44px; padding:5px 10px 0 0;">
						<?php if(($key) == "0"): ?><img src="__PUBLIC__/img/checked.png" height="23" width="23">
						<?php else: ?>
						<img src="__PUBLIC__/img/uncheck.png" height="23" width="23"><?php endif; ?>
				</div>
			</div><?php endforeach; endif; else: echo "暂无优惠券可用" ;endif; ?>
		</div>
		<div class="clear"></div>
		<div class="money">
			<span>会员卡余额: <?php echo (incprc($money)); ?>元</span>
		</div>
		<div class="payway">
			<div class="paytitle">支付方式</div>
			<div class="pay"><input type="radio" name="payway" value="1" checked="checked" /> 微信支付</div>
		</div>
		<div class="address">
			<p>地址: <?php echo ($address); ?>-<?php echo ($lou); ?></p> 
			<p>联系人: <?php echo ($name); ?></p> 
			<p>电话: <?php echo ($phone); ?></p>
		</div>
		<div class="blindmanlist container">
			<div class="orderinfo">订单详情</div>
			<li>
			<img async-src="<?php echo ($prinfo["img"]); ?>" height="75" width="75" title="<?php echo ($prinfo["title"]); ?>" class="titleImage" src="<?php echo ($prinfo["img"]); ?>">
            <div class="title">
            服务：<?php echo ($prinfo["title"]); ?>
            </div>
            <div class="title">
            按摩师：<?php echo ($blindman); ?>
            </div>
            <div class="title">
            项目数量：<?php echo ($num); ?>
            </div>
          	<div class="title">
          	项目时间：<?php echo ($starttime); ?>
            </div>
            </li>
            <div class="total">
            	<p>总计：￥<?php echo (incprc($total)); ?></p>
            	<p>折扣: -￥<span class="cou"><?php echo (incprc($coulist["0"]["price"])); ?></span></p>
            </div>
		</div>
	</div>
	<div id="BottomMenuSpace"></div>
	<div class="p-dt-submit3">			
		<div class="submit-l">
			<div class="price_display">
				<div class="line_total_price">
					<span class="right">合计:</span>
					<span class="right">
					<span class="price"><?php echo (incprc($paymoney)); ?></span>
					元
					</span>
				</div>
			</div>
		</div>
		<input class="medium_button primary" type="submit" value="提交订单" >
		<input type="hidden" name="bid" value="<?php echo ($bid); ?>" />

		<input type="hidden" name="uid" value="<?php echo ($uid); ?>">
		<input type="hidden" name="pid" value="<?php echo ($pid); ?>">
		<input type="hidden" name="num" value="<?php echo ($num); ?>">
		<input type="hidden" name="level" value="<?php echo ($level); ?>">

		<input type="hidden" name="phone" value="<?php echo ($phone); ?>">
		<input type="hidden" name="name" value="<?php echo ($name); ?>">
		<input type="hidden" name="address" value="<?php echo ($address); ?>">
		<input type="hidden" name="lou" value="<?php echo ($lou); ?>">
		<input type="hidden" name="beizhu" value="<?php echo ($beizhu); ?>">

		<input type="hidden" name="sdate" value="<?php echo ($sdate); ?>">
		<input type="hidden" name="stime" value="<?php echo ($stime); ?>">
		<input type="hidden" name="timestep" value="<?php echo ($timestep); ?>">

		<input type="hidden" name="cid" value="<?php echo ($coulist["0"]["id"]); ?>">
	</div>
</form>
<div id="DebugLog" style="display:none;">
			<div>
				<a onclick="document.querySelector('#DebugLog').style.display ='none';return false;">关闭</a>
			</div>
		</div>
	<script type="text/javascript" crossorigin="anonymous">

function selectcoupons(self,id,price){
	$('.coupons_list').empty().html('<img src="__PUBLIC__/img/uncheck.png" height="23" width="23">');
	$(self).find('.coupons_list').empty().html('<img src="__PUBLIC__/img/checked.png" height="23" width="23">');
	$('input[name=cid]').val(id);
	$('.cou').empty().html(price);
	var total = <?php echo (incprc($total)); ?> - price;
	$('.price').empty().html(total);
}
</script>
</body></html>