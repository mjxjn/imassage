<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>优惠券</title>
	<meta name="viewport" content="width=320,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	
	<link rel="icon" href="__PUBLIC__/img/favicon.png" type="image/png">
	<link rel="shortcut icon" href="__PUBLIC__/img/favicon.png" type="image/png">
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/global.css">
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/global.wx.css">
	
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/p_coupons.css">
	<script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/jquery.js"></script>
	<script type="text/javascript" crossorigin="anonymous">
	$(document).ready(function(){
		var u = navigator.userAgent
		if(u.indexOf('iPhone') > -1){
			$("body").addClass("iOs iphone");
		}
	})
	function check_form(){
		var code = $('input[name=code]').val();
		if (code.length <= 0) {
			alert("优惠券编号不能为空!");
			return false;
		};
	}
	</script>
	</head>
	<body class="no-location">
		<div class="addcoupon">
			<div class="addcoupontitle">添加优惠券</div>
			<form method="get" action="__URL__/addcoupon" onsubmit="return check_form()">
				<input type="text" class="input" name="code" placeholder="优惠券编号" /><input type="submit" value="添加" class="btn" />
				<input type="hidden" name="uid" value="1" />
			</form>
		</div>
		<div class="couponslist">
			<div class="conpostitle">已有优惠券</div>
			<ul id="Main" class="container">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="p<?php echo ($vo["id"]); ?>">
	            		<div class="title"><?php echo ($vo["title"]); ?>
	            			<span class="price">优惠金额：￥<?php echo (incprc($vo["price"])); ?>
	            			</span>
	            			<span class="font-smaller">截止：<?php echo (date('y-m-d',$vo["endtime"])); ?></span>
	            		</div>
	            		<div class="desc">使用条件：
	            			<span>
	                            订单金额 >￥<?php echo (incprc($vo["minprice"])); ?>元   
	            				订单人数 ><?php echo ($vo["minnum"]); ?>人
	            			</span>
	            		</div>
	            		<div class="clear"></div>
	        	</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</body>
</html>