<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
                <title>币易网_比特币兑换商店,买卖比特币从未如此简单。</title>
  <meta name="keywords" content="币易网，比特币兑换，买卖比特币，比特币商店，比特币交易，比特币小额交易，快速购买比特币，比特币兑换商店，快捷购买比特币
" />
<meta name="description" content="币易网是一个比特币兑换商店，最专业的比特币平台，买卖比特币从未如此简单，让持比特币者免去中间的复杂操作，更快捷方便，服务周到专业。欢迎比特币爱好者使用。 " />
        <link rel="stylesheet" type="text/css" href="/Public/css/total.css">
        <link rel="stylesheet" type="text/css" href="/Public/tubiao/demo.css">
        <link rel="stylesheet" type="text/css" href="/Public/tubiao/iconfont.css">
		 <script type="text/javascript">
			(function () {
						var user = null;
						window.getUser = function () {
					return user;
				};
			})();
		</script>
		<script src="/Public/js/jquery.min.js"></script>
		<script type="text/javascript"> function baseUrl() {return '/';}</script>
		<script type="text/javascript" src="/Public/js/libs.min.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?5618f27e2065426340a7c54c3fef00de";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

    </head>
        <body class="landing">
        <header id="site-header" >
            <nav id="site-nav">
                <h1 id="logo">
                <a id="smarticons" href="/">
                       <img class="yincang" src="/Public/images/logo.png" height="80px;">
                    </a>
                </h1>
                <ul class="site-links">
                        
                <li class=""><a href="/">首页</a></li>
                    <li><a href="<?php echo U('Buy/index');?>">买比特币</a></li>
                     <li><a href="<?php echo U('Sale/index');?>">卖比特币</a></li>
				 <li><a href="https://bitcoin.org/zh_CN/choose-your-wallet" target="_blank">钱包下载</a></li>
                     <li class=""><a href="<?php echo U('Index/wenti');?>">常见问题</a></li>
                      <li class="call-out"><a href="http://wpa.qq.com/msgrd?v=3&uin=2807183483&site=qq&menu=yes" target='blank' class="sign-in-trial callout">在线客服</a></li>
                </ul>
                <a id="trigger-overlay"><span>导航</span></a>
            </nav>
        </header>

<section class="intro">
   <div class="wrapper">
    <section class="intro-text">
                              <h2 class="yincang"  style="visibility: visible; animation-name: fadeInDown;" class="wow fadeInDown">比特币兑换商店</h2>
                              <img class="logo" src="/Public/images/logo.png" height="80px;">
                              <p  class="yincang" style="visibility: visible; animation-name: fadeInDown;" class="wow fadeInDown">买卖比特币从未如此简单</p>
                              <div class="button-group">
                              <a style="visibility: visible; animation-delay: 200ms; animation-name: fadeInLeft;" href="<?php echo U('Buy/index');?>" data-wow-delay="200ms" class="cta button wow fadeInLeft">
                                    
                                 <i class="icon iconfont">&#xf0191;</i>
                                 <i class="icon iconfont">&#xe606;</i>
                                 <i class="icon iconfont">&#xe603;</i>
                                      
                                     买比特币
                                  </a>

                                  <a style="visibility: visible; animation-delay: 200ms; animation-name: fadeInRight;" href="<?php echo U('Sale/index');?>" data-wow-delay="200ms" class="cta button wow fadeInRight sign-in-trial">
                                  
                                          <i class="icon iconfont">&#xe603;</i>        
                                <i class="icon iconfont">&#xe606;</i>
                                <i class="icon iconfont">&#xf0191;</i>
                                    
                                      卖比特币
                                  </a>
                              </div>
                          </section>

    <section class="browser mai browser_h">
        <div class="bar">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        
       <ul class="xinxi xixin d_a"><li class="yincang">邮箱</li><li  class="mai_mai">买/卖</li><li>数量</li><li>成交时间</li>
        </ul>
		
        <ol class="xinxi xixin d_b" id="roll">
		 <?php if(is_array($art)): foreach($art as $key=>$vo): ?><li>
		        <a class="yincang"><span><?php echo (substr($vo['email'],0,1)); ?>*****<?php echo substr(strstr($vo['email'],'@',true),-1,1); echo strstr($vo['email'],'@');?></span></a>
		        
		        <span>
			        <?php if($vo['bsid'] == 1): ?>卖<?php endif; ?>
			        <?php if($vo['bsid'] == 2): ?>买<?php endif; ?>
		        </span>
		        
		        <span><?php echo ($vo["amount"]); ?></span>
		        <span><?php echo ($vo["add_date"]); ?></span>
	        </li><?php endforeach; endif; ?>
        </ol>
       
  
</section>

    </div>
<div class="b_bh"> Copyright©2015 bebtc.com 版权所有 京ICP备14058523号-3 </div>
 
</section>

<div class="overlay overlay-mega">
    <button type="button" class="overlay-close">Close</button>
    <nav>
        <ul>
        <li><a href="/" title="SmartIcons.co">首页</a></li>
        <li><a href="<?php echo U('Buy/index');?>">买比特币</a></li>
        <li><a href="<?php echo U('Sale/index');?>">卖比特币</a></li>
        <li><a href="<?php echo U('Index/wenti');?>">常见问题</a></li>
   
        <li class="call-out"><a href="http://wpa.qq.com/msgrd?v=3&uin=2807183483&site=qq&menu=yes" target='blank' class="sign-in-trial callout">在线客服</a></li>
        </ul>
    </nav>
</div>



    </body>
</html>