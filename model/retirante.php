<?php

require('storage.php');
require('../useful.php');

class RetiranteStorage extends Storage {

	public $table = 'retirante';
	public $orderby = 'nome, empresa';

}

$cs = new RetiranteStorage();

?>