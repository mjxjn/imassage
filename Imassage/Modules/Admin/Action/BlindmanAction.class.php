<?php
/**
* 
*/
class BlindmanAction extends CommonAction
{
	public function index()
	{
		$Blindman = D('Blindman');
		import('ORG.Util.Page');// 导入分页类
		$count      = $Blindman->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		 // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Blindman->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	public function add()
	{
		if ($_POST) {
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->saveRule = 'uniqid';
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Imassage/Uploads/'.date('Ymd').'/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				echo "<script>alert(\"".$upload->getErrorMsg()."\"); history.back();</script>";
			 	exit();
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			$Blindman = D("Blindman"); // 实例化Product对象
			 if (!$Blindman->create()){
			    // 如果创建失败 表示验证没有通过 输出错误提示信息
			    echo "<script>alert(\"".$Blindman->getError()."\"); history.back();</script>";
			 	exit();
			 }else{
			    // 验证通过 可以进行其他数据操作
			    $Blindman->img = $info[0]['savepath'].$info[0]['savename']; // 保存上传的照片根据需要自行组装
			    $Blindman->add();
			    echo "<script>alert(\"添加成功\"); </script>";
			 }
		}
		$this->display();
	}

	public function edit()
	{
		if ($_POST) {
			if(!empty($_FILES['newimg']['name'])){  
	            import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->saveRule = 'uniqid';
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  './Imassage/Uploads/'.date('Ymd').'/';// 设置附件上传目录
				if(!$upload->upload()) {// 上传错误提示错误信息
					echo "<script>alert(\"".$upload->getErrorMsg()."\"); history.back();</script>";
				 	exit();
				}else{// 上传成功 获取上传文件信息
					$info =  $upload->getUploadFileInfo();
				}
	        }
	        $Blindman = D("Blindman"); // 实例化Product对象
			 if (!$Blindman->create()){
			    // 如果创建失败 表示验证没有通过 输出错误提示信息
			    echo "<script>alert(\"".$Blindman->getError()."\"); history.back();</script>";
			 	exit();
			 }else{
			    // 验证通过 可以进行其他数据操作
			    if (!empty($_FILES['newimg']['name'])) {
			    	$Blindman->img = $info[0]['savepath'].$info[0]['savename']; // 保存上传的照片根据需要自行组装
			    }
			    $Blindman->save();
			    echo "<script>alert(\"修改成功\"); </script>";
			}
		}

		$Blindman = M('Blindman');
		$id = I('id');
		$data['id'] = $id;
		$info = $Blindman->where($data)->find();
		if (!empty($info)) {
			
			$this->assign('info',$info);
			$this->display();
		}else{
			$this->error('数据为空！');
		}
	}

	public function view()
	{
		if($_POST){
			$products = I('products');
			$id = I('id');
			$Product = M('Product');
			foreach ($products as $key => $value) {
				
				$pinfo = $Product->field('title')->where('id='.$value)->find();
				$array[$key]['pid'] = $value;
				$array[$key]['title'] = $pinfo['title'];

			}
			
			$data['products'] = json_encode($array);
			$Blindman = M('Blindman');
			if($Blindman->where('id='.$id)->save($data)){
				echo "<script>alert(\"修改成功\"); </script>";
			}else{
				echo "<script>alert(\"修改失败\"); history.back();</script>";
			 	exit();
			}
		}
		$Blindman = M('Blindman');
		$id = I('id');
		$data['id'] = $id;
		$info = $Blindman->field('name,products')->where($data)->find();
		if (empty($info)) {
			$this->error('数据报错');
		}else{
			$products = json_decode($info['products'],true);
			$this->assign('name',$info['name']);
			$this->assign('products',$products);
			foreach ($products as $key => $value) {
				$ids[] = $value['pid'];
			}
			$Product = M('Product');
			if (empty($ids)) {
				$plist = $Product->field('id, title')->select();
			}else{
				$map['id']  = array('not in',$ids);
				$plist = $Product->field('id, title')->where($map)->select();
			}
			$this->assign('plist',$plist);
		}
		$this->assign('id',$id);
		$this->display();
	}

	public function del()
	{
		$id = I('id');
		$data['id'] = $id;
		$Blindman = M('Blindman');
		if($Blindman->where($data)->delete())
		{
			$this->success('删除成功！',U('Blindman/index'));
		}else{
			$this->error('删除失败！');
		}
	}
}
?>