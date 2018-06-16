<?php

require('storage.php');
require('../useful.php');

class FornecedorStorage extends Storage {

	public $table = 'fornecedor';
	public $orderby = 'nome, cidade';

}

$cs = new FornecedorStorage();

?>