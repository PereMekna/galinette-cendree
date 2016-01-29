<?php
session_start();
try {
	$db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$req = $db->prepare('INSERT INTO descriptions(TEXTE, N_TICKET, DATE, AVANCEMENT, ID_USER) VALUES(:texte, :n_ticket, :date, :avancement, :login)');
$req->execute(array(
				'texte' => $_POST["modif"],
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

?>