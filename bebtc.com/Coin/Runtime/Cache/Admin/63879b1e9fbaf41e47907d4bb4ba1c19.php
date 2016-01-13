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
              <table width="50%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <tr>
                   <th width="30">ID</th>
                   <th width="100">名称</th>
                   <th width="100">EN</th>
                   
                </tr>
                
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr class="tr">
                   <td class="td_center"><?php echo ($vo["id"]); ?></td>
                   <td><?php echo ($vo["bank_name"]); ?></td>
                   <td><?php echo ($vo["bank_en"]); ?></td>
                 </tr><?php endforeach; endif; ?>
                 
              </table>
              <div class="page mt10">
                <div class="pagination">
                  <ul>
                 	 <?php echo ($page); ?>
                  </ul>
                </div>
  				<a href="<?php echo U('Index/bankview');?>" class="ext_btn"><span class="add"></span>添加银行</a>
              </div>
             
        </div>
     </div>
     
     
      

   </div> 
 </body>
 </html>