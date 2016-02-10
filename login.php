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
    require_once('dbConn.php');
    if (isset($_POST["login"]) && isset($_POST["password"])) {
      $req = $db->prepare('SELECT * FROM users WHERE login = :login AND password = :password');
      $req->execute(array(
          'login' => $_POST["login"],
          'password' => sha1($_POST["password"])));

      $resultat = $req->fetch();

      if (!$resultat)
      {
          $err = '<span class="label label-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Mauvais identifiant ou mot de passe !</span>';
      }
      else
      {
          session_start();
          $_SESSION['login'] = $_POST['login'];
          header('Location: ./index.php');
          exit();
      }
    }
    include('navbar.php'); 
    ?>
    <div class="container">
      <h1>Se connecter</h1>
      <br /><br />
      <form role="form" class="form-horizontal" action="login.php" method="post" >
        <div class="form-group">
          <label for="login" class="control-label col-md-2">Identifiant :</label>
          <div class="col-md-4">
            <input id="login" title="Identifiant" class="form-control" name="login" placeholder="Identifiant" required autofocus>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="control-label col-md-2">Mot de passe :</label>
          <div class="col-md-4">
            <input id="password" type="password" title="Mot de passe" class="form-control" name="password" placeholder="Mot de passe" required autofocus>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
          </div>
        </div>
        <p class="col-md-offset-2"><?php echo $err ?></p>
      </form>
  </body>
  </html>