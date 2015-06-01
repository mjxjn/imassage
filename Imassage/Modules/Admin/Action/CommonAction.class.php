<?php
class CommonAction extends Action
{
	public function _initialize()
	{
		if (false == session(C ( 'USER_AUTH_KEY' )) ) {
			$this->redirect('Login/index', '', 0, '页面跳转中...');
			exit();
		}
		//今日收入
		$this->assign('today','today');

		//今日订单数

		//主菜单
		$actionName = $this->getActionName();
		if ($actionName == 'Order') {
			$mainmenu = 'order';
		}else if($actionName == 'Weixin'){
			$mainmenu = 'weixin';
		}else if($actionName == 'Product'){
			$mainmenu = 'product';
		}else{
			$mainmenu = 'index';
		}
		$this->assign('mainmenu',$mainmenu);

		//获取今天时间
		$fromnow = date('Y')."-".date('m')."-".date('d')." 00:00:00";
		$tonow = date('Y')."-".date('m')."-".date('d')." 23:59:59";

		$Order = M('Orders');
		$initmap['addtime'] = array('between', strtotime($fromnow).",".strtotime($tonow));
		$todaynum = $Order->where($initmap)->count();
		$todaytotal = $Order->where($initmap)->count('total');

		$this->assign('todaynum',$todaynum);
		$this->assign('todaytotal',incPrc($todaytotal));
	}
}
?>