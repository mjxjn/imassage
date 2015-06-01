<?php
class AdminModel extends Model{
	public function boolLogin($name,$password){
		$data['name'] = $name;
		$data['password'] = $password;
		if($info = $this->where($data)->find()){
			return $info['id'];
		}else{
			return false;
		}
	}

	public function getInfo($id){
		$array['id'] = $id;
		return $this->where($array)->find();
	}

	public function changedPassword($oldpwd,$newpwd)
	{
		$data['id'] = session(C('USER_AUTH_KEY'));
		$data['password'] = md5($oldpwd);
		if ($this->where($data)->find()) {
			$data['password'] = md5($newpwd);
			if ($this->save($data)) {
				return true;
			}
			return false;
		}else{
			return false;
		}
	}
}
?>