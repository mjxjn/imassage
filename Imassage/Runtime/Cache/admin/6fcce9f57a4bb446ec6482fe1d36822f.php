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
    <div class="vernav2 iconmenu">
    	<ul>
            <li><a href="#product">服务管理</a>
                <span class="arrow"></span>
                <ul id="product">
                    <li><a href="<?php echo U('Product/index');?>">服务列表</a></li>
                    <li><a href="<?php echo U('Product/add');?>">添加服务</a></li>
                </ul>
            </li>
            <li><a href="#blindman">按摩师管理</a>
                <span class="arrow"></span>
                <ul id="blindman">
                    <li><a href="<?php echo U('Blindman/index');?>">按摩师列表</a></li>
                    <li><a href="<?php echo U('Blindman/add');?>">添加按摩师</a></li>
                </ul>
            </li> 
        	<li><a href="#formsub" class="editor">表单提交</a>
            	<span class="arrow"></span>
            	<ul id="formsub">
               		<li><a href="forms.html">基础表单</a></li>
                    <li><a href="wizard.html">表单验证</a></li>
                    <li><a href="editor.html">编辑器</a></li>
                </ul>
            </li>
            <!--<li><a href="filemanager.html" class="gallery">文件管理</a></li>-->
            <li><a href="elements.html" class="elements">网页元素</a></li>
            <li><a href="widgets.html" class="widgets">网页插件</a></li>
            <li><a href="calendar.html" class="calendar">日历事件</a></li>
            <li><a href="support.html" class="support">客户支持</a></li>
            <li><a href="typography.html" class="typo">文字排版</a></li>
            <li><a href="tables.html" class="tables">数据表格</a></li>
			<li><a href="buttons.html" class="buttons">按钮 &amp; 图标</a></li>
            <li><a href="#error" class="error">错误页面</a>
            	<span class="arrow"></span>
            	<ul id="error">
               		<li><a href="notfound.html">404错误页面</a></li>
                    <li><a href="forbidden.html">403错误页面</a></li>
                    <li><a href="internal.html">500错误页面</a></li>
                    <li><a href="offline.html">503错误页面</a></li>
                </ul>
            </li>
            <li><a href="#addons" class="addons">其他页面</a>
            	<span class="arrow"></span>
            	<ul id="addons">
               		<li><a href="newsfeed.html">新闻订阅</a></li>
                    <li><a href="profile.html">资料页面</a></li>
                    <li><a href="productlist.html">产品列表</a></li>
                    <li><a href="photo.html">图片视频分享</a></li>
                    <li><a href="gallery.html">相册</a></li>
                    <li><a href="invoice.html">购物车</a></li>
                </ul>
            </li>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
<script type="text/javascript" src="/AmaAdmin/js/custom/forms.js"></script>
 <link href="/AmaAdmin/js/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" charset="utf-8" src="/AmaAdmin/js/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/AmaAdmin/js/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/AmaAdmin/js/umeditor/lang/zh-cn/zh-cn.js"></script>
<div class="centercontent">
	<div class="pageheader">
            <h1 class="pagetitle">服务</h1>
            <span class="pagedesc">此页面用于添加服务</span>
    </div><!--pageheader-->
    <div id="contentwrapper" class="contentwrapper">
    	<div id="basicform" class="subcontent">
    				<div class="contenttitle2">
                        <h3>添加服务</h3>
                    </div><!--contenttitle-->

                    <form id="pform" class="stdform" action="" method="post" enctype="multipart/form-data">
                    	<p>
                        	<label>服务名称</label>
                            <span class="field"><input type="text" name="title" value="<?php echo ($info["title"]); ?>" id="title" class="mediuminput" /></span>
                            <small class="desc">请输入服务名称.</small>
                        </p>
                        
                        <p>
                        	<label>图片</label>
                            <span class="field"><input name="newimg" type="file" /><img src="/<?php echo ($info["img"]); ?>" width="100"></span>
                            <small class="desc">服务描述图片.</small>
                            <input type="hidden" name="img" value="<?php echo ($info["img"]); ?>" />
                        </p>
                        <p>
                        	<label>按摩分类</label>
                            <span class="field">
                            	<input type="radio" name="typeid" value="1" <?php if(($info["typeid"]) == "1"): ?>checked="checked"<?php endif; ?> /> 坐 &nbsp; &nbsp;
                            	<input type="radio" name="typeid" value="2" <?php if(($info["typeid"]) == "2"): ?>checked="checked"<?php endif; ?>  /> 卧 &nbsp; &nbsp;
                            </span>
                        </p>
                        <p>
                        	<label>最低价格</label>
                            <span class="field"><input type="text" name="price" value="<?php echo (incprc($info["price"])); ?>" class="smallinput" /></span>
                            <small class="desc">服务价格XXX起.单位“元”</small>
                        </p>
                    	<p>
                        	<label>套餐添加</label>
                            <span class="field">套餐名&nbsp; &nbsp;<input type="text" name="title0" class="smallinput" style="width:200px;" value="<?php echo (($title0)?($title0):''); ?>" disabled="disabled" />&nbsp; &nbsp;价格&nbsp; &nbsp;<input type="text" name="price0" value="<?php echo ((incprc($price0))?(incprc($price0)):''); ?>" class="smallinput" /><input type="hidden" name="id0" value="<?php echo (($id0)?($id0):''); ?>" /></span>
                            <span class="field">套餐名&nbsp; &nbsp;<input type="text" name="title1" class="smallinput" style="width:200px;" value="<?php echo (($title1)?($title1):''); ?>" disabled="disabled"/>&nbsp; &nbsp;价格&nbsp; &nbsp;<input type="text" name="price1" value="<?php echo ((incprc($price1))?(incprc($price1)):''); ?>" class="smallinput" /><input type="hidden" name="id1" value="<?php echo (($id1)?($id1):''); ?>" /></span>
                            <span class="field">套餐名&nbsp; &nbsp;<input type="text" name="title2" class="smallinput" style="width:200px;" value="<?php echo (($title2)?($title2):''); ?>" disabled="disabled"/>&nbsp; &nbsp;价格&nbsp; &nbsp;<input type="text" name="price2" value="<?php echo ((incprc($price2))?(incprc($price2)):''); ?>" class="smallinput" /><input type="hidden" name="id2" value="<?php echo (($id2)?($id2):''); ?>" /></span>
                            <small class="desc">单位“元”</small>
                        </p>
                        <p>
                        	<label>服务时间</label>
                            <span class="field"><input type="text" name="timelong" value="<?php echo ($info["timelong"]); ?>" class="smallinput" /></span>
                            <small class="desc">单位“分钟”.</small>
                        </p>
                        <p>
                        	<label>起订人数</label>
                            <span class="field"><input type="text" name="minpeople" value="<?php echo ($info["minpeople"]); ?>" class="smallinput" /></span>
                            <small class="desc">XXX人起订.</small>
                        </p>
                        <p>
                        	<label>服务内容</label>
                        	<span class="field">
                        		<script type="text/plain" id="myEditor" style="width:700px;height:240px;"><?php echo ($info["content"]); ?></script>
                        	</span>
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
<script type="text/javascript">
    //实例化编辑器
    var um = UM.getEditor('myEditor');
</script>