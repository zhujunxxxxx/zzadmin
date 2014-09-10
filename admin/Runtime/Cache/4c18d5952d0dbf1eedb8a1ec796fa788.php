<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>计算机学院实验室综合管理系统</title>
    <link href="<?php echo (APP_TMPL_PATH); ?>/Index/Css/default.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (APP_TMPL_PATH); ?>/Index/themes/<?php echo ($theme); ?>/easyui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (APP_TMPL_PATH); ?>/Index/themes/icon.css" />
    <script type="text/javascript" src="<?php echo (PUBLICPATH); ?>/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo (PUBLICPATH); ?>/js/jquery.easyui.js"></script>

	<script type="text/javascript" src='<?php echo (PUBLICPATH); ?>/js/outlook2.js'> </script>
	  
	<script src="<?php echo (PUBLICPATH); ?>/artDialog4.1.6/artDialog.js"></script>
	<link href="<?php echo (PUBLICPATH); ?>/artDialog4.1.6/skins/opera.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	 $(function(){
		 art.dialog({
			    id: 'msg',
			    title: '公告',
			    content: '<h2>欢迎<?php echo ($username); ?>登录<br/>你上次登录的时间<?php echo ($lasttime); ?>,<br/>你是第<?php echo ($count); ?>次登录!!<br/><?php if($flag == 1): ?>你有<font color="red"><?php echo ($readcount); ?></font>条信息还未审核!<?php endif; ?></h2>',
			    width: 320,
			    height: 240,
			    left: '100%',
			    top: '100%',
			    fixed: true,
			    drag: false,
			    resize: false
			}) 
	 });
	</script>
    <script type="text/javascript">
	
	  	var _menus=<?php echo ($menu); ?>;
		
	 //alert(_menus);
        //设置登录窗口
        function openPwd() {
            $('#w').window({
                title: '修改密码',
                width: 300,
                modal: true,
                shadow: true,
                closed: true,
                height: 160,
                resizable:false
            });
        }
        //关闭登录窗口
        function close() {
            $('#w').window('close');
        }
		
        function closeLogin()
        {
        	$('#w').window('close');
        }

        //修改密码
        function serverLogin() {
            var $newpass = $('#txtNewPass');
            var $rePass = $('#txtRePass');

            if ($newpass.val() == '') {
                msgShow('系统提示', '请输入密码！', 'warning');
                return false;
            }
            if ($rePass.val() == '') {
                msgShow('系统提示', '请在一次输入密码！', 'warning');
                return false;
            }

            if ($newpass.val() != $rePass.val()) {
                msgShow('系统提示', '两次密码不一至！请重新输入', 'warning');
                return false;
            }

            $.post('__APP__/Index/changepass?pass=' + $newpass.val(), function(msg) {
            	if(msg!="error")
            	{
		                msgShow('系统提示', '恭喜，密码修改成功！<br>您的新密码为：' + msg, 'info');
		                $newpass.val('');
		                $rePass.val('');
		                close();
            	}
            	else
            	{
            		 msgShow('系统提示', '密码修改失败,请输入和原密码不同', 'info');
            		 $newpass.val('');
		             $rePass.val('');
		             close();
            	}
                
            })
            
        }

        $(function() {

            openPwd();
            
            $('#editpass').click(function() {
                $('#w').window('open');
            });

            $('#btnEp').click(function() {
                serverLogin();
            })

           

            $('#loginOut').click(function() {
                $.messager.confirm('系统提示', '您确定要退出本次登录吗?', function(r) 				{
	
                    if (r) {
                    	$.post('__APP__/Index/loginout', function(msg) {
                    		
                    		 location.href = '__ROOT__/admin.php/Index/adminlogin';
                            
                        });
                       
                    }
                });

            })
			
			
			
        });
    </script>
    
    
    <!-- 走马灯 css -->
    <style type="text/css">
	*{margin:0;padding:0;}
	ul,li{list-style-type:none;}
	body{font:12px/180% Arial, Helvetica, sans-serif;}
	a{color:#333;text-decoration:none;}
	a:hover{color:#3366cc;text-decoration:underline;}
	.demopage{width:960px;margin:0 auto;}
	.demopage h2{font-size:14px;margin:20px 0;}
	/* scrollDiv */
	.scrollDiv{height:25px;/* 必要元素 */line-height:25px;border:#ccc 1px solid;overflow:hidden;/* 必要元素 */}
	.scrollDiv li{height:25px;padding-left:10px;}
	#s2,#s3{height:100px;}
	</style>
	<script type="text/javascript">
	//滚动插件
	(function($){
		$.fn.extend({
			Scroll:function(opt,callback){
					//参数初始化
					if(!opt) var opt={};
					var _this=this.eq(0).find("ul:first");
					var lineH=_this.find("li:first").height(), //获取行高
						line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
						speed=opt.speed?parseInt(opt.speed,10):500, //卷动速度，数值越大，速度越慢（毫秒）
						timer=opt.timer?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒）
					if(line==0) line=1;
					var upHeight=0-line*lineH;
					//滚动函数
					scrollUp=function(){
							_this.animate({
									marginTop:upHeight
							},speed,function(){
									for(i=1;i<=line;i++){
											_this.find("li:first").appendTo(_this);
									}
									_this.css({marginTop:0});
							});
					}
					//鼠标事件绑定
					_this.hover(function(){
							clearInterval(timerID);
					},function(){
							timerID=setInterval("scrollUp()",timer);
					}).mouseout();
			}       
		});
	})(jQuery);
	
	$(document).ready(function(){
		$("#s2").Scroll({line:4,speed:500,timer:4000});
	});
	</script>
	<!-- 走马灯 css -->
</head>
<body class="easyui-layout" style="overflow-y: hidden"  scroll="no">
<noscript>
<div style=" position:absolute; z-index:100000; height:2046px;top:0px;left:0px; width:100%; background:white; text-align:center;">
    <!--<img src="<?php echo (APP_TMPL_PATH); ?>Index/images/noscript.gif" alt='抱歉，请开启脚本支持！' />-->
</div></noscript>
    <div region="north" split="true" border="false" style="overflow: hidden; height: 30px;
        background: url(<?php echo (APP_TMPL_PATH); ?>Index/images/layout-browser-hd-bg.gif) #7f99be repeat-x center 50%;
        line-height: 20px;color: #fff; font-family: Verdana, 微软雅黑,黑体">
        <span style="float:right; padding-right:20px;" class="head">欢迎 <?php echo ($admin); ?>回来 <a href="#" id="editpass">修改密码</a> <a href="#" id="loginOut">安全退出</a></span>
        <span style="padding-left:10px; font-size: 16px; "><img src="<?php echo (APP_TMPL_PATH); ?>Index/images/blocks.gif" width="20" height="20" align="absmiddle" /> 计算机学院实验室综合管理系统</span>
    </div>
    <div region="south" split="true" style="height: 30px; background: #D2E0F2; ">
        <div class="footer">By zz Email:455910092@qq.com</div>
    </div>
    <div region="west" split="true" title="导航菜单" style="width:180px;" id="west">
		<div  class="easyui-accordion" fit="true" border="false">
		<!--  导航内容 -->
				
		</div>

    </div>
    <div id="mainPanle" region="center" style="background: #eee; overflow-y:hidden">
        <div id="tabs" class="easyui-tabs"  fit="true" border="false" >
			<div title="欢迎使用" style="padding:20px;overflow:hidden;" id="home">
				
			<h1>欢迎来到计算机学院实验室综合管理系统</h1>
			<br/>
			
			
			
			<div class="scrollDiv" id="s2">
				<ul>
				<?php if(is_array($notice_list)): $i = 0; $__LIST__ = array_slice($notice_list,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><font color="red">[公告]:<?php echo ($vo["title"]); ?>：<?php echo ($vo["content"]); ?> <?php echo ($vo["time"]); ?></font></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			
			</div>
		</div>
    </div>
    
    
    <!--修改密码窗口-->
    <div id="w" class="easyui-window" title="修改密码" collapsible="false" minimizable="false"
        maximizable="false" icon="icon-save"  style="width: 300px; height: 150px; padding: 5px;
        background: #fafafa;">
        <div class="easyui-layout" fit="true">
            <div region="center" border="false" style="padding: 10px; background: #fff; border: 1px solid #ccc;">
                <table cellpadding=3>
                    <tr>
                        <td>新密码：</td>
                        <td><input id="txtNewPass" type="password" class="txt01" /></td>
                    </tr>
                    <tr>
                        <td>确认密码：</td>
                        <td><input id="txtRePass" type="password" class="txt01" /></td>
                    </tr>
                </table>
            </div>
            <div region="south" border="false" style="text-align: right; height: 30px; line-height: 30px;">
                <a id="btnEp" class="easyui-linkbutton" icon="icon-ok" href="javascript:void(0)" >
                    确定</a> <a class="easyui-linkbutton" icon="icon-cancel" href="javascript:void(0)"
                        onclick="closeLogin()">取消</a>
            </div>
        </div>
    </div>
 
	<div id="mm" class="easyui-menu" style="width:150px;">
		<div id="mm-tabclose">关闭</div>
		<div id="mm-tabcloseall">全部关闭</div>
		<div id="mm-tabcloseother">除此之外全部关闭</div>
		<div class="menu-sep"></div>
		<div id="mm-tabcloseright">当前页右侧全部关闭</div>
		<div id="mm-tabcloseleft">当前页左侧全部关闭</div>
		<div class="menu-sep"></div>
		<div id="mm-exit">退出</div>
	</div>


</body>
</html>