<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
class SystemController extends CommonController {
    public function index(){
    $this->display();  
    }
   //编辑系统参数
    public function edit(){
    	//	$config = include './Web/Common/Conf/config.php';
    	//var_dump($config);
    	//合并数组，$_POST数组写入$config重写数据，小写键值转换成大写键值。
    	//	$config = array_merge($config,array_change_key_case($_POST,CASE_UPPER));
    	//	var_dump($config);

    	$file = './Coin/Common/Conf/const.php';
    	$config = array_merge(include $file,array_change_key_case($_POST,CASE_UPPER));
    	//把$config数组变成字符串。
    	$str = "<?php\r\n return " . var_export($config,true) . ";\r\n?>";
    	//   echo $str;
    	if (file_put_contents($file, $str)){
    		//获取当前链接的上一个连接的来源地址 并反回。
    	//	$this->success('修改成功',$_SERVER['HTTP_REFERER']);
		$this->success('修改成功');
    	} else {
    		$this->error('修改失败');
    	}
    }

}