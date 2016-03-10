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
        <li id="dashboard" <?php if (preg_match('#index.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="index.php">Tableau de bord</a></li>
        <li id="newTicket" <?php if (preg_match('#newTicket.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="newTicket.php">Nouveau ticket</a></li>
        <li id="ticketList" <?php if (preg_match('#allTickets.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="allTickets.php">Tickets ouverts</a></li>
        <li id="smartLicense" <?php if (preg_match('#smartLicense.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="smartLicense.php">Licenses SMART</a></li>
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