<?php
namespace Admin\Common;

use Think\Controller;
class CommonController extends Controller{
	/*
	 * think里面的自动运行方法
	 */
	public function _initialize(){
	
		if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])){
			
		}else{
			$this->redirect('Login/index');
		}	
	
	}
	
	
	
}