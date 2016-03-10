<?php

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
foreach ($rep as $data) {
	echo '<tr><td>'.$data["VILLE"].'</td><td>'.$data["ETAB"].'</td><td>'.$data["MODELE"].'</td><td>'.$data["S_N"].'</td><td>'.$data["CLEF"].'</td><td>'.$data["DATE"].'</td><td>'.$data["VERSION"].'</td><td><a href="smartEdit.php?id='.$data["S_N"].'"><span class="glyphicon glyphicon-edit"></span></a></td></tr>';
}

?>