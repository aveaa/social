<?php
$pz0 = "***"; #конфедициальные данные удалены
$logz = "***";
$reqz = "mysql:host=***;dbname=***;charset=utf8";
$dbh1 = new PDO($reqz, $logz, $pz0);
$_GET['id'] = htmlentities($_GET['id'],ENT_QUOTES);
$_GET['id'] = str_replace(array("\r\n", "\r", "\n", "<", ">"), '<br>', $_GET['id']);
?>