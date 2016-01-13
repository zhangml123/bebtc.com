<?php

namespace Home\Controller;

use Think\Controller;

class SaleController extends Controller{
	public function index(){
		$banklist = M('bank')->select();
		$province = M('region')->where( array('pid'=>1))->select();
		$this->assign('province',$province);
		$this->assign( 'list', $banklist );
		$this->display();
	}
	
	// 卖出最低实时价格
	public function salepice(){
		
		// OKCoin 实时价格
		require_once($_SERVER['DOCUMENT_ROOT'] . '/API/OKCoin/OKCoin.php');
		$API_KEY = "18d95fb4-0cba-4993-b7b1-d48eb993f8cb";
		$SECRET_KEY = "2DF5FBBD3F8937D556581FFAE296467D";
		// OKCoin DEMO 入口
		$client = new \OKCoin( new \OKCoin_ApiKeyAuthentication( $API_KEY, $SECRET_KEY ) );
		// 获取OKCoin行情（盘口数据）
		$params = array(
				'symbol' => 'btc_cny' 
		);
		$result = $client->tickerApi( $params );
		
		$array = get_object_vars( $result );
		$array1 = get_object_vars( $array ['ticker'] );
		$last = $array1['last'];
		
		// 比特币中国实时价格
		
		// 火币网实时价格
		
		echo json_encode( $last );
	}
	
	/*
	 * 验证码调用
	 *
	 */
	public function Verify() {
		$Verify = new \Think\Verify();
		$Verify->fontSize = 12;
		$Verify->length = 4;
		$Verify->useNoise = false;
		$Verify->codeSet = '0123456789';
		$Verify->imageW = 80;
		$Verify->imageH = 40;
		// $Verify->expire = 600;
		$Verify->entry();
	}
	
	// 异步提交购买订单
	public function sale() {
		$verfy = $_POST ['checkcode'];
		if (! check_verify( $verfy )) {
			echo 1;
			exit ();
		}
		
		if ($_POST['salepice'] && $_POST['bank_province'] && $_POST['bank_city'] && $_POST['bank_add'] && $_POST['shuliang'] && $_POST['total'] && $_POST['email'] && $_POST['uname'] && $_POST['bank'] && $_POST['bank_num']) {
			$data['salepice'] = $_POST['salepice'];
			$data['amount'] = $_POST['shuliang'];
			$data['sale_total'] = $_POST['total'];
			$data['email'] = $_POST['email'];
			$data['sale_name'] = $_POST['uname'];
			$data['bank_id'] = $_POST['bank'];
			$data['bank_account'] = $_POST['bank_num'];
			$data['bank_province'] = $_POST['bank_province'];
			$data['bank_city'] = $_POST['bank_city'];
			$data['bank_add'] = $_POST['bank_add'];
			
		} else {
			echo 2;
			exit ();
		}
		$data['num'] = $this->order_number();
		
		$data['add_date'] = date( 'Y-m-d', time() );
		$data['add_datetime'] = date('Y-m-d H:i:s', time());
		$data['add_time'] = time();
		$data['status'] = 1;
		$data['bsid'] = 1;
		
		$num = $data['num'];
		$db = M( 'sale' )->add( $data );
		
		if ($db){
			
			echo json_encode( $num );
		}else{
			echo 3;
		}
	}
	
	/**
	 * 生成12位绝不重复订单号
	 */
	public function order_number() {
		static $ORDERSN = array(); // 静态变量
		$ors = date( 'ymd' ) . substr( time(), - 2 ) . substr( microtime(), 5, 2 ); // 生成10位数字基本号
		if (isset( $ORDERSN[$ors] )){ // 判断是否有基本订单号
			$ORDERSN[$ors] ++; // 如果存在,将值自增1
		} else {
			$ORDERSN[$ors] = 1;
		}
		
		return $ors . str_pad( $ORDERSN[$ors], 2, '0', STR_PAD_LEFT ); // 链接字符串
	}
	
