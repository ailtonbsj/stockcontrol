<?php

require('storage.php');

class Authenticator extends Storage {

	public $table = 'users';

	public function insert($postArray){}
	public function update($postId, $postArray){}
	public function delete($id){}
	public function selectById($id, $hasReturn = false){}
	public function selectPretty($sql = NULL, $array = NULL, $hasReturn = false){}
	public function select(){}

	public function auth(){
		global $postUser, $postPass;

		$sql = "SELECT * FROM {$this->table} WHERE user = :user AND pass = :pass";
		$stm = $this->conn->prepare($sql);
		$stm->execute(array('user' => $postUser, 'pass' => $postPass));
		$row = $stm->fetchObject();
		if(isset($row->user)){
			if(($row->user == $postUser) && ($row->pass == $postPass)){
				session_start();
				$_SESSION['user'] = $row->user;
				echo "success";
			} else {
				$_SESSION = array();
				session_destroy();
				echo "error";
			}
		} else {
			$_SESSION = array();
			session_destroy();
			echo "error";
		}
	}

	public static function hasAuthority(){
		session_start();
		if(isset($_SESSION['user'])) return true;
	}
}

?>