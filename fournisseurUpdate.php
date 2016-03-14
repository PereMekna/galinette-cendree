<?php
session_start();
	require_once('dbConn.php');

	$req = $db->prepare('UPDATE content SET CONTENT = :content, USER = :user, DATE_MODIF = :date WHERE ID = :id');
	$req->execute(array(
					'content' => $_POST["content"],
					'user' => $_SESSION["login"],
					'date' => date("Y-m-d H:i:s"),
					'id' => $_POST["id"]
					));
?>