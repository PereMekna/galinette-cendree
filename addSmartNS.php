<?php
session_start();
if (isset($_POST["ville"]) && isset($_POST["etab"]) && isset($_POST["modele"]) && isset($_POST["clef"]) && isset($_POST["date"]) && isset($_POST["version"])) {
	require_once('dbConn.php');

	$req = $db->prepare('INSERT INTO smart_license(VILLE, ETAB, MODELE, CLEF, DATE, VERSION) VALUES(:ville, :etab, :modele, :clef, :date, :version)');
	$req->execute(array(
					'ville' => $_POST["ville"],
					'etab' => $_POST["etab"],
					'modele' => $_POST["modele"],
					'clef' => $_POST["clef"],
					'date' => $_POST['date'],
					'version' => $_POST["version"]
					));
	$nb = $_POST["cnt_ns"];

	$req = $db->prepare('INSERT INTO smart_sn(S_N, CLEF) VALUES(:s_n, :clef)');
	for ($i = 1; $i <= $nb ; $i++) {
		$req->execute(array(
						's_n' => $_POST["sn".$i],
						'clef' => $_POST["clef"]
						));
	}
	
	header('Location: ./smartLicense.php');
	exit();
}
else {
	header('Location: ./index.php');
	exit();
}
?>