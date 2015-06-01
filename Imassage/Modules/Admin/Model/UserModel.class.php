<?php
/**
* 
*/
class UserModel extends Model
{
	
	protected $_validate = array(
	    array('name','require','用户名必须！'), //默认情况下用正则进行验证
	    array('phone','require','手机号必须！'),
	    
	    array('sex',array(1,2),'按摩性别的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
	 );
	protected $_auto = array (
		array('money','decPrc',3,'function'),
	);
	
}
?>