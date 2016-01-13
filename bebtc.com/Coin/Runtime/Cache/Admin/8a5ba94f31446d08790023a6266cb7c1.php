<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/Public/Admin/css/common.css">
  <link rel="stylesheet" href="/Public/Admin/css/style.css">
  <script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="/Public/Admin/js/jquery.SuperSlide.js"></script>
  <script type="text/javascript">
  $(function(){
      $(".sideMenu").slide({
         titCell:"h3", 
         targetCell:"ul",
         defaultIndex:0, 
         effect:'slideDown', 
         delayTime:'500' , 
         trigger:'click', 
         triggerTime:'150', 
         defaultPlay:true, 
         returnDefault:false,
         easing:'easeInQuint',
         endFun:function(){
              scrollWW();
         }
       });
      $(window).resize(function() {
          scrollWW();
      });
  });
  function scrollWW(){
    if($(".side").height()<$(".sideMenu").height()){
       $(".scroll").show();
       var pos = $(".sideMenu ul:visible").position().top-38;
       $('.sideMenu').animate({top:-pos});
    }else{
       $(".scroll").hide();
       $('.sideMenu').animate({top:0});
       n=1;
    }
  } 

var n=1;
function menuScroll(num){
  var Scroll = $('.sideMenu');
  var ScrollP = $('.sideMenu').position();
  /*alert(n);
  alert(ScrollP.top);*/
  if(num==1){
     Scroll.animate({top:ScrollP.top-38});
     n = n+1;
  }else{
    if (ScrollP.top > -38 && ScrollP.top != 0) { ScrollP.top = -38; }
    if (ScrollP.top<0) {
      Scroll.animate({top:38+ScrollP.top});
    }else{
      n=1;
    }
    if(n>1){
      n = n-1;
    }
  }
}
  </script>
  <title>后台首页</title>
</head>
<body>
    <div class="top">
      <div id="top_t">
        <div id="logo" class="fl"></div>
        <div id="photo_info" class="fr">
          <div id="photo" class="fl">
            <a href="#"><img src="/Public/Admin/images/a.png" alt="" width="60" height="60"></a>
          </div>
          <div id="base_info" class="fr"> 
			<div class="info_center" style="padding-left:10px;">
			  <span  id="nt"> <a href="<?php echo U('Login/loginOut');?>" style="color:#ccc">退出</a></span>
            </div>
          </div>
        </div>
      </div>
      <div id="side_here">
        <div id="side_here_l" class="fl"></div>
        <div id="here_area" class="fl">当前位置：</div>
      </div>
    </div>
    <div class="side">
        <div class="sideMenu" style="margin:0 auto">
          <h3>导航菜单</h3>
          <ul>
             <li><a href="<?php echo U('Index/buy');?>" target="right">购买列表</a></li>
             <li><a href="<?php echo U('Index/sale');?>" target="right">卖出列表</a></li>
          </ul>
          <h3>托管操作</h3>
          <ul>
           <li><a href="<?php echo U('');?>" target="right">购买比特币</a></li>
            <li><a href="<?php echo U('');?>" target="right">出售比特币</a></li>
          </ul>
          <h3>银行管理</h3>
          <ul>
           <li><a href="<?php echo U('Index/banklist');?>" target="right">银行列表</a></li>
            <li><a href="<?php echo U('Index/bankview');?>" target="right">添加银行</a></li>
          </ul>
          <h3>平台参数</h3>
          <ul>
           <li><a href="<?php echo U('System/index');?>" target="right">实时价格比</a></li>
           
          </ul>

       </div>
    </div>
    <div class="main">
       <iframe name="right" id="rightMain" src="main.html" frameborder="no" scrolling="auto" width="100%" height="auto" allowtransparency="true"></iframe>
    </div>
    <div class="bottom">
      <div id="bottom_bg">版权</div>
    </div>
    <div class="scroll">
          <a href="javascript:;" class="per" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(1);"></a>
          <a href="javascript:;" class="next" title="使用鼠标滚轴滚动侧栏" onclick="menuScroll(2);"></a>
    </div>
</body>

</html>