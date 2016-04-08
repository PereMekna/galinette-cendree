<?php session_start();
require_once('dbConn.php'); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Licenses SMART</title>

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
  $err = '';
    $id = $_GET["id"];
    require_once('dbConn.php');
    if (isset($_GET["id"])) {
      $req = $db->prepare('SELECT * FROM smart_license INNER JOIN smart_sn ON smart_license.ID_LICENSE = smart_sn.CLEF_ID AND smart_sn.ID = :id');
      $req->execute(array(
          'id' => $id));

      $data = $req->fetch();
    }

   ?>
   <div class="container">
   	<h1>Éditer la license</h1>
	   <div class="row">
	      <div class="col-md-6">
	            <form class="form-horizontal" action="smartEditDB.php" method="post">
	              <div class="form-group">
	                <label for="ville" class="control-label col-md-4">Ville :</label>
	                <div class="col-md-8">
	                  <input type="text" placeholder="Ville" name="ville" class="form-control" value="<?php echo $data["VILLE"]; ?>" />
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="etab" class="control-label col-md-4">Établissement :</label>
	                <div class="col-md-8">
	                  <input type="text" placeholder="Établissement" name="etab" class="form-control" value="<?php echo $data["ETAB"]; ?>" />
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="modele" class="control-label col-md-4">Modèle :</label>
	                <div class="col-md-8">
	                  <input type="text" placeholder="Modèle" name="modele" class="form-control" value="<?php echo $data["MODELE"]; ?>" />
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="clef" class="control-label col-md-4">License :</label>
	                <div class="col-md-8">
	                  <input type="text" placeholder="Clef de license" name="clef" class="form-control" value="<?php echo $data["CLEF"]; ?>" />
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="date" class="control-label col-md-4">Date validité :</label>
	                <div class="col-md-8">
	                  <input type="date" name="date" class="form-control" value="<?php echo $data["DATE"]; ?>" />
	                </div>
	              </div>
	              <div class="form-group">
	                <label for="version" class="control-label col-md-4">Version :</label>
	                <div class="col-md-8">
	                  <input type="text" placeholder="Numéro de version" name="version" class="form-control" value="<?php echo $data["VERSION"]; ?>" />
	                </div>
	              </div>
	              <div id="sn_area">
	                <input id="hiddenclef" type="hidden" name="hiddenclef" value="<?php echo $data["ID_LICENSE"]; ?>" />
	                <input id="hiddensn" type="hidden" name="hiddensn" value="<?php echo $data["ID"]; ?>" />
	                <div class="form-group">
	                  <label for="sn" class="control-label col-md-4">S/N :</label>
	                  <div class="col-md-8">
	                    <input type="text" placeholder="S/N" name="sn" class="form-control" value="<?php echo $data["S_N"]; ?>" />
	                  </div>
	                </div>
	              </div>
	              <div class="form-group">
	                <div class="col-md-offset-4 col-md-4">
	                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Éditer</button>
	                </div>
	              </div>
	            </form>
	          </div>
	    </div>
	  </div>
</body>
</html>