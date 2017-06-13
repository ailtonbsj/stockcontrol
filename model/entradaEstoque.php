<?php

require('estoque.php');
require('../useful.php');

class EntradaEstoqueStorage extends EstoqueStorage {

	public $table = 'entrada';
	public $orderby = 'data';

	public function select(){
		$sql = "SELECT entrada.id,entrada.data,categoria.nome AS categoria,produto.nome AS produto,fornecedor.nome AS fornecedor, quantidade, obs FROM entrada,produto,categoria,fornecedor WHERE entrada.categoria = categoria.id AND entrada.produto = produto.id AND entrada.fornecedor = fornecedor.id";
			parent::selectPretty($sql);
	}

	public function insert($array){
		$ne = json_decode($array);
		$ne->fornecedor = $ne->select1;
		unset($ne->select1);
		$array = json_encode($ne);
		$id = $ne->produto;
		$quantidade = $ne->quantidade;
		$p = $this->selectProdutoById($id);
		$atual = $p->estoque_atual;
		$this->updateQuantidadeProdutoById($id, $atual+$quantidade);
		parent::insert($array);
	}

	public function delete($id){
		$q = $this->selectById($id, $hasReturn = true);
		$quantidade = $q->quantidade;
		$p = $this->selectProdutoById($q->produto);
		$idProd = $p->id;
		$atual = $p->estoque_atual;
		if(($atual-$quantidade) >= 0){
			$this->updateQuantidadeProdutoById($idProd, $atual-$quantidade);
			parent::delete($id);	
		} else echo 'error';
	}

}

$cs = new EntradaEstoqueStorage();

?>