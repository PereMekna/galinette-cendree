<head>
  <link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
</head>
<?php 
require_once('dbConn.php'); 
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">I-tech</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tickets <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="dashboard" <?php if (preg_match('#index.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="index.php"><span class="glyphicon glyphicon-tasks"></span> Tableau de bord</a></li>
            <li id="newTicket" <?php if (preg_match('#newTicket.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="newTicket.php"><span class="glyphicon glyphicon-plus"></span> Nouveau ticket</a></li>
            <li id="ticketList" <?php if (preg_match('#allTickets.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="allTickets.php"><span class="glyphicon glyphicon-list"></span> Tickets ouverts</a></li>
            <li role="separator" class="divider"></li>
            <li id="supervision"><a href="./dashboard/index.php"><span class="glyphicon glyphicon-new-window"></span> Supervision atelier</a></li>
          </ul>
        </li>
        <li id="smartLicense" <?php if (preg_match('#smart#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="smartLicense.php">Licenses SMART</a></li>
        <li id="fournisseur" <?php if (preg_match('#fournisseur.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="fournisseur.php">Fournisseurs</a></li>
      </ul>
      <?php if (isset($_SESSION['login'])) {
        echo '<p class="navbar-text navbar-right">Signed in as '.$_SESSION['login'].' <a href="logout.php" class="navbar-link"> <span class="glyphicon glyphicon-log-out"></span></a></p>';
      }
      else echo '<p class="navbar-text navbar-right">Connexion obligatoire</p>' ?>
      
    </div><!--/.nav-collapse -->
  </div>
</nav>

<?php include('inc/functions.php'); 
ini_set('display_errors',1);
error_reporting(-1); ?>
