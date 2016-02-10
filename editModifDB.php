<?php
session_start();
if (isset($_POST["modif_hidden"]) && isset($_POST["modif"])) {
	require_once('dbConn.php');

	$req = $db->prepare('UPDATE descriptions SET TEXTE = :texte WHERE ID = :id');
	$req->execute(array(
					'texte' => $_POST["modif"],
					'id' => $_POST["modif_hidden"]
					));
	header('Location: ./showTicket.php?id='.$_POST["ticket_hidden"]);
	exit();
}
else {
	header('Location: ./index.php');
	exit();
}
?>