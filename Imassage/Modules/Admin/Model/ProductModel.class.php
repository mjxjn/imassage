<?php
class ProductModel extends Model{

	protected $_validate = array(
	    array('title','require','服务名称必须！'), //默认情况下用正则进行验证
	    array('price','require','最低价格必须！'),
	    array('timelong','require','服务时间必须！'),
	    array('minpeople','require','起订人数必须！'),
	    array('content','require','服务内容必须！'),
	    
	    array('typeid',array(1,2),'按摩分类值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
	   
	 );
	protected $_auto = array (
		array('price','decPrc',3,'function'),
	);
	
}