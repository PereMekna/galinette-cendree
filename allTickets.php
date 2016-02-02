<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tickets - i-tech</title>

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
  try {
    $db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
  }
  catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
  }
  $reponse = $db->query('SELECT * FROM tickets');

  
    ?>
  <div class="container">
      <h1>Liste des tickets</h1>
      <div class="pull-right">  
        <span class="dropdown">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span>&nbsp;<span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Afficher les catégories</li>
            <li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Atelier</a></li>
            <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Maintenance</a></li>
            <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Montage</a></li>
            <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Retour SAV</a></li>
            <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Intervention sur site</a></li>
          </ul>
        </span>
        <span class="dropdown">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;<span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Type de client</li>
            <li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Professionel</a></li>
            <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Particulier</a></li>
            <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Collectivité</a></li>
            <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Éducation</a></li>
          </ul>
        </span>
        <a class="btn btn-success" href="newTicket.php"><span class="glyphicon glyphicon-plus"></span> Nouveau ticket</a>
      </div>
      <br /><br />
      <div class="table-responsive">
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Référence client</th>
          <th>Date de livraison</th>
          <th>Description</th>
          <th>Avancement</th>
          <th><span class="glyphicon glyphicon-option-horizontal"></span></th>
        </tr>
      </thead>
      <tbody>
        <?php 
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

    

    if ($priorite == 0) $tr = '<tr class="success">';
    else if ($priorite == 1) $tr = '<tr class="warning">';
    else if ($priorite == 2) $tr = '<tr class="danger">';

    echo $tr.'<td>'.$ref_client.' ('.$type_client.')</td><td>'.$date_format.'</td><td>'.$type_inter.'</td><td>'.$avancement.'</td><td><a href="showTicket.php?id='.$id.'"><span class="glyphicon glyphicon-search"></span></a></td></tr>';} ?>
  </tbody>
  </table>
</div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
  var options = [];

  $( '.dropdown-menu a' ).on( 'click', function( event ) {

     var $target = $( event.currentTarget ),
         val = $target.attr( 'data-value' ),
         $inp = $target.find( 'input' ),
         idx;

     if ( ( idx = options.indexOf( val ) ) > -1 ) {
        options.splice( idx, 1 );
        setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
     } else {
        options.push( val );
        setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
     }

     $( event.target ).blur();
        
     console.log( options );
     return false;
  });

  </script>
  <?php
  $reponse->closeCursor(); ?>
  </body>
</html>