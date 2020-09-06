<?php

require('../useful.php');
include_once('authenticator.php');

try {
	$auth = new Authenticator($queryPattern = false);
	$auth->auth();
} catch (Exception $e) {
	echo $e->getMessage();
}

?>