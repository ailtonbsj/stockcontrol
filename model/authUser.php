<?php

require('../useful.php');
include_once('authenticator.php');

$auth = new Authenticator($queryPattern = false);
$auth->auth();

?>