<?php

require('estoque.php');
require('../useful.php');

class SaidaEstoqueStorage extends EstoqueStorage {

	public $table = 'saida';
	public $orderby = 'data';

	public function select(){
		$sql = "SELECT saida.id,saida.data,categoria.nome AS categoria,produto.nome AS produto,retirante.nome AS retirante, quantidade, obs FROM saida,produto,categoria,retirante WHERE saida.categoria = categoria.id AND saida.produto = produto.id AND saida.retirante = retirante.id";
			parent::selectPretty($sql);
	}

	public function insert($array){
		$ne = json_decode($array);
		$ne->retirante = $ne->select1;
		unset($ne->select1);
		$array = json_encode($ne);
		$id = $ne->produto;
		$quantidade = $ne->quantidade;
		$p = $this->selectProdutoById($id);
		$atual = $p->estoque_atual;
		if(($atual-$quantidade) >= 0){
			$this->updateQuantidadeProdutoById($id, $atual-$quantidade);
			parent::insert($array);
		} else echo 'error: nao existe no estoque essa quantidade';
	}

	public function delete($id){
		$q = $this->selectById($id, $hasReturn = true);
		$quantidade = $q->quantidade;
		$p = $this->selectProdutoById($q->produto);
		$idProd = $p->id;
		$atual = $p->estoque_atual;
		$this->updateQuantidadeProdutoById($idProd, $atual+$quantidade);
		parent::delete($id);
	}

}

$cs = new SaidaEstoqueStorage();

?>