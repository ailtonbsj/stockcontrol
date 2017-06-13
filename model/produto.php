<?php

require('storage.php');
require('../useful.php');

class ProdutoStorage extends Storage {

	public $table = 'produto';
	public $orderby = 'categoria, nome';

	public function selectPretty($sql = NULL, $array = NULL, $hasReturn = false){
		$sql = "SELECT produto.id, categoria.nome AS categoria, produto.nome, produto.estoque_minimo, produto.estoque_atual FROM produto,categoria WHERE produto.categoria = categoria.id";
		parent::selectPretty($sql);
	}

	public function selectByKey($key, $lim = 0){
		$sql = "SELECT * FROM {$this->table} WHERE nome LIKE '%$key%' ORDER BY nome ASC";
		if($lim > 0) $sql .= "  LIMIT 0,$lim";
		$stm = $this->conn->prepare($sql);
		$stm->execute();

		$listagem = array();
		while($row = $stm->fetchObject()){
			array_push($listagem, $row);
		}
		echo json_encode($listagem);
	}

	public function __construct(){
		global $postSelect, $postSelectByKey, $postKey, $postLim;
		if(isset($postSelect)){
			parent::__construct($queryPattern = false);
			$this->selectPretty();
		} elseif(isset($postSelectByKey)){
			parent::__construct($queryPattern = false);
			$this->selectByKey($postKey, $postLim);
		} else {
			parent::__construct();
		}
		
	}

}

$cs = new ProdutoStorage();

?>