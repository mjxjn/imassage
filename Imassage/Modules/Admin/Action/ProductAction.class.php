<?php
/**
* 
*/
class ProductAction extends CommonAction
{
	public function index()
	{
		$Product = D('Product');
		import('ORG.Util.Page');// 导入分页类
		$count      = $Product->count();// 查询满足要求的总记录数
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		 // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Product->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	
	public function add()
	{
		if ($_POST) {
			$content = I('content','');
			if( empty($content) ){
				echo "<script>alert(\"服务内容不能为空！\"); history.back();</script>";
				exit();
			}
			
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

			 $Product = D("Product"); // 实例化Product对象
			 if (!$Product->create()){
			    // 如果创建失败 表示验证没有通过 输出错误提示信息
			    echo "<script>alert(\"".$Product->getError()."\"); history.back();</script>";
			 	exit();
			 }else{
			    // 验证通过 可以进行其他数据操作
			    $Product->img = $info[0]['savepath'].$info[0]['savename']; // 保存上传的照片根据需要自行组装
			    $pid = $Product->add();
			    if (!empty($pid)) {
			    	$Package = M('Package');
			    	$title1 = I('title0');
			    	$price1 = I('price0');
			    	$title2 = I('title1');
			    	$price2 = I('price1');
			    	$title3 = I('title2');
			    	$price3 = I('price2');
			    	$Pdata['pid'] = $pid;
			    	if ($title1 != '' && $price1 != '') {
			    		$Pdata['price'] = decPrc($price1);
			    		$Pdata['title'] = $title1;
			    		$Package->add($Pdata);
			    	}
			    	if ($title2 != '' && $price2 != '') {
			    		$Pdata['price'] = decPrc($price2);
			    		$Pdata['title'] = $title2;
			    		$Package->add($Pdata);
			    	}
			    	if ($title3 != '' && $price3 != '') {
			    		$Pdata['price'] = decPrc($price3);
			    		$Pdata['title'] = $title3;
			    		$Package->add($Pdata);
			    	}
			    }
			    echo "<script>alert(\"添加成功\"); </script>";
			 	
			 }
		}
		$this->display();
	}

	public function edit()
	{
		if ($_POST) {
			$content = I('content','');
			if( empty($content) ){
				echo "<script>alert(\"服务内容不能为空！\"); history.back();</script>";
				exit();
			}

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
			

			 $Product = D("Product"); // 实例化Product对象
			 if (!$Product->create()){
			    // 如果创建失败 表示验证没有通过 输出错误提示信息
			    echo "<script>alert(\"".$Product->getError()."\"); history.back();</script>";
			 	exit();
			 }else{
			    // 验证通过 可以进行其他数据操作
			    if (!empty($_FILES['newimg']['name'])) {
			    	$Product->img = $info[0]['savepath'].$info[0]['savename']; // 保存上传的照片根据需要自行组装
			    }
			    $pid = I('id');
			    $Product->save();
			    if (!empty($pid)) {
			    	$Package = M('Package');
			    	$id1 = I('id0');
			    	$title1 = I('title0');
			    	$price1 = I('price0');
			    	$id2 = I('id1');
			    	$title2 = I('title1');
			    	$price2 = I('price1');
			    	$id3 = I('id2');
			    	$title3 = I('title2');
			    	$price3 = I('price2');

			    	if ($id1 != '') {
			    		$Pdata['price'] = decPrc($price1);
			    		$Pdata['title'] = $title1;
			    		$Package->where('id='.$id1)->save($Pdata);
			    	}else{
			    		if ($title1 != '' && $price1 != '') {
			    			$Pdata['pid'] = $pid;
				    		$Pdata['price'] = decPrc($price1);
				    		$Pdata['title'] = $title1;
				    		$Package->add($Pdata);
				    	}
			    	}
			    	if ($id2 != '') {
			    		$Pdata['price'] = decPrc($price2);
			    		$Pdata['title'] = $title2;
			    		$Package->where('id='.$id2)->save($Pdata);
			    	}else{
				    	if ($title2 != '' && $price2 != '') {
				    		$Pdata['pid'] = $pid;
				    		$Pdata['price'] = decPrc($price2);
				    		$Pdata['title'] = $title2;
				    		$Package->add($Pdata);
				    	}
				    }
				    if ($id3 != '') {
			    		$Pdata['price'] = decPrc($price3);
			    		$Pdata['title'] = $title3;
			    		$Package->where('id='.$id3)->save($Pdata);
			    	}else{
				    	if ($title3 != '' && $price3 != '') {
				    		$Pdata['pid'] = $pid;
				    		$Pdata['price'] = decPrc($price3);
				    		$Pdata['title'] = $title3;
				    		$Package->add($Pdata);
				    	}
				    }
			    }
			    echo "<script>alert(\"修改成功\"); </script>";
			 	
			 }
		}
		$Product = M('Product');
		$id = I('id');
		$data['id'] = $id;
		$info = $Product->where($data)->find();
		if (!empty($info)) {
			$Package = M('Package');
			$packinfo = $Package->where('pid='.$info['id'])->order('id asc')->select();
			foreach ($packinfo as $key => $value) {
				$this->assign('title'.$key,$value['title']);
				$this->assign('price'.$key,$value['price']);
				$this->assign('id'.$key,$value['id']);
			}
			$this->assign('info',$info);
			$this->display();
		}else{
			$this->error('数据为空！');
		}
	}

	public function del()
	{
		$id = I('id');
		$data['id'] = $id;
		$Product = M('Product');
		if($Product->where($data)->delete())
		{
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
}
?>