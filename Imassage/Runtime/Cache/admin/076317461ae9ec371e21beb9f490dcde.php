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
                    <h2>$640.01</h2>
                </div><!--one_half-->
                <div class="one_half last alignright">
                	<h4>今日订单</h4>
                    <h2>53%</h2>
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
                </ul>
            </li>
        	<li><a href="<?php echo U('User/index');?>" class="">用户管理</a></li>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
<div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">订单列表</h1>
            <span class="pagedesc">全部订单列表</span>
            <ul class="hornav">
                <li class="current"><a href="#all">全部订单</a></li>
                <li><a href="#unfinish">未完成订单</a></li>
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	<div id="all" class="subcontent">
        		<table cellpadding="0" cellspacing="0" border="0" class="stdtable">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="head0">ID</th>
                            <th class="head1">用户名</th>
                            <th class="head0">电话</th>
                            <th class="head1">服务项目</th>
                            <th class="head0">按摩师</th>
                            <th class="head1">人数</th>
                            <th class="head0">预约时间</th>
                            <th class="head1">支付状态</th>
                            <th class="head0">订单金额</th>
                            <th class="head1">操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="head0">ID</th>
                            <th class="head1">用户名</th>
                            <th class="head0">电话</th>
                            <th class="head1">服务项目</th>
                            <th class="head0">按摩师</th>
                            <th class="head1">人数</th>
                            <th class="head0">预约时间</th>
                            <th class="head1">支付状态</th>
                            <th class="head0">订单金额</th>
                            <th class="head1">操作</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td class="center"><?php echo ($vo["phone"]); ?></td>
                            <td><?php echo ($vo["title"]); ?></td>
                            <td><?php echo ($vo["blindman"]); ?></td>
                            <td><?php echo ($vo["num"]); ?></td>
                            <td><?php echo (date("y-m-d H:i",$vo["starttime"])); ?></td>
                            <td><?php echo (paystatus($vo["status"])); ?></td>
                            <td><?php echo (incprc($vo["total"])); ?></td>
                            <td class="center">
                            <ul class="buttonlist">
                            	<li><a href="javascript:view(<?php echo ($vo["id"]); ?>)" class="btn btn_info"><span>订单详情</span></a></li>
                                <?php if($vo["status"] == 1): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=1" class="btn btn_orange btn_trash" onclick="return confirm('是否取消订单');"><span>取消订单</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 2): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=2" class="btn btn_archive" onclick="return confirm('是否确认订单');"><span>确认订单</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 3): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=3" class="btn btn_orange btn_trash" onclick="return confirm('是否完成按摩');"><span>服务完成</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 4): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=4" class="btn btn_archive" onclick="return confirm('是否确认订单');"><span>订单完成</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 6): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=5" class="btn btn_orange btn_trash" onclick="return confirm('确定同意退款');"><span>同意退款</span></a></li>
                                <li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=6" class="btn btn_archive" onclick="return confirm('不同意退款');"><span>不同意退款</span></a></li><?php endif; ?>
                            </ul>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                
                <div class="dataTables_paginate paging_full_numbers" id="dyntable_paginate"><?php echo ($page); ?></div>
        	</div>
        	<div id="unfinish" class="subcontent" style="display: none">
        		<table cellpadding="0" cellspacing="0" border="0" class="stdtable">
                    <colgroup>
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="head0">ID</th>
                            <th class="head1">用户名</th>
                            <th class="head0">电话</th>
                            <th class="head1">服务项目</th>
                            <th class="head0">按摩师</th>
                            <th class="head1">人数</th>
                            <th class="head0">预约时间</th>
                            <th class="head1">支付状态</th>
                            <th class="head0">订单金额</th>
                            <th class="head1">操作</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="head0">ID</th>
                            <th class="head1">用户名</th>
                            <th class="head0">电话</th>
                            <th class="head1">服务项目</th>
                            <th class="head0">按摩师</th>
                            <th class="head1">人数</th>
                            <th class="head0">预约时间</th>
                            <th class="head1">支付状态</th>
                            <th class="head0">订单金额</th>
                            <th class="head1">操作</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php if(is_array($unlist)): $i = 0; $__LIST__ = $unlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td class="center"><?php echo ($vo["phone"]); ?></td>
                            <td><?php echo ($vo["title"]); ?></td>
                            <td><?php echo ($vo["blindman"]); ?></td>
                            <td><?php echo ($vo["num"]); ?></td>
                            <td><?php echo (date("y-m-d H:i",$vo["starttime"])); ?></td>
                            <td><?php echo (paystatus($vo["status"])); ?></td>
                            <td><?php echo (incprc($vo["total"])); ?></td>
                            <td class="center">
                            <ul class="buttonlist">
                                <li><a href="javascript:view(<?php echo ($vo["id"]); ?>)" class="btn btn_info"><span>订单详情</span></a></li>
                                <?php if($vo["status"] == 1): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=1" class="btn btn_orange btn_trash" onclick="return confirm('是否取消订单');"><span>取消订单</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 2): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=2" class="btn btn_archive" onclick="return confirm('是否确认订单');"><span>确认订单</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 3): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=3" class="btn btn_orange btn_trash" onclick="return confirm('是否完成按摩');"><span>服务完成</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 4): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=4" class="btn btn_archive" onclick="return confirm('是否确认订单');"><span>订单完成</span></a></li><?php endif; ?>
                                <?php if($vo["status"] == 6): ?><li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=5" class="btn btn_orange btn_trash" onclick="return confirm('确定同意退款');"><span>同意退款</span></a></li>
                                <li><a href="__URL__/changeOrder?id=<?php echo ($vo["id"]); ?>&status=6" class="btn btn_archive" onclick="return confirm('不同意退款');"><span>不同意退款</span></a></li><?php endif; ?>
                            </ul>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
        	</div>
        </div><!--contentwrapper-->

</div><!-- centercontent -->
</div><!--bodywrapper-->

</body>
</html>
<script text="javascript/text">
    function view(id){
        var text = "";
        jQuery.ajax({
                    type:'post',        
                    url:'/index.php/admin/Order/view',    
                    data:"id="+id,    
                    cache:false,    
                    dataType:'json',
                    success:function(data){
                        if (data.status == 1) {
                            text = "用户名：" + data.data.name + "\n\r";
                            if (data.data.coupons == null) {
                                text += "优惠券：" + "没有使用" + "\n\r";
                            }else{
                                text += "优惠券：" + data.data.coupons + "(" + (data.data.coupons_price/100) + ")" + "\n\r";
                            };
                            
                            text += "按摩单价：" + (data.data.price/100) + "\n\r";
                            text += "人数：" + (data.data.num) + "\n\r";
                            text += "按摩总价：" + (data.data.total/100) + "\n\r";
                            text += "地址：" + (data.data.address) + "\n\r";
                            text += "下单时间：" + getLocalTime(data.data.addtime) + "\n\r";
                            if(data.data.updatetime != null){
                                text += "订单更新时间：" + getLocalTime(data.data.updatetime) + "\n\r";
                            }
                            if(data.data.updatetime != null){
                                text += "订单完成时间：" + getLocalTime(data.data.endtime) + "\n\r";
                            }
                            alert(text);
                        }else{
                            alert("数据错误！");
                        };
                    }
                });
    }

    function getLocalTime(nS) {     
       return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:d{1,2}$/,' ');     
    } 
</script>