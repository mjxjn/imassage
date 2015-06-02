<?php
/**
* 
*/
class CommentAction extends CommonAction
{
	
	function index()
	{
		$Model = M('Comment');
		import('ORG.Util.Page');// 导入分页类
		$count      = $Model->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		$list = $Model->table('Comment c')->join('User u on u.id = c.uid')->join('Blindman b on b.id = c.bid')->field('c.*, u.name as username, b.name as blindman')->order('c.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	public function add()
	{
		if ($_POST) {
			$Comment = D("Comment"); // 实例化Product对象
			 if (!$Comment->create()){
			    // 如果创建失败 表示验证没有通过 输出错误提示信息
			    echo "<script>alert(\"".$Comment->getError()."\"); history.back();</script>";
			 }else{
			 	$Comment->add();
			 	echo "<script>alert(\"添加成功\"); </script>";
			 }
			exit();
		}
		$Product = M('Product');
		$plist = $Product->field('id,title')->order('id desc')->select();
		$this->assign('plist',$plist);
		$this->display();
	}

	public function edit()
	{
		if ($_POST) {
			$reply = I('reply');
			$isshow = I('isshow');
			$id = I('id');
			$data['reply'] = $reply;
			$data['isshow'] = $isshow;
			$Model = M('Comment');
			if ($Model->where('id='.$id)->save($data)) {
				$info = $Model->field('pid')->where('id='.$id)->find();
				if (!empty($info)) {
					$Product = M('Product');
					$map['commentid'] = $id;
					$Product->where('id='.$info['pid'])->save($map);
				}
				$this->success('回复评论成功');
			}else{
				$this->error('回复评论失败');
			}
			exit();
		}
		$id = I('id');
		$data['c.id'] = $id;
		$Model = M('Comment');
		$info = $Model->table('Comment c')->join('User u on u.id = c.uid')->join('Blindman b on b.id = c.bid')->field('c.*, u.name as username, b.name as blindman')->where($data)->find();
		if (empty($info)) {
			$this->error('数据错误');
		}
		$this->assign('info',$info);
		$this->display();
	}

	public function del()
	{
		$id = I('id');
		$data['id'] = $id;
		$Model = M('Comment');
		if($Model->where($data)->delete())
		{
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
}
?>