<?php

class Storage {

	protected $dbhost = 'localhost';
	protected $dbname = 'stockcontrol';
	protected $dbuser = 'root';
	protected $dbpass = '';
	protected $conn;
	public $table = '';
	public $orderby = '';

	private function conectDb(){
		try {
			$db = "mysql:host={$this->dbhost};dbname={$this->dbname};charset=utf8";
			$this->conn = new PDO($db, $this->dbuser, $this->dbpass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {
			echo 'erro';
			exit();
		}
	}

	public function __construct($queryPattern = true){
		$this->conectDb();

		global $postArray, $postInsert, $postSelect, $postUpdate, $postSelectById, $postId, $postDelete;
		if($queryPattern){
			if(isset($postInsert)){
				$this->insert($postArray);
			} elseif(isset($postSelect)){
				$this->select();
			} elseif(isset($postUpdate)){
				$this->update($postId, $postArray);
			} elseif(isset($postSelectById)){
				$this->selectById($postId);
			} elseif(isset($postDelete)){
				$this->delete($postId);
			}
		}
	}

	public function insert($postArray){
		$labels = '';
		$values = '';
		$arrayItems = json_decode($postArray);
		foreach ($arrayItems as $k => $v) {
			$labels = "$k, $labels";
			$values = ":$k, $values";
		}
		$labels .= 'id';
		$values .= 'NULL';
		$sql = "INSERT INTO {$this->table} ($labels) VALUES ($values)";
		$stm = $this->conn->prepare($sql);
		$resp = $stm->execute((array) $arrayItems);
		if($resp){
			echo "success";
		} else {
			echo 'erro';
		}
	}

	public function update($postId, $postArray){
		$arr = (array) $postArray;
		$labels = '';
		$arrayItems = json_decode($postArray);
		foreach ($arrayItems as $k => $v) {
			$labels = "$k = :$k, $labels";
		}
		$lab = substr($labels,0,-2);
		$sql = "UPDATE {$this->table} SET {$lab} WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$arr = (array) $arrayItems;
		$arr['id'] = $postId;
		$stm->execute($arr);
		echo 'success';
	}

	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$resp = $stm->execute(array('id' => $id));
		if($resp){
			echo "success";
		} else {
			echo 'erro';
		}
	}

	public function selectById($id, $hasReturn = false){
		$sql = "SELECT * FROM {$this->table} WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$stm->execute(array('id' => $id));

		$row = $stm->fetchObject();
		if($hasReturn) return $row;
		else echo json_encode($row);
	}

	public function selectPretty($sql = NULL, $array = NULL, $hasReturn = false){
		if($this->orderby != '') $sql .= " ORDER BY {$this->orderby} ASC";
		$stm = $this->conn->prepare($sql);
		if(isset($array)){
			$stm->execute($array);
		} else {
			$stm->execute();
		}

		$categorias = array();
		while($row = $stm->fetchObject()){
			array_push($categorias, $row);
		}
		if($hasReturn){
			return $categorias;
		} else {
			echo json_encode($categorias);
		}
	}

	public function select(){
		$sql = "SELECT * FROM {$this->table}";
		if($this->orderby != '') $sql .= " ORDER BY {$this->orderby} ASC";
		$stm = $this->conn->prepare($sql);
		$stm->execute();

		$lista = array();
		while($row = $stm->fetchObject()){
			array_push($lista, $row);
		}
		echo json_encode($lista);
	}
}

?>
