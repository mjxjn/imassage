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

	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/p_user.css">
	
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
<form action="" method="" onsubmit="return check_input();">
	<div id="Main" class="container">
		
		<img src="__PUBLIC__/img/andriod_me_bg.png" class="user_bg" width="100%" />
		<img src="__PUBLIC__/img/andriod_dark_back_normal.png" class="back" height="20" onclick="javascript:window.history.go(-1);" />
		<div style="width:100%;position: absolute;top: 40px;left: -40px;"><img src="__PUBLIC__/img/andriod_user_login.png" class="userface" width="80" /></div>
		<div class="tel"><?php echo ($info["phone"]); ?>18053722630</div>
		
		<ul>
			<li onclick="location.href='__APP__/Order/orderlist'"><img src="__PUBLIC__/img/andriod_icon_my_order.png" height="20" /> <span>我的订单</span> <img src="__PUBLIC__/img/andriod_dark_arrow.png" height="16" class="arrow" /></li>
			<li onclick="location.href='__APP__/Coupons/index'"><img src="__PUBLIC__/img/andriod_icon_coupon.png" height="20" /> <span>优惠券</span> <img src="__PUBLIC__/img/andriod_dark_arrow.png" height="16" class="arrow" /></li>
			<li onclick="location.href='###'"><img src="__PUBLIC__/img/andriod_icon_member_card.png" height="20" /> <span>会员卡</span> <img src="__PUBLIC__/img/andriod_dark_arrow.png" height="16" class="arrow" /></li>
			<li onclick="location.href='###'"><img src="__PUBLIC__/img/andriod_icon_adress.png" height="20" /> <span>地址管理</span> <img src="__PUBLIC__/img/andriod_dark_arrow.png" height="16" class="arrow" /></li>
			<li onclick="location.href='###'"><img src="__PUBLIC__/img/andriod_icon_about_us.png" height="20" /> <span>关于我们</span> <img src="__PUBLIC__/img/andriod_dark_arrow.png" height="16" class="arrow" /></li>
		</ul>

	</div>
	<div id="BottomMenuSpace"></div>
		<table id="BottomMenu">
		<tbody>
		<tr>
			<td id="home" class="">
				<a href="__APP__/index">
				<span class="icon">
				<img async-src="__PUBLIC__/img/andriod_icon_subject_normal.png" width="20" height="20" src="__PUBLIC__/img/andriod_icon_subject_normal.png">
				</span>
				<span class="title">推拿项目</span>
				</a>
			</td>
			<td id="myorder" class="">
				<a href="/index.php/blindman/index">
				<span class="icon">
				<img async-src="__PUBLIC__/img/andriod_icon_doctor_normal.png" width="20" height="20" src="__PUBLIC__/img/andriod_icon_doctor_normal.png">
				</span>
				<span class="title">按摩师</span>
				</a>
			</td>
			<td id="people" class="active">
				<a href="###">
				<span class="icon">
				<img async-src="__PUBLIC__/img/andriod_icon_me_click.png" width="20" height="20" src="__PUBLIC__/img/andriod_icon_me_click.png">
				</span>
				<span class="title">个人中心</span>
				</a>
			</td>
		</tr>
		</tbody>
		</table>
</form>
<script type="text/javascript" crossorigin="anonymous">
	function tab_change(self, value){
		var tab_box = $(".timeul.active");
		var tab_li = $(".time-tab-li.active");
		if(tab_li){
			tab_li.removeClass('active');
			tab_box.removeClass("active");
			// tab_box.classList.remove('active');
		}
		self.classList.add('active');
		document.querySelector(value).classList.add('active');
	}
</script>
</body></html>