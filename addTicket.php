<?php
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


$req = $db->prepare('INSERT INTO tickets(REF_CLIENT, TYPE_CLIENT, TYPE_INTER, DATE_LIVRAISON, FACTURATION, N_BC, PRIORITE) VALUES(:ref_client, :type_client, :type_inter, :date_livraison, :facturation, :n_bc, :priorite)');
$req->execute(array(
				'ref_client' => $_POST["ref_client"],
				'type_client' => $_POST["typeclient"],
				'type_inter' => $_POST["typeinter"],
				'date_livraison' => $_POST["datepicker"],
				'facturation' => $fac,
				'n_bc' => $_POST["bc"],
				'priorite' => intval($_POST["labpriohidden"])));
$lastID = $db->lastInsertId();

$req = $db->prepare('INSERT INTO descriptions(TEXTE, N_TICKET, DATE) VALUES(:texte, :n_ticket, :date)');
$req->execute(array(
				'texte' => $_POST["description"],
				'n_ticket' => $lastID,
				'date' => date("Y-m-d")
				));
header('Location: http://127.0.0.1/i-tech/showTicket.php?id='.$lastID);
exit();


?>