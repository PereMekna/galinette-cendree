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
    $max_row = 3;
    if (!isset($_SESSION["login"])) {
      header('Location: ./login.php');
      exit();
    }
     ?>

    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1>Tableau de bord</h1>
        </div>
        <div class="col-sm-6">
          <div class="pull-right">
            <a class="btn btn-primary" href="allTickets.php"><span class="glyphicon glyphicon-th-list"></span> Tous les tickets</a>
            <a class="btn btn-success" href="newTicket.php"><span class="glyphicon glyphicon-plus"></span> Nouveau ticket</a>
          </div>
        </div>
      </div>
      
      <div class="row top-buffer-xs">
      <div class="col-xs-12 col-sm-6 col-md-6">
        <?php 
        $cat = "pro";
        include 'getAlert.php'; ?>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
        <?php 
        $cat = "col";
        include 'getAlert.php'; ?>        
      </div>
      </div>
      <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6">
        <?php 
        $cat = "part";
        include 'getAlert.php'; ?>      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">

        <?php 
        $cat = "edu";
        include 'getAlert.php'; ?>
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