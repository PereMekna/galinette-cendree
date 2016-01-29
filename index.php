<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>i-tech</title>

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
    } ?>

    <div class="container">
      <h1>Tableau de bord</h1>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel panel-default">
        <div class="panel-heading">Professionnels <span class="badge">2</span></div>
        <div class="panel-body">
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour AZERTY</strong> 1 jour(s) avant la date de livraison 
        </div>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour YTREEZA</strong> 2 jour(s) avant la date de livraison 
        </div>
      </div>
      </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel panel-default">
        <div class="panel-heading">Collectivités <span class="badge">3</span></div>
        <div class="panel-body">
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour UIOPOIUY</strong> 0 jour(s) avant la date de livraison 
        </div>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour ARTERZAA</strong> 1 jour(s) avant la date de livraison 
        </div>
        <div class="alert alert-warning">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour ZQQFEGV</strong> 3 jour(s) avant la date de livraison 
        </div>
        </div>
      </div>
    </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel panel-default">
        <div class="panel-heading">Particuliers <span class="badge">1</span></div>
        <div class="panel-body">
        <div class="alert alert-warning">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour QZQFQE</strong> 3 jour(s) avant la date de livraison 
        </div>
      </div>
    </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel panel-default">
        <div class="panel-heading">Éducatif <span class="badge">2</span></div>
        <div class="panel-body">
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour AERTYUUYTRE</strong> 0 jour(s) avant la date de livraison 
        </div>
        <div class="alert alert-warning">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Ticket pour BVDZZRT</strong> 2 jour(s) avant la date de livraison 
        </div>
      </div>
    </div>
      </div>
    </div>
    <!-- /.container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
  </body>
</html>