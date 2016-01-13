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
					  <th width="100">姓名</th>
					   <th width="100">开户行</th>
					   <th width="100">开户省</th>
					   <th width="100">开户城市</th>
					   <th width="100">开户地址</th>
					    <th width="100">帐号</th>
					   <th width="100">邮箱</th>
					    <th width="100">平台钱包</th>
					   <th width="100">时间</th>
					    <th width="100">状态</th>
						 <th width="100">操作</th>
	 
                   
                </tr>
                
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr">
                   <td class="td_center"><?php echo ($vo["aid"]); ?></td>
                   <td><?php echo ($vo["num"]); ?></td>
                   <td><?php echo ($vo["amount"]); ?></td>
				    <td><?php echo ($vo["sale_total"]); ?></td>
					 <td><?php echo ($vo["sale_price"]); ?></td>
					 
					  <td><?php echo ($vo["sale_name"]); ?></td>
					   <td><?php echo ($vo["bank_name"]); ?></td>
					    <td><?php echo ($vo["pname"]); ?></td>
						 <td><?php echo ($vo["cname"]); ?></td>
						  <td><?php echo ($vo["bank_add"]); ?></td>
					    <td><?php echo ($vo["bank_account"]); ?></td>
					   <td><?php echo ($vo["email"]); ?></td>
					   <td><?php echo ($vo["wallet"]); ?></td>
					    <td><?php echo ($vo["add_datetime"]); ?></td>
						 <td>
						 <?php if($vo['status'] == 1): ?>未完成<?php endif; ?>
						  <?php if($vo["status"] == 2): ?>已完成<?php endif; ?>
						 </td>
						  <td>
						  <?php if($vo["status"] == 2): ?>——<?php endif; ?>
						  <?php if($vo["status"] == 1): ?><a href="<?php echo U('Index/sedit',array('id'=>$vo['aid']));?>">点击完成</a><?php endif; ?>
						 
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