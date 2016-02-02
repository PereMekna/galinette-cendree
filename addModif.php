<?php
session_start();
if (isset($_POST["idhidden"]) && isset($_POST["modif"])) {
	try {
		$db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
	}
	catch (Exception $e) {
	    die('Erreur : ' . $e->getMessage());
	}

	$req = $db->prepare('INSERT INTO descriptions(TEXTE, N_TICKET, DATE, AVANCEMENT, ID_USER) VALUES(:texte, :n_ticket, :date, :avancement, :login)');
	$req->execute(array(
					'texte' => strip_tags($_POST["modif"]),
					'n_ticket' => $_POST["idhidden"],
					'date' => date("Y-m-d H:i:s"),
					'avancement' => $_POST["avancement"],
					'login' => $_SESSION['login']
					));

	$req = $db->prepare('UPDATE tickets SET AVANCEMENT = :avancement WHERE ID = :id');
	$req->execute(array(
					'avancement' => $_POST["avancement"],
					'id' => $_POST["idhidden"]
					));
	header('Location: ./showTicket.php?id='.$_POST["idhidden"]);
	exit();
}
else {
	header('Location: ./index.php');
	exit();
}
?>