	// 提交订单发送-发送邮件
	public function saleemail() {
		// var_dump($_GET);
		if (!$_GET) {
			$this->error( '操作错误' );
		} else {
			$where['num'] = $_GET['id'];
		}
		$db = M( 'sale' )->where( $where )->find ();
		$email = $db['email'];
		$time = $db['add_time'];
		$num =  $_GET['id'];
		$timenow = time();
		$chazhi = ($timenow - $time) / 60;
		$limit_time = C('LIMIT_TIME'); // 转账时间限制分钟
		$amount=$db['amount'];
		$sale_name =$db['sale_name'];
		$where2['id']=$db['bank_id'];
		$bank_account=$db['bank_account'];
		$bank = M('bank')->where($where2)->find();
		$bank_name = $bank['bank_name']; 

 		if($db['wallet']){
			$wallet_add =$db['wallet'];
		}else{		
		//	$wallet_add = $this->oklink(); //比特钱包dizhi
			$wallet_add ="164tjNB2Ack1dSYYXpb3ZcYgNQL1igo2AT";
			$date['wallet'] = $wallet_add ;
			$db = M('sale')->where( $where )->save($date);
			
		}
   
		
		
		if ($limit_time > $chazhi) {

		//$content = "你好,您的订单是" . $db['num'] ."请将您对应的比特比数量转到我们的比特钱包，地址为：145edZo7adnGMRrzD4ff6WDpo2krs786RX" . $wallet_add ;
	//	$content = "你好,欢迎使用OKcoin比特币商店的服务，点击下面连接核对订单信息<br/><a href=http://".$_SERVER['HTTP_HOST'].U('Sale/Saleact',array('mid'=>$num)).">点击核对订单信息</a>";  //邮件内容
		
		$content ='<div style="width:50%;border: 1px solid #999;">
        <div style="font-size: 14px;">
        <p style="background: #fafafa;text-align: center;line-height: 40px;font-size: 16px;">BEBTC付款订单通知</p>
        <p style="font-weight: bold;line-height: 30px;text-indent: 2em;">尊敬的用户，您好：</p>
        <p style=" line-height: 40px;text-indent: 4em;">您在BEBTC的订单如下：</p>
        <table style="width:80%;margin: 0px auto;" border="1">
            <tbody><tr><td style="width:25%;line-height: 30px;font-size: 14px;text-align:center;">卖出数量</td><td style="line-height: 30px;font-size: 14px;">'.$amount.'个比特币
</td></tr>
            <tr><td class="e_d_a">您的姓名</td><td class="e_d_b">'.$sale_name.'</td></tr>
            <tr><td class="e_d_a">开户行</td><td class="e_d_b">'.$bank_name.'</td></tr>
            <tr><td class="e_d_a">收款账号</td><td class="e_d_b">'.$bank_account.'</td></tr>
        </tbody></table>
        <p style=" line-height: 40px;text-indent: 4em;">请您核实订单后向以下账户汇款：</p>
        <table style="width:80%;margin: 0px auto;" border="1">
            <tbody><tr><td style="width:25%;line-height:30px;font-size:14px;text-align:center;">BTC</td><td  style="line-height: 30px;font-size:14px;">'.$amount.'个比特币
</td></tr>
            <tr><td style="width:25%;line-height:30px;font-size:14px;text-align:center;">平台比特币收款地址</td><td ><img style=" width:200px;margin:0px 30%;" src="http://'.$_SERVER["HTTP_HOST"].'/btcbb.png" modifysize="83%" diffpixels="19px" style="width: 166px; height: 166px;"><br/>164tjNB2Ack1dSYYXpb3ZcYgNQL1igo2AT</td></tr>
        </tbody></table>
        <p style="line-height:60px;text-align: center;">客服QQ：2807183483;<span style="color:red;">请将转账成功后的截图发送至客服QQ</span>。</p> </div>
        <div style="width:80%;margin:0px auto;">
        <p style="line-height: 30px;font-weight: bold;font-size: 14px;">重要提示</p>
        <p style="line-height: 30px;font-size: 12px;">
        1、请您仔细核对个人信息是否正确，若因填写错误造成的损失平台概不负责；<br>
        2、请在十分钟内完成汇款，并将汇单截图上传，否则视为无效订单；<br>
        3、如果订单内容有误，请忽略此订单，从新在网站填写新订单即可。<br>    
        </p>
        </div>
       </div>';
		
		
		
			if (! SendMail ( $email, $content )) {
				$this->error ( '发送失败' );
			} else {
				
				$this->assign ( 'num',$num);
			
				$this->display ();
			} // 直接调
		} else {
			
			$this->error ( '超时，未在规定时间操作，请重新下单', U( 'Sale/index' ) );
		}
	}
	public function oklink(){
	 require_once($_SERVER ['DOCUMENT_ROOT'].'/API/oklink/Oklink.php');
		
		$api_key = '31df3053b63745b9abcf96687e7ef7f2';
		$api_secret = '43f100a4aec54d2fb78578545f645106';
		
			
			// $client = new \OkLink\withApiKey($api_key, $api_secret);
			$client = \Oklink::withApiKey($api_key, $api_secret);
			//$response = $client->listDefaultWallet();
			//var_dump($response);
			//$response = $client->createWallet(array('name'=>"yuu"));
			//$wallet_add = json_decode($response);
			//return $wallet_add;
			

	}

	
	    
    //订单详细信息
	public function Saleact(){
		if($_GET['mid']){
			$where['num'] = $_GET['mid'];
			$db = M('sale')->where($where)->find();
			$where1['id'] = $db['bank_id'];
			$bank_name = M('bank')->where($where1)->find();
			$this->assign('list',$db);
			$this->assign('bank_name',$bank_name);
	    	$this->display();
			
		}else{
			$this->error('非法操作');
		}
		
		
		
	}
	//获取异步数据城市地址
	public function getRegion(){
		$Region=M("region");
		$map['pid']=$_REQUEST["pid"];
		$map['type']=$_REQUEST["type"];
		$list=$Region->where($map)->select();
		echo json_encode($list);
	}
	
}