<?php
/**
 * 验证码检查
 */
function check_verify($code, $id = ""){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

/*
 * 二位数组按照某一个键值排序
 * */

function my_sort($arrays,$sort_key,$sort_order=SORT_DESC,$sort_type=SORT_NUMERIC ){
	if(is_array($arrays)){
		foreach ($arrays as $array){
			if(is_array($array)){
				$key_arrays[] = $array[$sort_key];
			}else{
				return false;
			}
		}
	}else{
		return false;
	}
	array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
	return $arrays;
}

/*
 * 格式化数组
 */
function p($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}
/*
 * 发送邮件
 */
function SendMail($address,$message)
{
	vendor('PHPMailer.class#phpmailer');
	$mail=new PHPMailer();          // 设置PHPMailer使用SMTP服务器发送Email
	$mail->IsSMTP();                // 设置邮件的字符编码，若不指定，则为'UTF-8'
	$mail->IsHTML(true);			 //支持html格式内容
	$mail->CharSet='UTF-8';         // 添加收件人地址，可以多次使用来添加多个收件人
	$mail->AddAddress($address);    // 设置邮件正文
	$mail->Body=$message;           // 设置邮件头的From字段。
	$mail->From=C('MAIL_ADDRESS');  // 设置发件人名
	$mail->FromName=C('MAIL_FORMNAME');  // 设置邮件标题
	$mail->Subject=C('MAIL_TITLE');          // 设置SMTP服务器。
	$mail->Host=C('MAIL_SMTP');     // 设置为"需要验证" ThinkPHP 的C方法读取配置文件
	$mail->SMTPAuth=true;           // 设置用户名和密码。
	$mail->Username=C('MAIL_LOGINNAME');
	$mail->Password=C('MAIL_PASSWORD'); // 发送邮件。
	return($mail->Send());
}



?>