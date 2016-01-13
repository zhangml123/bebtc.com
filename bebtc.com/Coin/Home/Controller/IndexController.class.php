<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$where['status']=2;
    	$slist = M('sale')->where($where)->field('bsid,amount,add_date,add_time,email')->order('add_time desc')->limit(5)->select();
    	$blist = M('buy')->where($where)->field('bsid,amount,add_date,add_time,email')->order('add_time desc')->limit(5)->select();
    	$cards = array_merge($slist, $blist);
    //	$person = my_sort($person,'name',SORT_ASC,SORT_STRING);
    	$art = my_sort($cards,'add_time'); //按照add_time字段排序降序
    	$this->assign('art',$art);
    $this->display();  
    }
	public function wenti(){
		$this->display();
	}
	
	
}