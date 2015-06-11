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
</head>
<body class="">
<form action="__URL__/step2" method="post" onsubmit="return check_input();">
	<div id="Main" class="container">
		<div class="step_one" id="order_step">
			<img src="__PUBLIC__/img/order1.png" width="100%" />
		</div>
		<div class="p-dt-tab-btn">
			<div id="tab-btn1" class="p-dt-tab-li active" onclick="tab_change(this,'tab-box1')">
				<span>给自己预约</span>
			</div>
			<div class="spline"></div>
			<div id="tab-btn2" class="p-dt-tab-li" onclick="tab_change(this,'tab-box2')">
				<span>给他人预约</span>
			</div>
		</div>
		<div class="p-dt-tab-box">
			<div class="p-dt-tab-ct">
				
					<div class="line_input">
						<span class="name">手机号:</span>
						<div class="input" id="tab-box">
							<input type="text" id="tab-box1" class="tab_box active" name="phone" disabled="disabled" value="<?php echo ($phone); ?>">
						</div>
					</div>
					<div class="line_input">
						<span class="name">街道名:</span>
						<div class="input">
							<input type="text" name="address" placeholder="街道或小区名" value="">
						</div>
					</div>
					<div class="line_input">
						<span class="name">门牌号:</span>
						<div class="input">
							<input type="text" name="lou" placeholder="楼号、单元号、门牌号" value="">
						</div>
					</div>
					<div class="line_input">
						<span class="name">联系人:</span>
						<div class="input">
							<input type="text" name="name" placeholder="联系人称呼" value="">
						</div>
					</div>
					<div class="line_input">
						<span class="name" style="width:40%">备注（选填）:</span><br />
						<div class="input">
							<input type="text" name="beizhu" placeholder="如给他人预约，请留下相应联系方式。" value="" style="width:90%">
						</div>
					</div>
				
			</div>
		</div>
	</div>
	
	<div class="p-dt-submit">
		<input class="medium_button primary" type="submit" value="下一步">
		<input type="hidden" name="uid" value="<?php echo ($uid); ?>">
		<input type="hidden" name="pid" value="<?php echo ($pid); ?>">
		<input type="hidden" name="num" value="<?php echo ($num); ?>">
		<input type="hidden" name="level" value="<?php echo ($level); ?>">
		<input type="hidden" name="bid" value="<?php echo ($bid); ?>">
	</div>
</form>
<script>
	function tab_change(self, value){
		//var tab_box = $(".tab_box.active");
		var tab_li = $(".p-dt-tab-li.active");
		if(tab_li){
			tab_li.removeClass('active');
			//tab_box.removeClass("active");
			// tab_box.classList.remove('active');
		}
		self.classList.add('active');
		$("#tab-box").empty();
		if (value == 'tab-box1') {
			$("#tab-box").append('<input type="text" name="phone" disabled="disabled" value="<?php echo ($phone); ?>">');
		};
		if (value == 'tab-box2') {
			$("#tab-box").append('<input type="text" name="phone" placeholder="请输入手机号" value="">');
		};
		//document.querySelector(value).classList.add('active');

	}
	function check_input(){
		var phone = $('input[name=phone]').val();
		var address = $('input[name=address]').val();
		var lou = $('input[name=lou]').val();
		var name = $('input[name=name]').val();
		if (phone.length <= 0) {
			alert("手机号不能为空");
			return false;
		};
		if (address.length <= 0) {
			alert("街道名不能为空");
			return false;
		};
		if (lou.length <= 0) {
			alert("门牌号不能为空");
			return false;
		};
		if (name.length <= 0) {
			alert("联系人不能为空");
			return false;
		};
		return true;
	}
</script>
</body></html>