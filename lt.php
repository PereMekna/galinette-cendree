<?php 
include('inc/functions.php');

try {
    $db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
  }
  catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
  }

  $req = 'SELECT * FROM tickets WHERE (';
  if (isset($_GET['atel'])) $req .= 'type_inter = "atel" OR ';
  if (isset($_GET['maint'])) $req .= 'type_inter = "maint" OR ';
  if (isset($_GET['mont'])) $req .= 'type_inter = "mont" OR ';
  if (isset($_GET['sav'])) $req .= 'type_inter = "sav" OR ';
  if (isset($_GET['site'])) $req .= 'type_inter = "site" OR ';
  if ((isset($_GET['atel']) || isset($_GET['maint']) || isset($_GET['mont']) || isset($_GET['sav']) || isset($_GET['site'])) && (isset($_GET['pro']) || isset($_GET['part']) || isset($_GET['col']) || isset($_GET['edu']))) {
    $req = substr($req,0,strlen($req)-4);
    $req .= ') AND (';
  }
  if (isset($_GET['pro'])) $req .= 'type_client = "pro" OR ';
  if (isset($_GET['part'])) $req .= 'type_client = "part" OR ';
  if (isset($_GET['col'])) $req .= 'type_client = "col" OR ';
  if (isset($_GET['edu'])) $req .= 'type_client = "edu" OR ';

  $req = substr($req,0,strlen($req)-4);
  $req .= ')';
  
  if (!(isset($_GET['atel']) || isset($_GET['maint']) || isset($_GET['mont']) || isset($_GET['sav']) || isset($_GET['site']) || isset($_GET['pro']) || isset($_GET['part']) || isset($_GET['col']) || isset($_GET['edu']))) {
    $req = 'SELECT * FROM tickets';
  }

  //echo '<tr><td>'.$req.'</td></tr>';




  $reponse = $db->query($req);

    while ($data = $reponse->fetch()) {
    $id = $data["ID"];
    $ref_client = $data["REF_CLIENT"];
    $type_client = abbrToFull($data["TYPE_CLIENT"]);
    $type_inter = abbrToFull($data["TYPE_INTER"]);
    $date_livraison = $data["DATE_LIVRAISON"];
    $facturation = $data["FACTURATION"];
    $n_bc = $data["N_BC"];
    $priorite = $data["PRIORITE"];
    $avancement = abbrToFull($data["AVANCEMENT"]);
    $date_format = date("D d/m/Y", strtotime($date_livraison));

    

    if ($priorite == 0) $tr = '<td class="success">';
    else if ($priorite == 1) $tr = '<td class="warning">';
    else if ($priorite == 2) $tr = '<td class="danger">';

    echo '<tr class="clickable-row" data-href="./showTicket.php?id='.$id.'"><td>'.$ref_client.' ('.$type_client.')</td><td>'.$date_format.'</td><td>'.$type_inter.'</td><td>'.$avancement.'</td>'.$tr.'&nbsp;&nbsp;</td></tr>';}
  

  ?>
  
  <script>
  jQuery(document).ready(function($) {
      $(".clickable-row").click(function() {
          window.document.location = $(this).data("href");

      });
  });
  </script>