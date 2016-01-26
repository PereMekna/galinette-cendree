<html lang="fr">
  <head>
    <meta charset="utf-8">
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
  <?php include('navbar.php');
  try {
    $db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
  }
  catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
  }
  $id = $_GET['id'];
  $reponse = $db->query('SELECT * FROM tickets where ID='.$id);
  $reponsedesc = $db->query('SELECT * FROM descriptions where N_TICKET='.$id);
  $requete = $db->prepare("SELECT * FROM CLIENTS WHERE NUMERO = ?");
  while ($data = $reponse->fetch()) {
    $ref_client = $data["REF_CLIENT"];
    $type_client = abbrToFull($data["TYPE_CLIENT"]);
    $type_inter = abbrToFull($data["TYPE_INTER"]);
    $date_livraison = $data["DATE_LIVRAISON"];
    $facturation = $data["FACTURATION"];
    $n_bc = $data["N_BC"];
    $priorite = $data["PRIORITE"];
  }


  $requete->execute(array($ref_client));
  while ($data = $requete->fetch()) {
    $intitule = $data["NOM"];
    $mail = $data["MAIL"];
    $tel = $data["TEL"];
  }

  
    ?>
  <div class="container">
      <h1>Ticket pour <?php echo $intitule?></h1>
        <br /><br />
        <div class="row">
          <div class="col-md-4">
            <dl class="dl-horizontal">
              <dt>Client :</dt>
              <dd><a href="#" title="<?php echo $intitule ?>" data-toggle="popover" data-placement="auto" data-trigger="focus" data-content="<?php echo 'Réf : '.$ref_client.' / Mail : '.$mail.' / Tél : '.$tel ?>"><?php echo $intitule ?></a></dd>
              <dt>N° BC :</dt>
              <dd><?php echo $n_bc ?></dd>
              <dt>Type de client :</dt>
              <dd><?php echo $type_client ?></dd>
              <dt>Type d'intervention :</dt>
              <dd><?php echo $type_inter ?></dd>
              <dt>Date de livraison :</dt>
              <dd><?php echo $date_livraison ?></dd>
              <dt>Facturation :</dt>
              <dd><?php if ($facturation) echo 'A facturer';
              else echo 'Sous maintenance / garantie'; ?></dd>
              <dt>Priorité :</dt>
              <dd><?php echo abbrToFull($priorite) ?></dd>
            </dl>
          </div>
          <div class="col-md-8">
            <form role="form" class="form-horizontal" action="addModif.php" method="post" >
              <div class="form-group">
                <label for="desc" class="control-label col-md-3">Description :</label>
                <div class="col-md-6">
                  <p class="form-control-static" id="desc"><?php $data = $reponsedesc->fetch(); echo $data["TEXTE"] ?></p>
                </div>
              
              
                <label for="desc" class="control-label col-md-3"><?php echo abbrToFull($data['AVANCEMENT']).' ('.$data["DATE"].')' ?></label>
                </div>
                <?php while($data = $reponsedesc->fetch()) { ?>
                <div class="form-group">
                
                <label for="modif" class="control-label col-md-3">Modif :</label>
                <div class="col-md-6">
                  <p class="form-control-static" id="desc"><?php echo $data["TEXTE"] ?></p>
                </div>
                <label for="desc" class="control-label col-md-3"><?php echo abbrToFull($data['AVANCEMENT']).' ('.$data["DATE"].')' ?></label>
                </div>

                <?php } ?>
                <div class="well">
                <div class="form-group">
                <label for="modif" class="control-label col-md-2">Modif :</label>
                <div class="col-md-7">
                  <textarea id="modif" class="form-control" rows="5" required title="Modification " name="modif"></textarea>
                </div>
                <div class="col-md-2">
                  <div class="row">
                  <select id="avancement" name="avancement" class="form-control">
                    <option value="af"><?php echo abbrToFull('af') ?></option>
                    <option value="ec"><?php echo abbrToFull('ec') ?></option>
                    <option value="arc"><?php echo abbrToFull('arc') ?></option>
                    <option value="ap"><?php echo abbrToFull('ap') ?></option>
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
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover();   
  });
  </script>
  <?php
  $reponse->closeCursor(); ?>
  </body>
</html>