<?php
/**
* 
*/
class CommonAction extends Action
{
	
	public function _initialize()
	{
		Vendor('Weixin.jssdk');
	  	$jssdk = new JSSDK("wxa9ca1852ed68d2b9", "53e9246cac850eeaf793e2cb6c51f1f6");
		$signPackage = $jssdk->GetSignPackage();
		$this->assign('signPackage',$signPackage);
	}
}
?>