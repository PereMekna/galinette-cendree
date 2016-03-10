<?php
session_start();
if (isset($_POST["ville"]) && isset($_POST["etab"]) && isset($_POST["modele"]) && isset($_POST["date"]) && isset($_POST["version"])) {
	require_once('dbConn.php');

	$req = $db->prepare('UPDATE smart_license SET VILLE = :ville, ETAB = :etab, MODELE = :modele, DATE = :date, VERSION = :version WHERE CLEF = :id');
	$req->execute(array(
					'ville' => $_POST["ville"],
					'etab' => $_POST["etab"],
					'modele' => $_POST["modele"],
					'date' => $_POST['date'],
					'version' => $_POST["version"],
					'id' => $_POST["hiddenclef"]
					));

	$req = $db->prepare('UPDATE smart_sn SET S_N = :s_n WHERE S_N = :id');
	$req->execute(array(
					's_n' => $_POST["sn"],
					'id' => $_POST["hiddensn"]
					));
	
	header('Location: ./smartLicense.php');
	exit();
}
else {
	header('Location: ./index.php');
	exit();
}
?>