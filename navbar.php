<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">i-tech</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li id="dashboard" <?php if (preg_match('#index.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="index.php">Tableau de bord</a></li>
        <li id="newTicket" <?php if (preg_match('#newTicket.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="newTicket.php">Nouveau ticket</a></li>
        <li id="ticketList" <?php if (preg_match('#allTickets.php#', $_SERVER['REQUEST_URI'])) {echo 'class="active"';} ?>><a href="allTickets.php">Tickets ouverts</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<?php include('inc/functions.php'); ?>