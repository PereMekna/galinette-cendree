<?php
require_once('dbConn.php');
$id = $_GET['id'];
$reponse = $db->query('DELETE FROM tickets where ID='.$id);
header('Location: ./allTickets.php');
?>
