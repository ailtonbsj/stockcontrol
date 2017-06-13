<?php

require('storage.php');
require('../useful.php');

class CategoriaStorage extends Storage {

	public $table = 'categoria';
	public $orderby = 'nome';

}

$cs = new CategoriaStorage();

?>