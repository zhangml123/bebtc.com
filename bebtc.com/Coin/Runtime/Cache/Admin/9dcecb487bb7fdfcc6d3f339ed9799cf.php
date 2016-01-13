<?php if (!defined('THINK_PATH')) exit();?> <!doctype html>
 <html lang="zh-CN">
 <head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="/Public/Admin/css/common.css">
   <link rel="stylesheet" href="/Public/Admin/css/main.css">
   <script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
   <title>Document</title>
 </head>
 <body>
  <div class="container">
     <div id="table" class="mt10">
        <div class="box span10 oh">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <tr>
                   <th width="30">ID</th>
                   <th width="100">订单号</th>
				   <th width="100">数量</th>
				    <th width="100">总价</th>
					 <th width="100">单价</th>
					  <th width="100">收币地址</th>
					   <th width="100">邮箱</th>
					   <th width="100">时间</th>
					    <th width="100">状态</th>
						 <th width="100">操作</th>
	 
                   
                </tr>
                
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr">
                   <td class="td_center"><?php echo ($vo["buy_id"]); ?></td>
                   <td><?php echo ($vo["num"]); ?></td>
                   <td><?php echo ($vo["amount"]); ?></td>
				    <td><?php echo ($vo["buy_total"]); ?></td>
					 <td><?php echo ($vo["buy_price"]); ?></td>
					  <td><?php echo ($vo["block_address"]); ?></td>
					   <td><?php echo ($vo["email"]); ?></td>
					    <td><?php echo ($vo["add_datetime"]); ?></td>
						<td>
						 <?php if($vo['status'] == 1): ?>未完成<?php endif; ?>
						  <?php if($vo["status"] == 2): ?>已完成<?php endif; ?>
						 </td>
						  <td>
						  <?php if($vo["status"] == 2): ?>——<?php endif; ?>
						  <?php if($vo["status"] == 1): ?><a href="<?php echo U('Index/bedit',array('id'=>$vo['buy_id']));?>">点击完成</a><?php endif; ?>
						 
						  </td>
                 </tr><?php endforeach; endif; ?>
                 
              </table>
              <div class="page mt10">
                <div class="pagination">
                  <ul>
                 	 <?php echo ($page); ?>
                  </ul>
                </div>
  				 
              </div>
             
        </div>
     </div>
     
     
      

   </div> 
 </body>
 </html>