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
		$(".send").click(function(){
    		sendPhone();
    	});
	})
	</script>
	<style type="text/css">
		.send{
			    height: 20px;
  				line-height: 20px;
  				font-size: 14px;
		}
		body{
			background: #e4e4e4;
		}
	</style>
	</head>
	<body class="no-location">
		
		<div id="AppointTypeSpace"></div>
		<div style="margin-top:50px;" id="Main">
		<form action="__APP__/login/saveuser" method="post" onsubmit="return check_input();">
			<div style="font-size:14px; text-align:left; float:left; padding-left:20px;line-height:30px;">手机号：</div>
			<input type="text" name="iphone" class="input phone" style="width: 68%; float:left; line-height:30px;" />
			<div class="clear"></div>
			<div style="margin-top:10px; " class="verfiy">
			<div style="font-size:14px; text-align:left; float:left; padding-left:20px; line-height:30px;">验证码：</div>
			<input type="text" name="verfiy" class="input" style="width: 20%;float:left; line-height:30px;" />
			<input class="medium_button primary send" type="button" style="width: 40%;float:left; line-height:23px; margin-left:20px; height:37px;" value="发送手机验证码" />
			</div>
			<div class="clear"></div>
			<div style="margin-top:10px;">
			
			<input type="submit" class="medium_button danger submit" style="line-height:23px;height:37px; border:1px solid #ff5629; background:#ff5629;" value="提交验证" />
			<input type="hidden" name="openid" value="<?php echo ($openid); ?>" />
			<input type="hidden" name="phone" value="" />
			</div>
		</form>
		</div>
	</body>
	<script type="text/javascript" crossorigin="anonymous">
		var wait=60; 
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

			var phone = $('input[name=iphone]').val();
			var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
			if (!reg.test(phone)) {
				alert("手机号号码有误~");
			}else{
				time();
				$('input[name=phone]').val(phone);
				$.ajax({
		             type: "post",
		             url: "__URL__/sendPhone",
		             data: "phone="+phone,
		             dataType: "json",
		             success: function(data){
		             	if(data.status == 1){
		             		//$.each(data, function(commentIndex, comment){
		             			//alert(comment.phone);
		             		//});
		             	}else{
		             		alert(data.info);
		             	}
		             }
		         });
			}
			
		}
		function time() {
			if (wait == 0) {  
					$('.send').attr("disabled",false).value("免费获取验证码");
		                     
		        
		            wait = 60;  
		        } else {   
		             
		            $('.send').attr("disabled",true).value("重新发送(" + wait + ")"); 
		            wait--;  
		            setTimeout(function() {  
		                time()  
		            },  
		            1000)  
		        } 
		}

	</script>
</html>