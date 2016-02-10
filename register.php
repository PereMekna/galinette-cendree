<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Inscription - i-tech</title>

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
  $err ='';
  try {
    $db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', 'root');
  }
  catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
  }
  if (isset($_POST["password"]) && isset($_POST["password_conf"]) && $_POST["password_conf"] != $_POST["password"]) {
    $err .= '<span class="label label-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Les mots de passe que vous avez saisis ne correspondent pas.</span><br />';
  }
  if (isset($_POST["login"])) {
    $req = $db->prepare('SELECT COUNT(*) FROM users WHERE LOGIN = :login');
    $req->execute(array(
            'login' => $_POST["login"]));
    $verif = $req->fetchColumn();
    if ($verif != 0) {
      $err .= '<span class="label label-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Identifiant déjà utilisé.</span><br />';
    }
  }

  if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["password_conf"]) && isset($_POST["mail"]) && ($_POST["password_conf"] == $_POST["password"] && $verif == 0)) {
    
    $req = $db->prepare('INSERT INTO users(LOGIN, PASSWORD, MAIL) VALUES(:login, :password, :mail)');
    $req->execute(array(
            'login' => $_POST["login"],
            'password' => sha1($_POST["password"]),
            'mail' => $_POST["mail"]
            ));
    session_start();
    $_SESSION['login'] = $_POST['login'];
    header('Location: ./index.php');
    exit();
  }


  else {
  include('navbar.php');
  
   ?>
  <div class="container">
    <h1>S'inscrire</h1>
          <br />
          <br />
            <form role="form" class="form-horizontal" action="register.php" method="post" >
              <div class="form-group"> 
                <label for="login" class="control-label col-md-2">Identifiant :</label>
                <div class="col-md-4">
                  <input id="login" title="Identifiant" class="form-control" name="login" value='<?php if (isset($_POST["login"])) echo $_POST["login"]; ?>' placeholder="Identifiant" required autofocus>
                </div>
              </div>
              <div class="form-group"> 
                <label for="password" class="control-label col-md-2">Mot de passe :</label>
                <div class="col-md-4">
                  <input id="password" type="password" title="Mot de passe" class="form-control" placeholder="Mot de passe" name="password" required autofocus>
                </div>
              </div>
              <div class="form-group"> 
                <label for="password_conf" class="control-label col-md-2">Confirmation :</label>
                <div class="col-md-4">
                  <input id="password_conf" type="password" title="Mot de passe" class="form-control" placeholder="Mot de passe" name="password_conf" required autofocus>
                </div>
              </div>
              <div class="form-group"> 
                <label for="mail" class="control-label col-md-2">Adresse mail :</label>
                <div class="col-md-4">
                  <input id="mail" type="email" title="Mail" class="form-control" name="mail" value='<?php if (isset($_POST["mail"])) echo $_POST["mail"]; ?>' placeholder="azerty@azerty.fr" required autofocus>
                </div>
              </div>
              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-4">
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> S'inscrire</button>
                </div>
              </div>
              <p class="col-md-offset-2"><?php echo $err ?></p>
            </div>
            </form>
  </div>

</body>
</html>
<?php } ?>