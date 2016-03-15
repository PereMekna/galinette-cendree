<?php 
include('inc/functions.php');

require_once('dbConn.php');
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

  if ((isset($_GET['atel']) || isset($_GET['maint']) || isset($_GET['mont']) || isset($_GET['sav']) || isset($_GET['site']) || isset($_GET['pro']) || isset($_GET['part']) || isset($_GET['col']) || isset($_GET['edu'])) && (isset($_GET['af']) || isset($_GET['ec']) || isset($_GET['arc']) || isset($_GET['ap']) || isset($_GET['arf']) || isset($_GET['te']) || isset($_GET['tl']))) {
    $req = substr($req,0,strlen($req)-4);
    $req .= ') AND (';
  }
  if (isset($_GET['af'])) $req .= 'AVANCEMENT = "af" OR ';
  if (isset($_GET['ec'])) $req .= 'AVANCEMENT = "ec" OR ';
  if (isset($_GET['arc'])) $req .= 'AVANCEMENT = "arc" OR ';
  if (isset($_GET['ap'])) $req .= 'AVANCEMENT = "ap" OR ';
  if (isset($_GET['arf'])) $req .= 'AVANCEMENT = "arf" OR ';
  if (isset($_GET['te'])) $req .= 'AVANCEMENT = "te" OR ';
  if (isset($_GET['tl'])) $req .= 'AVANCEMENT = "tl" OR ';


  $req = substr($req,0,strlen($req)-4);

  if (isset($_GET['search'])) $req .= ') AND (REF_CLIENT LIKE "%'.$_GET['search'].'%" OR N_BC LIKE "%'.$_GET['search'].'%"';
  $req .= ')';
  
  if (!(isset($_GET['atel']) || isset($_GET['maint']) || isset($_GET['mont']) || isset($_GET['sav']) || isset($_GET['site']) || isset($_GET['pro']) || isset($_GET['part']) || isset($_GET['col']) || isset($_GET['edu']) || isset($_GET['af']) || isset($_GET['ec']) || isset($_GET['arc']) || isset($_GET['ap']) || isset($_GET['te']) || isset($_GET['tl']))) {
    $req = 'SELECT * FROM tickets WHERE (AVANCEMENT = "af" OR AVANCEMENT = "ec" OR AVANCEMENT = "arc" OR AVANCEMENT = "ap" OR AVANCEMENT = "arf")';
  }

  
  if (isset($_GET['search'])) {
      $rep_search = $db->prepare('SELECT * FROM descriptions WHERE TEXTE LIKE :searchterm');
      $rep_search->execute(array(
                  'searchterm' => '%'.$_GET['search'].'%'));
    $result_search = $rep_search->fetchAll();
    if (!empty($result_search)) {
      foreach ($result_search as $desc) {
        $req .= ' OR ID = '.$desc['N_TICKET'];
      }
    }
  }

  //echo '<tr><td>'.$req.'</td></tr>';
  $reponse = $db->query($req);
  $rep = $reponse->fetchAll();
  if (count($rep) == 0) {
    echo '<tr><td><span class="glyphicon glyphicon-warning-sign"></span> Aucun résultat</td></td>';
  }
  else {
    foreach ($rep as $data) {
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

    echo '<tr class="clickable-row" data-href="./showTicket.php?id='.$id.'"><td>'.$ref_client.' ('.$type_client.')</td><td>'.$date_format.'</td><td>'.$type_inter.'</td><td>'.$avancement.'</td><td>'.$n_bc.'</td>'.$tr.'&nbsp;&nbsp;</td></tr>';}
  
  }
  ?>
  
  <script>
  jQuery(document).ready(function($) {
      $(".clickable-row").click(function() {
          window.document.location = $(this).data("href");

      });
  });
  </script>