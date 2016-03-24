<?php
session_start();
if (isset($_POST["ref_client"])) {
  require_once('dbConn.php');

  if (isset($_POST["ticket_hidden"])) {
    $id = $_POST["ticket_hidden"];
  }

  if ($_POST["facturation"] == "fac"){
    $fac = 1;
  }
  else $fac = 0;

  $req = $db->prepare('UPDATE tickets SET REF_CLIENT = :ref_client, TYPE_CLIENT = :type_client, TYPE_INTER = :type_inter, DATE_LIVRAISON = :date_livraison, FACTURATION = :facturation, N_BC = :n_bc, PRIORITE = :priorite WHERE ID = :id');
  $req->execute(array(
          'ref_client' => $_POST["ref_client"],
          'type_client' => $_POST["typeclient"],
          'type_inter' => $_POST["typeinter"],
          'date_livraison' => $_POST["datepicker"],
          'facturation' => $fac,
          'n_bc' => $_POST["bc"],
          'priorite' => $_POST["labpriohidden"],
          'id' => $id));

  if ($_POST["typeinter"] == 'sav') {
    $req = $db->prepare('UPDATE sav SET N_TICKET = :n_ticket, MARQUE = :marque, MODELE = :modele,N_SERIE = :n_serie where N_TICKET = :n_ticket');
    $req->execute(array(
            'marque' => $_POST['marque'],
            'modele' => $_POST['modele'],
            'n_serie' => $_POST['noserie'],
            'n_ticket' => $id));
  }

  header('Location: ./showTicket.php?id='.$_POST["ticket_hidden"]);
  exit();
}
else {
  header('Location: ./index.php');
  exit();
}



?>