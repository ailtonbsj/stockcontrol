<?php

class Storage {

	protected $myconf = array(
		'host' => 'localhost',
		'name' => 'stockcontrol',
		'user' => 'root',
		'pass' => '',
		'type' => 'my',
	);

	protected $pgconf = array(
		'host' => 'localhost',
		'name' => 'stockcontrol',
		'user' => 'postgres',
		'pass' => 'postgres',
		'type' => 'pg',
	);

	protected $dbconf = null;
	protected $conn;
	public $table = '';
	public $orderby = '';

	private function conectDb() {
		try {
			//Using mysql
			$this->dbconf = $this->myconf;

			if ($this->dbconf['type'] == 'pg') {
				$db = "pgsql:dbname={$this->dbconf['name']};host={$this->dbconf['host']}";
			} else {
				$db = "mysql:host={$this->dbconf['host']};dbname={$this->dbconf['name']};charset=utf8";
			}
			$this->conn = new PDO($db, $this->dbconf['user'], $this->dbconf['pass']);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo $e->getMessage();
			exit();
		}
	}

	public function __construct($queryPattern = true) {
		$this->conectDb();

		global $postArray, $postInsert, $postSelect, $postUpdate, $postSelectById, $postId, $postDelete;
		if ($queryPattern) {
			if (isset($postInsert)) {
				$this->insert($postArray);
			} elseif (isset($postSelect)) {
				$this->select();
			} elseif (isset($postUpdate)) {
				$this->update($postId, $postArray);
			} elseif (isset($postSelectById)) {
				$this->selectById($postId);
			} elseif (isset($postDelete)) {
				$this->delete($postId);
			}
		}
	}

	public function insert($postArray) {
		$labels = '';
		$values = '';
		$arrayItems = json_decode($postArray);
		foreach ($arrayItems as $k => $v) {
			$labels = "$k, $labels";
			$values = ":$k, $values";
		}
		$labels .= 'id';
		if ($this->dbconf['type'] == 'pg') {
			$values .= 'DEFAULT';
		} else {
			$values .= 'NULL';
		}
		$sql = "INSERT INTO {$this->table} ($labels) VALUES ($values)";
		$stm = $this->conn->prepare($sql);
		//echo $stm->debugDumpParams();
		$resp = $stm->execute((array) $arrayItems);
		if ($resp) {
			echo "success";
		} else {
			echo 'erro of insert';
		}
	}

	public function update($postId, $postArray) {
		$arr = (array) $postArray;
		$labels = '';
		$arrayItems = json_decode($postArray);
		foreach ($arrayItems as $k => $v) {
			$labels = "$k = :$k, $labels";
		}
		$lab = substr($labels, 0, -2);
		$sql = "UPDATE {$this->table} SET {$lab} WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$arr = (array) $arrayItems;
		$arr['id'] = $postId;
		$stm->execute($arr);
		echo 'success';
	}

	public function delete($id) {
		try {
			$sql = "DELETE FROM {$this->table} WHERE id = :id";
			$stm = $this->conn->prepare($sql);
			$resp = $stm->execute(array('id' => $id));
			if ($resp) echo "success";
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function selectById($id, $hasReturn = false) {
		$sql = "SELECT * FROM {$this->table} WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$stm->execute(array('id' => $id));

		$row = $stm->fetchObject();
		if ($hasReturn) {
			return $row;
		} else {
			echo json_encode($row);
		}

	}

	public function selectPretty($sql = null, $array = null, $hasReturn = false) {
		if ($this->orderby != '') {
			$sql .= " ORDER BY {$this->orderby} ASC";
		}

		$stm = $this->conn->prepare($sql);
		if (isset($array)) {
			$stm->execute($array);
		} else {
			$stm->execute();
		}

		$categorias = array();
		while ($row = $stm->fetchObject()) {
			array_push($categorias, $row);
		}
		if ($hasReturn) {
			return $categorias;
		} else {
			echo json_encode($categorias);
		}
	}

	public function select() {
		$sql = "SELECT * FROM {$this->table}";
		if ($this->orderby != '') {
			$sql .= " ORDER BY {$this->orderby} ASC";
		}

		$stm = $this->conn->prepare($sql);
		$stm->execute();

		$lista = array();
		while ($row = $stm->fetchObject()) {
			array_push($lista, $row);
		}
		echo json_encode($lista);
	}
}
