<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ticket - i-tech</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="jquery-ui.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <?php 
  include('navbar.php');
  if (!isset($_SESSION["login"])) {
    header('Location: ./login.php');
    exit();
  }
  require_once('dbConn.php');
  $id = $_GET['id'];
  $reponse = $db->query('SELECT * FROM tickets where ID='.$id);
  $reponsedesc = $db->query('SELECT * FROM descriptions where N_TICKET='.$id);
  $requete = $db->prepare("SELECT * FROM clients WHERE NUMERO = ?");
  while ($data = $reponse->fetch()) {
    $ref_client = $data["REF_CLIENT"];
    $type_client = $data["TYPE_CLIENT"];
    $type_inter = $data["TYPE_INTER"];
    $date_livraison = $data["DATE_LIVRAISON"];
    $facturation = $data["FACTURATION"];
    $n_bc = $data["N_BC"];
    $priorite = $data["PRIORITE"];
    $avancement = abbrToFull($data["AVANCEMENT"]);
  }


  $requete->execute(array($ref_client));
  while ($data = $requete->fetch()) {
    $intitule = $data["NOM"];
    $mail = $data["MAIL"];
    $tel = $data["TEL"];
  }

  if ($type_inter == "sav") {
    $requete = $db->prepare("SELECT * FROM sav WHERE N_TICKET = ?");
    $requete->execute(array($id));
    $sav_marque = "non renseigné";
    $sav_modele = "non renseigné";
    $sav_n_serie = "non renseigné";
    while ($data = $requete->fetch()) {
      $sav_marque = $data["MARQUE"];
      $sav_modele = $data["MODELE"];
      $sav_n_serie = $data["N_SERIE"];
    }
  }

  $requete = $db->prepare("SELECT * FROM materiel WHERE N_TICKET = ?");
  $requete->execute(array($id));
  $materiel = $requete->fetchAll();

  
    ?>
    
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="noprint">Ticket pour <?php echo $intitule?> <small><?php echo $avancement ?></small></h1>
      </div>
      <div class="col-sm-6">
        <div class="pull-right">
          <a class="btn btn-default" id="print"><span class="glyphicon glyphicon-print"></span> Imprimer</a>
        <a class="btn btn-default" href="editTicket.php?id=<?php echo $id ?>"><span class="glyphicon glyphicon-edit"></span> Éditer</a>
        <a class="btn btn-danger" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>
      </div>
      </div>
    </div>
        <br /><br />
        <div class="row">
          <div class="logo-print"><p>I-TECH INFORMATIQUE & TECHNOLOGIES<br />RCS: 47884924300017<br />Capital : 100 000€<br />176 route de Lens<br />62223 Ste Catherine<br />Tel : 03 21 60 12 12<br />Fax : 03 21 50 58 27</p></div>
          <div class="col-md-4">
            <div class="panel panel-default print">
            <table class="table table-show print">
              <tr>
                <td>Client</td>
                <td><a href="#" title="<?php echo $intitule ?>" data-toggle="popover" data-placement="auto" data-trigger="focus" data-content="<?php echo 'Réf : '.$ref_client.' / Mail : '.$mail.' / Tél : '.$tel ?>"><?php echo $ref_client ?></a>
              </tr>
              <tr>
                <td>N° Ticket</td>
                <td><?php echo $id ?></td>
              <tr>
                <td>N° BC</td>
                <td><?php echo $n_bc ?></td>
              </tr>
              <tr>
                <td>Type de client</td>
                <td><?php echo abbrToFull($type_client) ?></td>
              </tr>
              <tr>
                <td>Type d'intervention</td>
                <td><?php echo abbrToFull($type_inter) ?></td>
              </tr>
              <tr>
                <td>Date de livraison</td>
                <td><?php echo date("D d/m/Y ", strtotime($date_livraison)) ?></td>
              </tr>
              <tr>
                <td>Facturation</td>
                <td><?php if ($facturation) echo 'A facturer';
              else echo 'Sous maintenance / garantie'; ?></td>
              </tr>
              <tr class="noprint">
                <td>Priorité</td>
                <td><?php echo abbrToFull($priorite) ?></td>
              </tr>
              <?php if ($type_inter == "sav") { ?>
              <tr>
                <td>Marque</td>
                <td><?php echo $sav_marque ?></td>
              </tr>
              <tr>
                <td>Modèle</td>
                <td><?php echo $sav_modele ?></td>
              </tr>
              <tr>
                <td>N° série</td>
                <td><?php echo $sav_n_serie; } ?></td>
              </tr>
              <?php if (count($materiel) > 0) {
                foreach ($materiel as $mat) {
                  echo '<tr><td><a id="link'.$mat["ID"].'" href="#link'.$mat["ID"].'" title="'.$mat["DESCRIPTION"].'" data-toggle="popover" data-placement="auto" data-trigger="focus" data-content="Mot de passe : '.$mat["MDP"].'">'.abbrToFull($mat["TYPE"]).' ('.$mat["DESCRIPTION"].')</a></td><td>'.$mat["PERIPH"].'</td></tr>';
                }
              }
                ?>
            </table>
            <div class="panel-footer">
                <a href="editTicket.php?id=<?php echo $id ?>">Éditer le ticket</a>
            </div>

          </div>
          </div>
          <div class="col-md-8">
            <h2 class="print"><br />Suivi du ticket<br /></h2>
            <form role="form" class="form-horizontal" action="addModif.php" method="post" >
              <input type="hidden" id="idhidden" name="idhidden" value="<?php echo $id ?>" />
              <div class="form-group print-group">
                <div class="print-text">
                <label for="desc" class="control-label col-md-3">Description :</label>
                <div class="col-md-6">
                  <p class="form-control-static text-justify" id="desc"><?php $data = $reponsedesc->fetch(); echo nl2br($data["TEXTE"]) ?></p>
                </div>
              </div>
              
                <div class="col-md-3 print-right">
                  <a class="btn btn-default pull-right" role="button" href="editModif.php?id=<?php echo $data["ID"]; ?>"><span class="glyphicon glyphicon-edit"></span>&nbsp;</a>
                <p class="form-control-static">
                <strong><?php echo abbrToFull($data['AVANCEMENT']).'</strong><br />('.date("D d/m/Y H:i:s", strtotime($data["DATE"])).')<br />Par : '.$data["ID_USER"] ?><br /></p>
                </div>
                </div>
              
                <hr />
                <?php while($data = $reponsedesc->fetch()) { ?>
                <div class="form-group print-group">

                <div class="print-text">
                <label for="modif" class="control-label col-md-3">Modif :</label>
                <div class="col-md-6">
                  <p class="form-control-static text-justify" id="desc"><?php echo nl2br($data["TEXTE"]) ?></p>
                </div>
              </div>
                <div class="col-md-3 print-right">
                    <a class="btn btn-default pull-right" role="button" href="editModif.php?id=<?php echo $data["ID"]; ?>"><span class="glyphicon glyphicon-edit"></span>&nbsp;</a>
                <p class="form-control-static"><strong><?php echo abbrToFull($data['AVANCEMENT']).'</strong><br />('.date("D d/m/Y H:i:s", strtotime($data["DATE"])).')<br />Par : '.$data["ID_USER"] ?></p>
                </div>
              </div>
                <hr />

                <?php } ?>
                <div class="well col-md-offset-1 noprint">
                <div class="form-group">
                <label for="modif" class="control-label col-md-2">Modif :</label>
                <div class="col-md-7">
                  <textarea id="modif" class="form-control" rows="5" required title="Modification " name="modif" autofocus></textarea>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-9" id="avancement-submit">
                  <div class="row">
                  <select id="avancement" name="avancement" class="form-control">
                    <option value="af"><?php echo abbrToFull('af') ?></option>
                    <option value="ec"><?php echo abbrToFull('ec') ?></option>
                    <option value="arc"><?php echo abbrToFull('arc') ?></option>
                    <option value="ap"><?php echo abbrToFull('ap') ?></option>
                    <option value="arf"><?php echo abbrToFull('arf') ?></option>
                    <option value="te"><?php echo abbrToFull('te') ?></option>
                    <option value="tl"><?php echo abbrToFull('tl') ?></option>
                  </select>
                </div>
                <div class="row">
                  <br />
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
  </div>
  <!-- Modal -->
  <div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Suppression du ticket <?php echo $id ?> pour <?php echo $ref_client ?></h4>
        </div>
        <div class="modal-body">
          <p>Êtes vous sur de vouloir supprimer ce ticket ?</p>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger" href="deleteTicket.php?id=<?php echo $id ?>">Supprimer</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        </div>
      </div>

    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover();   
  });
  $('#print').click(function() {
    window.print();
  })
  </script>
  <?php
  $reponse->closeCursor(); ?>
  </body>
</html>