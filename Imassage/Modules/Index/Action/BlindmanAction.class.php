<?php
/**
* 
*/
class BlindmanAction extends CommonAction
{
	
	function index()
	{
		$Blindman = M('Blindman');
		$list = $Blindman->order('id')->select();
		$this->assign('list',$list);
		$this->display();
	}
	function info()
	{
		$id = I('id');
		$Blindman = M('Blindman');
		$info = $Blindman->where('id='.$id)->find();
		if(!empty($info['products'])){
			$Product = M("Product");
			$proarr = json_decode($info['products'],true);
			foreach ($proarr as $key => $value) {
				$list[$key] = $Product->where('id='.$value['pid'])->find();
			}
		}
		$Comment = M('Comment');
		$ccount = $Comment->where('bid='.$id)->count();
		$this->assign('ccount',$ccount);
		$this->assign('list',$list);
		$this->assign('info',$info);
		$this->display();
	}
}
?>