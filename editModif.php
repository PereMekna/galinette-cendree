<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Connexion - i-tech</title>

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
    $err = '';
    $id = $_GET["id"];
    require_once('dbConn.php');
    if (isset($_GET["id"])) {
      $req = $db->prepare('SELECT * FROM descriptions WHERE ID = :id');
      $req->execute(array(
          'id' => $id));

      $resultat = $req->fetch();
    }
    include('navbar.php'); 
    ?>
    <div class="container">
      <h1>Éditer un commentaire</h1>
      <br /><br />
      <form role="form" class="form-horizontal" action="editModifDB.php" method="post" >
        <div class="form-group">
          <label for="desc" class="control-label col-md-2">Description :</label>
          <div class="col-md-4">
            <textarea id="desc" class="form-control" rows="5" required title="Modification " name="modif" autofocus><?php echo $resultat["TEXTE"]; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="avancement" class="control-label col-md-2">Avancement :</label>
          <div class="col-md-4">
            <select id="avancement" name="avancement" class="form-control">
              <option value="af" <?php if ($resultat['AVANCEMENT'] == 'af') echo 'selected'; ?>><?php echo abbrToFull('af') ?></option>
              <option value="ec" <?php if ($resultat['AVANCEMENT'] == 'ec') echo 'selected'; ?>><?php echo abbrToFull('ec') ?></option>
              <option value="arc" <?php if ($resultat['AVANCEMENT'] == 'arc') echo 'selected'; ?>><?php echo abbrToFull('arc') ?></option>
              <option value="ap" <?php if ($resultat['AVANCEMENT'] == 'ap') echo 'selected'; ?>><?php echo abbrToFull('ap') ?></option>
              <option value="te" <?php if ($resultat['AVANCEMENT'] == 'te') echo 'selected'; ?>><?php echo abbrToFull('te') ?></option>
              <option value="tl" <?php if ($resultat['AVANCEMENT'] == 'tl') echo 'selected'; ?>><?php echo abbrToFull('tl') ?></option>
            </select>
          </div>
        </div>
        <input type="hidden" name="modif_hidden" value="<?php echo $id; ?>" />
        <input type="hidden" name="ticket_hidden" value="<?php echo $resultat['N_TICKET']; ?>" />
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Modifier</button>
          </div>
        </div>
        <p class="col-md-offset-2"><?php echo $err ?></p>
      </form>
  </body>
  </html>