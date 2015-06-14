<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>控制台页面_Imassage后台管理系统</title>
<link rel="stylesheet" href="/AmaAdmin/css/style.default.css" type="text/css" />
<script type="text/javascript" src="/AmaAdmin/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="/AmaAdmin/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="/AmaAdmin/js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="/AmaAdmin/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/AmaAdmin/js/custom/general.js"></script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/AmaAdmin/js/plugins/excanvas.min.js"></script><![endif]-->
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="/AmaAdmin/css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="/AmaAdmin/css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="/AmaAdmin/js/plugins/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="withvernav">
<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
            <h1 class="logo"><span>Imassage</span></h1>
            <span class="slogan">后台管理系统</span>
            
            <!-- <div class="search">
            	<form action="" method="post">
                	<input type="text" name="keyword" id="keyword" value="请输入" />
                    <button class="submitbutton"></button>
                </form>
            </div> --><!--search-->
            
            <br clear="all" />
            
        </div><!--left-->
        
        <div class="right">
        	<!--<div class="notification">
                <a class="count" href="ajax/notifications.html"><span>9</span></a>
        	</div>-->
            <div class="userinfo">
            	<img src="/AmaAdmin/images/thumbs/avatar.png" alt="" />
                <span>管理员</span>
            </div><!--userinfo-->
            
            <div class="userinfodrop">
            	 <div class="avatar">
                	<img src="/AmaAdmin/images/thumbs/avatarbig.png" alt="" />
                    <!--<div class="changetheme">
                    	切换主题: <br />
                    	<a class="default"></a>
                        <a class="blueline"></a>
                        <a class="greenline"></a>
                        <a class="contrast"></a>
                        <a class="custombg"></a>
                    </div> -->
                </div> <!--avatar-->
                <div class="userdata">
                	<h4><?php echo (session('admin')); ?></h4>
                    <span class="email"></span>
                    <ul>
                    	<li><a href="<?php echo U('Admin/editpassword');?>">修改密码</a></li>
                        <li><a href="<?php echo U('Index/logout');?>">退出</a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
    
    
    <div class="header">
    	<ul class="headermenu">
        	<li <?php if(($mainmenu) == "index"): ?>class="current"<?php endif; ?>><a href="<?php echo U('Index/index');?>"><span class="icon icon-flatscreen"></span>首页</a></li>
            <li <?php if(($mainmenu) == "product"): ?>class="current"<?php endif; ?>><a href="<?php echo U('Product/index');?>"><span class="icon icon-pencil"></span>服务管理</a></li>
            <li <?php if(($mainmenu) == "weixin"): ?>class="current"<?php endif; ?>><a href="<?php echo U('Weixin/index');?>"><span class="icon icon-message"></span>微信管理</a></li>
            <li <?php if(($mainmenu) == "order"): ?>class="current"<?php endif; ?>><a href="<?php echo U('Order/index');?>"><span class="icon icon-chart"></span>订单管理</a></li>
        </ul>
        
       <div class="headerwidget">
        	<div class="earnings">
            	<div class="one_half">
                	<h4>今日收入</h4>
                    <h2><?php echo ($todaytotal); ?></h2>
                </div><!--one_half-->
                <div class="one_half last alignright">
                	<h4>今日订单</h4>
                    <h2><?php echo ($todaynum); ?></h2>
                </div><!--one_half last-->
            </div><!--earnings-->
        </div><!--headerwidget-->
        
    </div><!--header-->

