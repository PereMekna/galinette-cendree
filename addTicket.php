<?php
session_start();
if (isset($_POST["ref_client"]) && isset($_POST["description"])) {
	require_once('dbConn.php');

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
					'texte' => strip_tags($_POST["description"]),
					'n_ticket' => $lastID,
					'date' => date("Y-m-d H:i:s"),
					'avancement' => 'af',
					'login' => $_SESSION['login']
					));

	if ($_POST["typeinter"] == 'sav') {
		$req = $db->prepare('INSERT INTO sav(N_TICKET, MARQUE, MODELE, N_SERIE) VALUES(:n_ticket, :marque, :modele, :n_serie)');
		$req->execute(array(
						'n_ticket' => $lastID,
						'marque' => $_POST['marque'],
						'modele' => $_POST['modele'],
						'n_serie' => $_POST['noserie']));
	}
	if(count($_FILES['files']['name']) > 0) {
		for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
			print_r($file);
		}
	}
	header('Location: ./showTicket.php?id='.$lastID);
	exit();
}
else {
	header('Location: ./index.php');
	exit();
}



?>