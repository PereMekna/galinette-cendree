<?php
session_start();
if (isset($_POST["ref_client"]) && isset($_POST["description"])) {
	require_once('dbConn.php');
	require_once('inc/functions.php'); 

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

	$nb = $_POST["cnt_mat"];
	if ($nb > 0) {
		$req = $db->prepare('INSERT INTO materiel(DESCRIPTION, N_TICKET, TYPE, MDP, PERIPH) VALUES(:description, :n_ticket, :type, :mdp, :periph)');
		for ($i = 1; $i <= $nb ; $i++) {
			$periph = "";
			$mat_periph = $_POST["mat_periph_".$i];
			foreach ($mat_periph as $single_periph) {
				$periph .= $single_periph.', ';
			}
			$periph = substr($periph,0,strlen($periph)-2);
			$req->execute(array(
							'description' => $_POST['mat_desc_'.$i],
							'n_ticket' => $lastID,
							'type' => $_POST['mat_type_'.$i],
							'mdp' => $_POST['mat_mdp_'.$i],
							'periph' => $periph
							));
		}
	}
	

	if ($_POST["typeinter"] == 'sav') {
		$req = $db->prepare('INSERT INTO sav(N_TICKET, MARQUE, MODELE, N_SERIE) VALUES(:n_ticket, :marque, :modele, :n_serie)');
		$req->execute(array(
						'n_ticket' => $lastID,
						'marque' => $_POST['marque'],
						'modele' => $_POST['modele'],
						'n_serie' => $_POST['noserie']));
		$destinataire = 'dupont.louis4@gmail.com';
		$expediteur = 'sav@itech-informatique.com';
		$objet = "[".$_POST['ref_client']."] ".$_POST['marque'].' '.$_POST['modele'].' '.$_POST['noserie'];
		$message = "<h1>Retour SAV pour ".$_POST['ref_client']."</h1>";
		$message .= "[Référence client : ".$_POST['ref_client']."]<br /><u>Marque :</u> ".$_POST['marque'].'<br /><u>Modèle :</u> '.$_POST['modele'].'<br /><u>N° série :</u> '.$_POST['noserie'];
		$message .= "<br /><br /><u>Description du ticket :</u> <br />".$_POST['description'];
		$message .= "<br /><u>Date de livraison :</u> ".$_POST['datepicker']."<br />";
		if ($nb > 0) {
			for ($i = 1; $i <= $nb ; $i++) {
				$message .= "<br /><u>Matériel ".$i." :</u> ".abbrToFull($_POST['mat_type_'.$i])." (".$_POST['mat_desc_'.$i].")";
			}
		}
		$message .= "<br /><br />Cordialement,<br />Louis Dupont<br />Développeur web super compétent";
		$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
		$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
		$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
		$headers .= 'From: "ITECH gestion SAV"<'.$expediteur.'>'."\n"; // Expediteur
		$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
		mail($destinataire, $objet, $message, $headers);
	}
	if ($_POST['mailrappel'] = 'mail') {
		
	}
	header('Location: ./showTicket.php?id='.$lastID);
	exit();
}
else {
	header('Location: ./index.php');
	exit();
}



?>