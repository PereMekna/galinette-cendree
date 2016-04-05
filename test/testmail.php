<?php
$destinataire = 'jb@itech-informatique.com';
$expediteur = 'i-tech@orange.fr';
$objet = "coucou";
$message = $headers;
$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: "ITECH"<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
mail($destinataire, $objet, $message, $headers);

$destinataire = 'dupont.louis4@gmail.com';
$objet = "coucou";
$message = $headers;
$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
$headers .= 'From: "ITECH"<'.$expediteur.'>'."\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
mail($destinataire, $objet, $message, $headers);
?>