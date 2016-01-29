<?php
session_start();
try {
	$db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_POST["facturation"] == "fac"){
	$fac = 1;
}
else $fac = 0;

if (!isset($_POST["labpriohidden"])) {
	$priorite = 0;
}
else {
	$priorite = $_POST["labpriohidden"];
}

$req = $db->prepare('INSERT INTO tickets(REF_CLIENT, TYPE_CLIENT, TYPE_INTER, DATE_LIVRAISON, FACTURATION, N_BC, PRIORITE, AVANCEMENT, ID_USER) VALUES(:ref_client, :type_client, :type_inter, :date_livraison, :facturation, :n_bc, :priorite, :avancement, :login)');
$req->execute(array(
				'ref_client' => $_POST["ref_client"],
				'type_client' => $_POST["typeclient"],
				'type_inter' => $_POST["typeinter"],
				'date_livraison' => $_POST["datepicker"],
				'facturation' => $fac,
				'n_bc' => $_POST["bc"],
				'priorite' => intval($priorite),
				'avancement' => 'af',
				'login' => $_SESSION['login']));
$lastID = $db->lastInsertId();

$req = $db->prepare('INSERT INTO descriptions(TEXTE, N_TICKET, DATE, AVANCEMENT, ID_USER) VALUES(:texte, :n_ticket, :date, :avancement, :login)');
$req->execute(array(
				'texte' => $_POST["description"],
				'n_ticket' => $lastID,
				'date' => date("Y-m-d H:i:s"),
				'avancement' => 'af',
				'login' => $_SESSION['login']
				));
header('Location: ./showTicket.php?id='.$lastID);
exit();


?>