<?php
session_start();
if (isset($_POST["modif_hidden"]) && isset($_POST["modif"])) {
	require_once('dbConn.php');

	$req = $db->prepare('UPDATE descriptions SET TEXTE = :texte, AVANCEMENT = :avancement WHERE ID = :id');
	$req->execute(array(
					'texte' => $_POST["modif"],
					'avancement' => $_POST["avancement"],
					'id' => $_POST["modif_hidden"]
					));
	$req = $db->prepare('UPDATE tickets SET AVANCEMENT = :avancement WHERE ID = :id');
	$req->execute(array(
					'avancement' => $_POST["avancement"],
					'id' => $_POST["ticket_hidden"]
					));
	header('Location: ./showTicket.php?id='.$_POST["ticket_hidden"]);
	exit();
}
else {
	header('Location: ./index.php');
	exit();
}
?>