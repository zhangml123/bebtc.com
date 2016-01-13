<?php
namespace Admin\Controller;

use Think\Controller;
class LoginController extends Controller{
	
	public function index(){
		$this->display();
	}
	
	/*
	 * 登录后表单处理
	 */
	public function login(){
			if(isset($_POST['userid']) && !empty($_POST['userid']) && isset($_POST['userpwd']) && !empty($_POST['userpwd']) && isset($_POST['logincode']) && !empty($_POST['logincode'])){
					$code = $_POST['logincode'];
					$userid = $_POST['userid'];
					$userpwd = $_POST['userpwd'];
 
					if(!check_verify($code)){
						echo 2;
						exit();
					} 
					   
						$rsa = M("admin")->where("admin_name='$userid'")->count();
						if($rsa==0) {
							//账号不存在
							echo 3;
							exit();
						} else {
							$rsb = M("admin")->where("admin_name='$userid' and admin_pwd='".md5($userpwd)."'")->count();
							if($rsb==0){
								//账号或密码错误
								echo 4;
							}else{
								$_SESSION['userid'] =$userid;
								echo 1;
							}
						}
			
			}else{
				echo '0';
			}

		
	}
	/*
	 * 验证码调用
	 * 
	 */
	public function Verify(){
	
		$Verify = new \Think\Verify();
		$Verify->fontSize = 12;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		$Verify->codeSet = '0123456789';
		$Verify->imageW = 80;
		$Verify->imageH = 40;
		//$Verify->expire = 600;
		$Verify->entry();
	}
	/*
	 * 退出
	 */
	public function loginOut(){
		session_unset();
		session_destroy();
		$this->redirect('Login/index');
	}
 	
	
}