<script type="text/javascript" src="/AmaAdmin/js/custom/forms.js"></script>
    <div class="vernav2 iconmenu">
    	<ul>
            <li><a href="#product" class="addons">服务管理</a>
                <span class="arrow"></span>
                <ul id="product">
                    <li><a href="<?php echo U('Product/index');?>">服务列表</a></li>
                    <li><a href="<?php echo U('Product/add');?>">添加服务</a></li>
                </ul>
            </li>
            <li><a href="#blindman" class="elements">按摩师管理</a>
                <span class="arrow"></span>
                <ul id="blindman">
                    <li><a href="<?php echo U('Blindman/index');?>">按摩师列表</a></li>
                    <li><a href="<?php echo U('Blindman/add');?>">添加按摩师</a></li>
                </ul>
            </li> 
            <li><a href="#order" class="tables">订单管理</a>
                <span class="arrow"></span>
                <ul id="order">
                    <li><a href="<?php echo U('Order/index');?>">订单列表</a></li>
                    <li><a href="<?php echo U('Order/census');?>">订单统计</a></li>
                    <li><a href="<?php echo U('Comment/index');?>">订单评论</a></li>
                    <li><a href="<?php echo U('Comment/add');?>">添加评论</a></li>
                </ul>
            </li>
        	<li><a href="<?php echo U('User/index');?>" class="">用户管理</a></li>
            <li><a href="#coupons" class="tables">优惠券管理</a>
                <span class="arrow"></span>
                <ul id="coupons">
                    <li><a href="<?php echo U('Coupons/index');?>" class="">优惠券列表</a></li>
                    <li><a href="<?php echo U('Coupons/add');?>">添加优惠券</a></li>
                </ul>
            </li>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
<div class="centercontent">
	<div class="pageheader notab">
            <h1 class="pagetitle">按摩师</h1>
            <span class="pagedesc">此页面用于添加按摩师</span>
    </div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
    	<div id="basicform" class="subcontent">
    				<div class="contenttitle2">
                        <h3>添加按摩师</h3>
                    </div><!--contenttitle-->

                    <form id="pform" class="stdform" action="" method="post" enctype="multipart/form-data">
                    	<p>
                        	<label>按摩师名</label>
                            <span class="field"><input type="text" name="name" id="name" value="<?php echo ($info["name"]); ?>" class="mediuminput" /></span>
                            <small class="desc">请输入按摩师名.</small>
                        </p>
                        
                        <p>
                        	<label>按摩师图片</label>
                            <span class="field"><input type="file" name="newimg" /> <img src="/<?php echo ($info["img"]); ?>" width="100"></span>
                            <small class="desc">按摩师图片.</small><input type="hidden" name="img" value="<?php echo ($info["img"]); ?>" />
                        </p>
                        <p>
                        	<label>按摩性别</label>
                            <span class="field">
                            	<input type="radio" name="sex" <?php if(($info["sex"]) == "1"): ?>checked="checked"<?php endif; ?> value="1" /> 男 &nbsp; &nbsp;
                            	<input type="radio" name="sex" <?php if(($info["sex"]) == "2"): ?>checked="checked"<?php endif; ?> value="2" /> 女 &nbsp; &nbsp;
                            </span>
                        </p>
                        <p>
                        	<label>按摩师级别</label>
                            <span class="field">
                                <select name="level" class="uniformselect">
                                    <option value="高级" <?php if(($info["level"]) == "高级"): ?>selected=""<?php endif; ?> >高级</option>
                                    <option value="特级" <?php if(($info["level"]) == "特级"): ?>selected=""<?php endif; ?>>特级</option>
                                    <option value="专家" <?php if(($info["level"]) == "专家"): ?>selected=""<?php endif; ?>>专家</option>
                                </select>
                            </span>
                        </p>
                        <p>
                        	<label>工作经验</label>
                        	<span class="field">
                        		<textarea cols="80" rows="5" name="content" id="content" class="longinput"><?php echo ($info["content"]); ?></textarea>
                        	</span>
                        </p>
                        <p>
                            <label>平台订单数量</label>
                            <span class="field">
                                <input type="text" name="ordernum" id="ordernum" value="<?php echo ($info["ordernum"]); ?>" class="mediuminput" />
                            </span>
                        </p>
                        <p>
                            
                        </p>
                        <p class="stdformbutton">
                        	<button class="submit radius2">提交修改</button><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
                            <input type="reset" class="reset radius2" value="重置表单" />
                        </p>
                    </form>
    	</div>
    </div>
</div>
</div><!--bodywrapper-->

</body>
</html>