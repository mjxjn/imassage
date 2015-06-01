<?php
/**
* 
*/
class BlindmanModel extends Model
{
	protected $_validate = array(
	    array('name','require','按摩师名必须！'), //默认情况下用正则进行验证
	    array('typeid','require','按摩师级别必须！'),
	    array('timelong','require','服务时间必须！'),
	    array('content','require','按摩师经验必须！'),
	    
	    array('sex',array(1,2),'按摩性别的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
	 );
}
?>