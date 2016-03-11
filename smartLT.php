<?php
session_start();
require_once('dbConn.php');

if (isset($_GET["ville"])) $ville = $_GET["ville"];
if (isset($_GET["etab"])) $etab = $_GET["etab"];
if (isset($_GET["modele"])) $modele = $_GET["modele"];
if (isset($_GET["sn"])) $sn = $_GET["sn"];
if (isset($_GET["clef"])) $clef = $_GET["clef"];

if (isset($_GET["ville"]) || isset($_GET["etab"]) || isset($_GET["modele"]) || isset($_GET["sn"]) || isset($_GET["clef"])) {
	$requete = $db->prepare('SELECT * FROM smart_license INNER JOIN smart_sn ON smart_license.CLEF = smart_sn.CLEF AND (smart_license.VILLE LIKE :ville AND smart_license.ETAB LIKE :etab AND smart_license.MODELE LIKE :modele AND smart_license.CLEF LIKE :clef AND smart_sn.S_N LIKE :sn)');
	$requete->execute(array('ville' => '%'.$ville.'%',
							'etab' => '%'.$etab.'%',
							'modele' => '%'.$modele.'%',
							'clef' => '%'.$clef.'%',
							'sn' => '%'.$sn.'%'));
}
else {
	$requete = $db->prepare('SELECT * FROM smart_license INNER JOIN smart_sn ON smart_license.CLEF = smart_sn.CLEF');
	$requete->execute();
}
$rep = $requete->fetchAll();
if (count($rep) == 0) {
  echo '<tr><td><span class="glyphicon glyphicon-warning-sign"></span> Aucun résultat.</td></tr>';
  $destinataire = 'jerome.dupire@itech-informatique.com';
  $expediteur = 'smart-activation@itech-informatique.com';
  $objet = "[".$ville."] Demande d'activation";
  $message = "Bonjour,<br />Je souhaiterai activer du matériel pour mon client.<br />Revendeur :<br />I-Tech informatique<br />Jerome Dupire<br />Adresse : 176 route de Lens, 62223 STE CATHERINE<br />0321601212<br />Jerome.dupire@itech-informatique.com<br />sebastien@itech-informatique.com<br />chouayb@itech-informatique.com<br /><br />".$ville." – ".$etab.".<br />".$modele."<br />".$sn."<br />Nom : ".$ville." – ".$etab."<br />Cordialement,<br />Jérôme Dupire<br /><br />I-Tech Informatique & Technologies<br />Tel : 03 21 60 12 12<br />176 route de Lens<br />62223 Ste Catherine";
  $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
  $headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
  $headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
  $headers .= 'From: "ITECH ACTIVATION SMART"<'.$expediteur.'>'."\n"; // Expediteur
  $headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
  $_SESSION['destinataire'] = $destinataire;
  $_SESSION['objet'] = $objet;
  $_SESSION['message'] = $message;
  $_SESSION['headers'] = $headers;
  echo '<tr><td><span class="glyphicon glyphicon-envelope"></span> <a href="smartMailSend.php">Envoyer le mail à '.$destinataire.'</a></td></tr>';

}
else {
	foreach ($rep as $data) {
	echo '<tr><td>'.$data["VILLE"].'</td><td>'.$data["ETAB"].'</td><td>'.$data["MODELE"].'</td><td>'.$data["S_N"].'</td><td>'.$data["CLEF"].'</td><td>'.$data["DATE"].'</td><td>'.$data["VERSION"].'</td><td><a href="smartEdit.php?id='.$data["S_N"].'"><span class="glyphicon glyphicon-edit"></span></a></td></tr>';
	}
}

?>