<?php
/**
* 
*/
class CommentModel extends Model
{
	
	protected $_validate = array(
	    array('name','require','评论人昵称必须'),
	    array('pid','require','评论服务项目必须！'),
	    array('content','require','评论内容必须！'),
	    
	    array('isshow',array(1,2),'是否显示的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
	 );

	protected $_auto = array (
		array('addtime','getTime',3,'function'),
	);
}
?>