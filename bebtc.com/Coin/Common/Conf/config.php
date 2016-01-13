<?php
return array(
	//'配置项'=>'配置值'
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'okbtc', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => 'btc123',     // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'bit_', // 数据库表前缀
		'DB_CHARSET'=> 'utf8', // 字符集
		//设置可访问模块，默认模块home和admin能被访问模块,
		'MODULE_ALLOW_LIST'=>array('Home','Admin'),
		//默认模块，可以省去模块名输入。
		'DEFAULT_MODULE'=>'Home',
		//url phpinfo模式
		'URL_MODEL' => '2',
		// 		加载const.php的常量信息
		'LOAD_EXT_CONFIG' => 'const',
		
		// 		在后台php里调用方法为：C('MODE_INSERT')
		// 		模板文件里的调用方法为{:C('MODE_INSERT')} 或者{$Think.config.MODE_INSERT}
		'MAIL_TITLE'=>'币易网',//邮件标题
		'MAIL_ADDRESS'=>'*****', // 邮箱地址
		'MAIL_SMTP'=>'********', // 邮箱SMTP服务器
		'MAIL_LOGINNAME'=>'***********', // 邮箱登录帐号
		'MAIL_PASSWORD'=>'********', // 邮箱密码
		'MAIL_FORMNAME'=>'币易网',//邮件发送人
		'LIMIT_TIME'=>'10',//转账有效时间，单位分钟。
);