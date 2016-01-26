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
  $reponse = $db->query('SELECT * FROM tickets');

  
    ?>
  <div class="container">
      <h1>Liste des tickets</h1>
      <table class="table">
      	<tr>
      		<th>Référence client</th>
      		<th>Date de livraison</th>
      		<th>Description</th>
      		<th>Consulter le ticket</th>
      	</tr>
      	<?php 
    while ($data = $reponse->fetch()) {
    $id = $data["ID"];
    $ref_client = $data["REF_CLIENT"];
    $type_client = $data["TYPE_CLIENT"];
    $type_inter = $data["TYPE_INTER"];
    $date_livraison = $data["DATE_LIVRAISON"];
    $facturation = $data["FACTURATION"];
    $n_bc = $data["N_BC"];
    $priorite = $data["PRIORITE"];

    if ($type_client == 'col') {
      $type_client = 'Collectivités';
    }
    else if ($type_client == 'pro') {
      $type_client = 'Professionnels';
    }
    else if ($type_client == 'part') {
      $type_client = 'Particuliers';
    }
    else if ($type_client == 'edu') {
      $type_client = 'Éducation';
    }

    if ($type_inter == 'atel') {
      $type_inter = 'Atelier';
    }
    else if ($type_inter == 'maint') {
      $type_inter = 'Maintenance';
    }
    else if ($type_inter == 'mont') {
      $type_inter = 'Montage';
    }
    else if ($type_inter == 'sav') {
      $type_inter = 'Retour SAV';
    }
    else if ($type_inter == 'site') {
      $type_inter = 'Intervention sur site';
    }

    if ($priorite == 0) $tr = '<tr class="success">';
    else if ($priorite == 1) $tr = '<tr class="warning">';
    else if ($priorite == 2) $tr = '<tr class="danger">';

    echo $tr.'<td>'.$ref_client.' ('.$type_client.')</td><td>'.$date_livraison.'</td><td>'.$type_inter.'</td><td><a href="showTicket.php?id='.$id.'"><span class="glyphicon glyphicon-search"></span></a></td></tr>';} ?>

</table>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
  </script>
  <?php
  $reponse->closeCursor(); ?>
  </body>
</html>