<?php
namespace Admin\Controller;
use Admin\Common\CommonController;
class IndexController extends CommonController {
    public function index(){
     $this->display();
    }
    
    
    //转账银行列表
    public function banklist(){    
	    $count = M('bank')->count();
	    $page =  new  \Think\Page($count,20);
	    $page->setConfig('first','首页');
	    $page->setConfig('prev','上一页');
	    $page->setConfig('next','下一页');
	    $page->setConfig('last','尾页');
	    $show = $page->show();
	    $db=M('bank')->limit($page->firstRow,$page->listRows)->select();
	    $this->assign('list',$db);
	    $this->assign('page',$show);
	    $this->display();
    }
    //添加转账银行view
    public function bankview(){
    	 $this->display();
    }
    //添加转账银行
    public function bankadd(){
    
    	if($_POST['name'] && $_POST['enname']){
    		$data['bank_name'] = $_POST['name'];
    		$data['bank_en'] = $_POST['enname'];
    		
    		$db = M('bank')->add($data);
    		if($db){
    			$this->success('添加成功','banklist');
    		}else{
    			$this->error('操作失败');
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
	
	//买家列表
	 public function buy(){
    
	    $count = M('buy')->count();
	    $page =  new  \Think\Page($count,20);
	    $page->setConfig('first','首页');
	    $page->setConfig('prev','上一页');
	    $page->setConfig('next','下一页');
	    $page->setConfig('last','尾页');
	    $show = $page->show();
	    $db=M('buy')->order('add_time desc')->limit($page->firstRow,$page->listRows)->select();
	    $this->assign('list',$db);
	    $this->assign('page',$show);
	    $this->display();
    }
	
	//完成购买的操作
	public function bedit(){
		if($_GET['id']){
			
			$where['buy_id'] = intval($_GET['id']);
			
			$data['status'] = 2;
			
			$db=M('buy')->where($where)->save($data);
			if($db){
				
				$list=M('buy')->where($where)->find();
				$email=$list['email'];
				$content = "BEBTC订单成功通知<br/>尊敬的用户，您好：<br/>您的订单已被受理，您购买的".$list['amount']."个比特币已发送至您的地址".$list['block_address'].",请注意查收。<br/>感谢您使用BEBTC服务";  //邮件内容
	    		if(SendMail($email,$content)){
					$this->success('通知成功');
					}else{
					$this->error('通知失败，请人工通知');
				}
				
			}else{
				$this->error('操作失败');
			}
			
		}else{
		   $this->error('操作错误');
		}
	}
	
	//卖家列表
	 public function sale(){
    	    $count = M('sale')->count();
	    $page =  new  \Think\Page($count,20);
	    $page->setConfig('first','首页');
	    $page->setConfig('prev','上一页');
	    $page->setConfig('next','下一页');
	    $page->setConfig('last','尾页');
	    $show = $page->show();
	   $db=M('sale a')
	   ->join('LEFT JOIN bit_bank b on b.id=a.bank_id')
	   ->join('LEFT JOIN bit_region c on c.id=a.bank_province')
	   ->join('LEFT JOIN bit_region d on d.id=a.bank_city')
	   ->field('bank_add,c.name as pname,d.name as cname,a.id as aid,num,amount,sale_total,sale_price,sale_name,bank_name,bank_account,email,wallet,add_datetime,status')
	   ->order('add_time desc')
	   ->limit($page->firstRow,$page->listRows)
	  
	   ->select();
	    $this->assign('list',$db);
	    $this->assign('page',$show);
	    $this->display();
    }
		//完成卖的操作
	public function sedit(){
		if($_GET['id']){
			
			$where['id'] = intval($_GET['id']);
			
			$data['status'] = 2;
			
			$db=M('sale')->where($where)->save($data);
			if($db){
				$list=M('sale')->where($where)->find();
				$where2['id']=$list['bank_id'];
				$ls = M('bank')->where($where2)->find();
				$email=$list['email'];
				$content = "BEBTC订单成功通知<br/>尊敬的用户，您好：<br/>您的订单已被受理，您卖出的".$list['amount']."个比特币
所得人民币(".$list['sale_total']."元)已汇至您的".$ls['bank_name']."(".$list['bank_account']."),请注意查收。<br/>感谢您使用BEBTC服务";  //邮件内容
	    		SendMail($email,$content);
				$this->success('修改成功');
				
			}else{
				$this->error('操作失败');
			}
			
		}else{
		$this->error('操作错误');
		}
	}
    
}