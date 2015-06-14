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
	})
	</script>
</head>
<body class="">
	<div id="AppointType">
		<div class="wrap" style="line-height:45px; color:#fff;">
			订单列表
		</div>
	</div>
	<div id="AppointTypeSpace"></div>
	<?php if(($isempty) == "1"): ?><ul id="Main" class="container">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="p<?php echo ($vo["id"]); ?>" onclick="location.href='__APP__/Check/index?state=/Order/orderinfo/id/<?php echo ($vo["id"]); ?>'">
            		<img async-src="<?php echo ($vo["img"]); ?>" height="75" width="75" title="<?php echo ($vo["title"]); ?>" class="titleImage" src="<?php echo ($vo["img"]); ?>">
            		<div class="title"><?php echo ($vo["title"]); ?>
            			<span class="price">￥<?php echo (incprc($vo["total"])); ?>
            			<span class="font-smaller">(<?php echo (paystatus($vo["status"])); ?>)</span>
            			</span>
            		</div>
            		<div class="desc">
            			<img async-src="__PUBLIC__/img/clock.png" height="13" src="__PUBLIC__/img/clock.png">
            			<span>
                            <?php echo ($vo["timelong"]); ?>分钟
            			</span>
            		</div>
            		<div class="btn">
            			<a>查看详细</a>
            		</div>
            		<div class="clear"></div>
        	</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	<?php else: ?>
		<div class="f40">暂无订单</div>
		<div class="btn"><a href="__APP__/index">去预约</a></div><?php endif; ?>
	<div id="BottomMenuSpace"></div>
		<table id="BottomMenu">
		<tbody>
		<tr>
			<td id="home" class="">
				<a href="__APP__/index">
				<span class="icon">
				<img async-src="__PUBLIC__/img/home.png" width="20" height="20" src="__PUBLIC__/img/home.png">
				</span>
				<span class="title">预约</span>
				</a>
			</td>
			<td id="myorder" class="active">
				<a href="###">
				<span class="icon">
				<img async-src="__PUBLIC__/img/myorder.active.png" width="20" height="20" src="__PUBLIC__/img/myorder.active.png">
				</span>
				<span class="title">订单</span>
				</a>
			</td>
			<td id="people" class="">
				<a href="__APP__/Check/index?state=/user/index">
				<span class="icon">
				<img async-src="__PUBLIC__/img/people.png" width="20" height="20" src="__PUBLIC__/img/people.png">
				</span>
				<span class="title">个人</span>
				</a>
			</td>
		</tr>
		</tbody>
		</table>
</body>
</html>