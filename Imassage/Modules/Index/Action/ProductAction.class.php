<?php
/**
* 
*/
class ProductAction extends CommonAction
{
	
	function index()
	{
		$uid = I('uid');
		$bid = I('bid');
		$id = I('id');
		$Product = M('Product');
		$info = $Product->where('id='.$id)->find();
		if(empty($bid)){
			$Package = M("Package");
			$list = $Package->where('pid='.$id)->select();
			$pricearr = '[0,';
			foreach ($list as $key => $value) {
				$pricearr .= incPrc($value['price']).',';
			}
			$pricearr = substr($pricearr, 0, -1);
			$pricearr .= ']';
		}else{
			$Blindman = M('Blindman');
			$blindinfo = $Blindman->where('id='.$bid)->find();
			$Package = M("Package");
			$packinfo = $Package->where('pid='.$id.' and title="'.$blindinfo['level'].'"')->find();
			$pricearr = '[0,'.incPrc($packinfo['price']).']';
			$info['blindman'] = $blindinfo['name'];
		}
		$this->assign('info',$info);
		$this->assign('bid',$bid);
		$this->assign('uid',$uid);
		$this->assign('pricearr',$pricearr);
		$this->assign('list',$list);
		$this->display();
	}
}
?>