<?php

require('storage.php');

class EstoqueStorage extends Storage {

	public function selectProdutoById($id, $hasReturn = true){
		$sql = "SELECT * FROM produto WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$stm->execute(array('id' => $id));

		$row = $stm->fetchObject();
		if($hasReturn) return $row;
		else echo json_encode($row);
	}

	public function updateQuantidadeProdutoById($id, $quant){
		$sql = "UPDATE produto SET estoque_atual = :quant WHERE id = :id";
		$stm = $this->conn->prepare($sql);
		$stm->execute(array('quant' => $quant, 'id' => $id));
	}
}

?>