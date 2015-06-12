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
	
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/p_list.css">
	<script type="text/javascript" crossorigin="anonymous" src="__PUBLIC__/js/jquery.js"></script>
	<script type="text/javascript" crossorigin="anonymous">
	$(document).ready(function(){
		var u = navigator.userAgent
		if(u.indexOf('iPhone') > -1){
			$("body").addClass("iOs iphone");
		}
	})
	</script>
	<style type="text/css">
		.send{
			    height: 20px;
  				line-height: 20px;
  				font-size: 14px;
		}
	</style>
	</head>
	<body class="no-location">
		
		<div id="AppointTypeSpace"></div>
		<div style="margin-top:50px;" id="Main">
		<form action="__APP__/index.php/login/saveuser" method="post" onsubmit="return check_input();">
			<div style="font-size:14px; text-align:left; float:left; padding-left:20px;line-height:30px;">手机号：</div>
			<input type="text" name="phone" class="input phone" style="width: 68%; float:left; line-height:30px;" />
			<div class="clear"></div>
			<div style="margin-top:10px; display:none;" class="verfiy">
			<div style="font-size:14px; text-align:left; float:left; padding-left:20px;">验证码：</div>
			<input type="text" name="verfiy" class="input" style="width: 20%;float:left;" />
			</div>
			<div class="clear"></div>
			<div style="margin-top:10px;">
			<a class="medium_button primary send" href="javascript:sendPhone();">发送手机验证码</a>
			<input type="submit" class="medium_button danger submit" style="display:none;" value="提交验证" />
			<input type="hidden" name="openid" value="<?php echo ($openid); ?>" />
			</div>
		</form>
		</div>
	</body>
	<script type="text/javascript" crossorigin="anonymous">
		function check_input(){
			var phone = $('input[name=phone]').val();
			var verfiy = $('input[name=verfiy]').val();
			var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
			 if (!reg.test(phone)) {
			      alert("手机号号码有误~");
			      return false;
			 };
			if (verfiy.length != 5) {
				alert("验证码格式不正确或验证码为空");
				return false;
			};
			return true;
		}
		function sendPhone(){
			var phone = $('input[name=phone]').val();
			var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
			if (!reg.test(phone)) {
				alert("手机号号码有误~");
			}else{
				$('.phone').attr('disabled',true);
				$('.send').hide();
				$('.verfiy').show();
				$('.submit').show();
				$.ajax({
		             type: "post",
		             url: "__URL__/sendPhone",
		             data: "phone="+phone,
		             dataType: "json",
		             success: function(data){
		             	if(data.status == 1){
		             		$.each(data, function(commentIndex, comment){
		             			alert(comment.phone);
		             		});
		             	}else{
		             		alert(data.info);
		             	}
		             }
		         });
			}
			
		}
	</script>
</html>