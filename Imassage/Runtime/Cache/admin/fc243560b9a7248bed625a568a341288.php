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
<style type="text/css">
	.dataTables_paginate a{
		border: 1px solid #ccc;
        padding: 5px 7px;
        margin-left: 5px;
        font-weight: bold;
        background: #fcfcfc;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        font-size: 11px;
        -moz-box-shadow: 1px 1px 2px #ddd;
        -webkit-box-shadow: 1px 1px 2px #ddd;
        box-shadow: 1px 1px 2px #ddd;
		
	}
	.dataTables_paginate .current{
		border: 1px solid #F0882C;
        background: #F0882C;
        color: #fff;
        padding: 5px 7px;
        margin-left: 5px;
        font-weight: bold;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        font-size: 11px;
	}
</style>
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
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
<div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">服务</h1>
            <span class="pagedesc">按摩服务列表</span>
            
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
                        
                <div class="contenttitle2">
                	<h3>服务列表</h3>
                </div><!--contenttitle-->
                	
                <table cellpadding="0" cellspacing="0" border="0" class="stdtable">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="head0">ID</th>
                            <th class="head1">标题</th>
                            <th class="head0">最低价格</th>
                            <th class="head1">服务时间</th>
                            <th class="head0">操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="head0">ID</th>
                            <th class="head1">标题</th>
                            <th class="head0">最低价格</th>
                            <th class="head1">服务时间</th>
                            <th class="head0">操作</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["title"]); ?></td>
                            <td class="center"><?php echo (incprc($vo["price"])); ?>元</td>
                            <td class="center"><?php echo ($vo["timelong"]); ?>分钟</td>
                            <td class="center">
                            <ul class="buttonlist">
                            	<li><a href="###" class="btn btn3 btn_world"></a></li>
                            	<li><a href="__URL__/edit?id=<?php echo ($vo["id"]); ?>" class="btn btn3 btn_pencil"></a></li>
                            	<li><a href="__URL__/del?id=<?php echo ($vo["id"]); ?>" class="btn btn3 btn_orange btn_trash"></a></li>
                            </ul>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                
                <div class="dataTables_paginate paging_full_numbers" id="dyntable_paginate"><?php echo ($page); ?></div>
        </div>
</div>
</div><!--bodywrapper-->

</body>
</html>