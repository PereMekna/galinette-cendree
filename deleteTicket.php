<?php
require_once('dbConn.php');
$id = $_GET['id'];
$reponse = $db->query('DELETE FROM tickets where ID='.$id);
$reponse = $db->query('DELETE FROM descriptions where N_TICKET='.$id);
header('Location: ./allTickets.php');
?>
