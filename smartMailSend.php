<?php 
session_start();
if (mail($_SESSION['destinataire'], $_SESSION['objet'], $_SESSION['message'], $_SESSION['headers'])) // Envoi du message
{
    header('Location: ./smartLicense.php');
}
else // Non envoyé
{
    header('Location: ./smartMailError.php');
}
?>