<?php
session_start();
	require_once('dbConn.php');

	$req = $db->prepare('UPDATE clients SET TEL = :tel, MAIL = :mail WHERE NUMERO = :id');
	$req->execute(array(
					'tel' => $_POST["telephone"],
					'mail' => $_POST["mail"],
					'id' => $_POST["id"]
					));
?>

