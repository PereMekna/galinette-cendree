<?php
session_start();
	require_once('dbConn.php');

	$req = $db->prepare('UPDATE content SET CONTENT = :content WHERE ID = :id');
	$req->execute(array(
					'content' => $_POST["content"],
					'id' => $_POST["id"]
					));
?>