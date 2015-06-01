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
<script type="text/javascript" src="/AmaAdmin/js/custom/dashboard.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery( "#datepickfrom, #datepickto" ).datepicker();
})
function search()
{
    var time1 = jQuery("#datepickfrom").val();
    var time2 = jQuery("#datepickto").val();
    var blindid = jQuery("overviewselect").val();
    jQuery.ajax({
                    type:'post',        
                    url:'/index.php/admin/Order/census',    
                    data:"time1="+time1+"&time2="+time2+"&blindid="+blindid,    
                    cache:false,    
                    dataType:'json',
                    success:function(data){

                        if(data.status == 1){  
                            jQuery(".total").html(data.data.total);         
                            jQuery(".num").html(data.data.num);
                            jQuery(".price").html(data.data.price);
                            jQuery(".finish").html(data.data.finish);
                            jQuery(".remoney").html(data.data.remoney);
                            jQuery(".cancel").html(data.data.cancel);
                        }else if(data.status == 2){
                            alert('暂无数据');
                        }else{
                            alert('获取失败');
                        }

                    }
                });
}
</script>
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
<div class="centercontent">
	<div class="pageheader notab">
            <h1 class="pagetitle">订单统计</h1>
            <span class="pagedesc">此页面用于统计订单</span>
    </div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
    	<div id="basicform" class="subcontent">
	    		
        	   <div class="overviewhead">
                    <div class="overviewselect" style="margin-left:20px">
                        <a href="javascript:search()" class="btn btn_orange btn_search radius50"><span>搜索</span></a>
                    </div>
                    <div class="overviewselect">
                        <select id="overviewselect" name="blindname">
                            <option value="">选择按摩师</option>
                            <?php if(is_array($blist)): $i = 0; $__LIST__ = $blist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div><!--floatright-->
                    提交订单时间 从: &nbsp;<input type="text" id="datepickfrom" /> &nbsp; &nbsp; 到: &nbsp;<input type="text" id="datepickto" />
                </div><!--overviewhead-->
                <br clear="all">
                <table cellpadding="0" cellspacing="0" border="0" class="stdtable overviewtable">
                            <colgroup>
                                <col class="con0" width="20%" />
                                <col class="con1" width="20%" />
                                <col class="con0" width="20%" />
                                <col class="con1" width="10%" />
                                <col class="con0" width="10%" />
                                <col class="con1" width="10%" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="head0">订单总额</th>
                                    <th class="head1">订单数量</th>
                                    <th class="head0">平均订单金额</th>
                                    <th class="head1">完成订单</th>
                                    <th class="head0">退款订单</th>
                                    <th class="head1">取消订单</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center total"></td>
                                    <td class="center num"></td>
                                    <td class="center price"></td>
                                    <td class="center finish"></td>
                                    <td class="center remoney"></td>
                                    <td class="center cancel"></td>
                                </tr>
                            </tbody>
                        </table>
	    </div>
    </div>
</div>
</div><!--bodywrapper-->

</body>
</html>