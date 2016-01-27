<?php
try {
	$db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$req = $db->prepare('INSERT INTO descriptions(TEXTE, N_TICKET, DATE, AVANCEMENT) VALUES(:texte, :n_ticket, :date, :avancement)');
$req->execute(array(
				'texte' => $_POST["modif"],
				'n_ticket' => $_POST["idhidden"],
				'date' => date("Y-m-d H:i:s"),
				'avancement' => $_POST["avancement"]
				));

$req = $db->prepare('UPDATE tickets SET AVANCEMENT = :avancement WHERE ID = :id');
$req->execute(array(
				'avancement' => $_POST["avancement"],
				'id' => $_POST["idhidden"]
				));
header('Location: http://127.0.0.1/i-tech/showTicket.php?id='.$_POST["idhidden"]);
exit();

?>