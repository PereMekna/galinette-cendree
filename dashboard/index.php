<?php session_start();
require_once('../dbConn.php');
require_once('../inc/functions.php');
?>
<html lang="fr" id="html">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Supervision atelier</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style-supervision.css" rel="stylesheet">
    <link href="../jquery-ui.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body id="body">

  <?php 
  if (!isset($_SESSION["login"])) {
    header('Location: ../login.php');
    exit();
  }
  
  ?>
  <div class="container">
  	<div id="global">
	  	<div class="row">
	  		<h1>Supervision atelier</h1>
	  	</div>
	  	<div class="row">
	  		<div class="col-lg-6">
	  			<h2>Professionnel</h2>
          <div class ="show-alert" id="pro"></div>
	  		</div>
	  		<div class="col-lg-6">
	  			<h2>Collectivité</h2>
            <div class ="show-alert" id="col"></div>
	  		</div>
	  	</div>
	  	<div class="row">
	  		<div class="col-lg-6">
	  			<h2>Particulier</h2>
          <div class ="show-alert" id="part"></div>
	  		</div>
	  		<div class="col-lg-6">
	  			<h2>Éducation</h2>
          <div class ="show-alert" id="edu"></div>
	  		</div>
	  	</div>
	  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script>

  var reload = function() {
    $('.show-alert#pro').load('getAlert.php?cat=pro');
    $('.show-alert#part').load('getAlert.php?cat=part');
    $('.show-alert#edu').load('getAlert.php?cat=edu');
    $('.show-alert#col').load('getAlert.php?cat=col');
  };

  var interval = 1000 * 1; // where X is your every X minutes

  setInterval(reload, interval);

    </script>
</body>

</html>