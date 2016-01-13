<?php
namespace Home\Controller;
use Think\Controller;
class BuyController extends Controller {
    public function index(){
 
    $this->display();  
    }
   //购买最高实时价格
    public function buypice(){
    	
    	//OKCoin 实时价格
	   		 require_once ($_SERVER['DOCUMENT_ROOT']. '/API/OKCoin/OKCoin.php');
		     $API_KEY = "**********";
			 $SECRET_KEY = "**********";
			//OKCoin DEMO 入口
			$client = new \OKCoin(new \OKCoin_ApiKeyAuthentication($API_KEY, $SECRET_KEY));
			//获取OKCoin行情（盘口数据）
			$params = array('symbol' => 'btc_cny');
			$result = $client -> tickerApi($params);
		 
			$array = get_object_vars($result);
			$array1 = get_object_vars($array['ticker']);
			$last = $array1['last']; 
			
		//比特币中国实时价格
		

		//火币网实时价格	
			
			echo json_encode($last);
		 
	 
		    	
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

    
    //异步提交购买订单 
    public function buy(){
    	if(!$_POST){
    		$this->error('操作错误');
    	} 
    	
    	$verfy = $_POST['checkcode'];
    	if(!check_verify($verfy)){
    		echo 1;
    		exit();
    	}

    	if($_POST['buypice']){
    	 $data['buy_price'] = $_POST['buypice'];
    	}else{
    		echo 2;
    	}
    	if($_POST['shuliang']){
    	  $data['amount']=$_POST['shuliang'];
    	}else{
    		echo 3;
    	}
    	if($_POST['total']){
    		$data['buy_total']= $_POST['total'];
    	}else{
    		echo 4;
    	}
    	if($_POST['email']){
    		$data['email']=$_POST['email'];
    	}else{
    		echo 5;
    	}
    	$data['num'] = $this->order_number();
    	$data['block_address']=$_POST['add'];
    	$data['add_date']=date('Y-m-d', time());
    	$data['add_datetime']=date('Y-m-d H:i:s', time());
    	$data['add_time']=time();
    	$data['status']=1;
    	$data['bsid']=2;
    	
    	$num = $data['num'];
    	$db = M('buy')->add($data);
    	
    	if($db){
    		
    		echo json_encode($num);
    		
    	}else{
    		echo 7;
    	}
    }
    
    /**
     *   生成12位绝不重复订单号
     */
    public function order_number(){
    	static $ORDERSN=array();                                       //静态变量
    	$ors=date('ymd').substr(time(),-2).substr(microtime(),5,2);     //生成10位数字基本号
    	if (isset($ORDERSN[$ors])) {                                    //判断是否有基本订单号
    		$ORDERSN[$ors]++;                                           //如果存在,将值自增1
    	}else{
    		$ORDERSN[$ors]=1;
    	}
    	
    	return $ors.str_pad($ORDERSN[$ors],2,'0',STR_PAD_LEFT);     //链接字符串
    }

    //提交订单发送-发送邮件
    public function buyemail(){
    //	var_dump($_GET);
 			if(!$_GET['id']){
 				$this->error('操作错误');
 			}else{
 				$where['num']=$_GET['id'];
 			}
 			$db= M('buy')->where($where)->find();
			
		if($db['state']){
			//if (!$_GET['checkcode']){$this->error( '请输入验证码' );} 
			if($_GET['checkcode'] != ""){
				$verfy = $_GET['checkcode'];
				if(!check_verify($verfy)){
					echo 1;
					exit();
				}
			}else{
				echo 2;
				exit();
			}
		}
			
    			$email = $db['email'];
    			$time = $db['add_time'];
    			$timenow = time();
				$amount = $db['amount'];
				$buy_total = $db['buy_total'];
				$block_address = $db['block_address'];
    			$chazhi = ($timenow-$time)/60;
    			$limit_time = C('LIMIT_TIME');//转账时间限制分钟
    			if($limit_time > $chazhi){
	    			//$content = "你好,欢迎使用OKcoin比特币商店的服务，点击下面连接核对订单信息并完成付款<br/><a href=http://".$_SERVER['HTTP_HOST'].U('Buy/buyact',array('mid'=>$db['num'])).">点击核对订单信息</a>";  //邮件内容
	    			// p($content);die();
					
					
					$content ='<div style="width:50%;border: 1px solid #999;">
        <p style="margin: 0px;padding:0px; background: #fafafa;text-align: center;line-height: 40px;font-size: 16px;">BEBTC付款订单通知</p>
        <p style="margin: 0px;padding:0px;font-weight: bold;line-height: 30px; text-indent: 2em;">尊敬的用户，您好：</p>
        <p style="margin: 0px;padding:0px;line-height: 40px; text-indent:4em;">您在BEBTC的订单如下：</p>
        <table style="width:80%;margin: 0px auto;" border="1">
            <tbody>
               <tr><td style="width:25%;line-height: 30px;font-size: 14px;text-align:center;">购买数量</td><td style="line-height: 30px;font-size:14px;">'.$amount.'</td></tr>
               <tr><td style="width:25%;line-height: 30px;font-size: 14px;text-align:center;">成交总价</td><td style="line-height: 30px;font-size:14px;">'.$buy_total.'</td></tr>
               <tr><td style="width:25%;line-height: 30px;font-size: 14px;text-align:center;">收币地址</td><td style="line-height: 30px;font-size:14px;">'.$block_address.'</td></tr>
            </tbody>
        </table>
        <p style="line-height: 40px;    text-indent: 4em;margin: 0px;padding:0px;">请您核实订单后向以下账户汇款：</p>
        <table style="width:80%;margin: 0px auto;" border="1">
            <tbody>
                <tr><td style="width:25%;line-height: 30px;font-size: 14px;text-align:center;">银行帐号</td><td style="line-height: 30px;font-size:14px;">邹王平，兴业银行佛山顺德支行，622908398960515817</td></tr>
                <tr><td style="width:25%;line-height: 30px;font-size: 14px;text-align:center;">支付宝账号</td><td style="line-height: 30px;font-size:14px;">13202932621</td></tr>
            </tbody>
        </table>
        <p style="margin: 0px;padding:0px; line-height:60px;text-align: center;">客服QQ：2807183483;<span style="color:red;">请将转账成功后的截图发送至客服QQ</span>。</p>
        <div style="width:80%;margin:0px auto;">
        <p style="margin: 0px;padding:0px; line-height: 30px;font-weight: bold;font-size: 14px;">重要提示</p>
        <p style="margin: 0px;padding:0px; line-height: 30px;font-size: 12px;">
        1、请您仔细核对个人信息是否正确，若因填写错误造成的损失平台概不负责；<br>
        2、请在十分钟内完成汇款，并将汇单截图上传，否则视为无效订单；<br>
        3、如果订单内容有误，请忽略此订单，从新在网站填写新订单即可。<br>    
        </p>
        </div>
</div>';
					
					
					
					
	    			if(!SendMail($email,$content)){
	    				if(!$db['state']){
						$this->error('发送失败');
						}else{
							echo 4 ;
						}
	    			}else{
	    			 
						$dtat['state']=1;
						M( 'buy' )->where( $where )->save($dtat);
						
						if(!$db['state']){
							$this->assign ('num',$num);
							$this->display ();
						}else{
							echo 5 ;
						}
	    			} //直接调
    			}else{
    				if(!$db['state']){
					$this->error ( '超时，未在规定时间操作，请重新下单', U( 'Buy/index' ) );
					}else{
						echo 3 ;
					}
    			//	$this->error('超时，未在规定时间操作，请重新下单',U('Buy/index'));
    				
    			} 

    
    	 
    }
    
    //订单详细信息
	public function buyact(){
		if($_GET['mid']){
			$where['num'] = $_GET['mid'];
			$db = M('buy')->where($where)->find();
			$this->assign('list',$db);
	    	$this->display();
			
		}else{
			$this->error('非法操作');
		}
		
		
		
	}
    
    
}