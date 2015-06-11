<?php
Class IndexAction extends CommonAction{
  
  public function index(){
  	$Product = M('Product');
  	$list = $Product->order('id')->select();
  	$this->assign('list',$list);
    $this->display();
  }

}
?>