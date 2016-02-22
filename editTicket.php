<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Nouveau ticket - i-tech</title>

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
  require_once('dbConn.php');
  $id = $_GET['id'];
  $reponse = $db->query('SELECT * FROM tickets where ID='.$id);
  $reponsedesc = $db->query('SELECT * FROM descriptions where N_TICKET='.$id);
  $requete = $db->prepare("SELECT * FROM clients WHERE NUMERO = ?");
  while ($data = $reponse->fetch()) {
    $ref_client = $data["REF_CLIENT"];
    $type_client = $data["TYPE_CLIENT"];
    $type_inter = $data["TYPE_INTER"];
    $date_livraison = $data["DATE_LIVRAISON"];
    $facturation = $data["FACTURATION"];
    $n_bc = $data["N_BC"];
    $priorite = $data["PRIORITE"];
    $avancement = abbrToFull($data["AVANCEMENT"]);
  }


  $requete->execute(array($ref_client));
  while ($data = $requete->fetch()) {
    $intitule = $data["NOM"];
    $mail = $data["MAIL"];
    $tel = $data["TEL"];
  }

  if ($type_inter == "sav") {
    $requete = $db->prepare("SELECT * FROM sav WHERE N_TICKET = ?");
    $requete->execute(array($id));
    $sav_marque = "non renseigné";
    $sav_modele = "non renseigné";
    $sav_n_serie = "non renseigné";
    while ($data = $requete->fetch()) {
      $sav_marque = $data["MARQUE"];
      $sav_modele = $data["MODELE"];
      $sav_n_serie = $data["N_SERIE"];
    }
  }
  ?>
  <div class="container">
      <h1>Édition du ticket pour <?php echo $intitule ?> <small id="labprio" class="form-control-static">priorité : <span class="glyphicon glyphicon-ban-circle" /></small></h1>
        <br /><br />
          <form role="form" class="form-horizontal" action="editTicketDB.php" method="post" enctype="multipart/form-data" >
            <div class="form-group"> 
              <label for="customer" class="control-label col-md-2">Référence client :</label>
              <div class="col-md-4">
                <div class="input-group">
                <input id="autocomplete" title="Référence client" class="form-control" name="ref_client" value="<?php echo $ref_client ?>" required autofocus>
                <span class="input-group-btn">
                  <button id="lock" class="btn btn-default" type="button" disabled><span class="glyphicon glyphicon-pencil"></span>&nbsp;</button>
                </span>
              </div>
            </div>
              <div class="container col-md-6 top-buffer-xs top-buffer-sm">
              <div class="panel panel-default">
              <div id="description" class="panel-body">
                <span class="glyphicon glyphicon-exclamation-sign"></span> Rentrez une référence client
              </div>
              </div>
              </div>
            </div>
            <div class="form-group">
              <label for="typeclient" class="control-label col-md-2">Type de client :</label>
              <div class="col-md-4">
                <select id="typeclient" title="Type de client" class="form-control" name="typeclient" required>
                  <option value="empty"></option>
                  <option value="col" <?php if ($type_client == 'col') echo 'selected'; ?>><?php echo abbrToFull('col') ?></option>
                  <option value="pro" <?php if ($type_client == 'pro') echo 'selected'; ?>><?php echo abbrToFull('pro') ?></option>
                  <option value="part" <?php if ($type_client == 'part') echo 'selected'; ?>><?php echo abbrToFull('part') ?></option>
                  <option value="edu" <?php if ($type_client == 'edu') echo 'selected'; ?>><?php echo abbrToFull('edu') ?></option>
                </select>
              </div>
              <label for="datepicker" class="control-label col-md-2">Date de livraison :</label>
              <div class="col-md-4">
                <input type="date" class="form-control" id="datepicker" name="datepicker" value="<?php echo $date_livraison ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="typeinter" class="control-label col-md-2">Type d'intervention :</label>
              <div class="col-md-4">
                <select id="typeinter" title="Type d'intervention" class="form-control" name="typeinter" required>
                  <option value="empty"></option>
                  <option value="atel" <?php if ($type_inter == 'atel') echo 'selected'; ?>><?php echo abbrToFull('atel') ?></option>
                  <option value="maint" <?php if ($type_inter == 'maint') echo 'selected'; ?>><?php echo abbrToFull('maint') ?></option>
                  <option value="mont" <?php if ($type_inter == 'mont') echo 'selected'; ?>><?php echo abbrToFull('mont') ?></option>
                  <option value="sav" <?php if ($type_inter == 'sav') echo 'selected'; ?>><?php echo abbrToFull('sav') ?></option>
                  <option value="site" <?php if ($type_inter == 'site') echo 'selected'; ?>><?php echo abbrToFull('site') ?></option>
                </select>
              </div>
              <label for="facturation" class="control-label col-md-2">Facturation :</label>
              <div class="col-md-4">
                <select id="facturation" title="Facturation" class="form-control" name="facturation" required>
                  <option value="fac" <?php if ($facturation == '1') echo 'selected'; ?>>À facturer</option>
                  <option value="gar" <?php if ($facturation == '0') echo 'selected'; ?>>Sous maintenance / garantie</option>
                </select>
              </div>
            </div>
            <div class="retsav">
            <div class="form-group"  id="retsav1" >
              <label for="bc" class="control-label col-md-2">Marque :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="marque" name="marque" value="<?php echo $sav_marque ?>" />
              </div>
              <label for="bc" class="control-label col-md-2">Modèle :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="modele" name="modele" value="<?php echo $sav_modele ?>" />
              </div>
            </div>
            <div class="form-group" display="none" id="retsav2" >
              <label for="bc" class="control-label col-md-2">N° série :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="no" name="noserie" value="<?php echo $sav_n_serie ?>" />
              </div>
            </div>
          </div>
            <div class="form-group">
              <label for="bc" class="control-label col-md-2">N° bon de commande :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="bc" name="bc" value="<?php echo $n_bc ?>" />
              </div>
              <label for="priorite" class="control-label col-md-2">Priorité :</label>
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" id="low" class="btn btn-success">Basse</button>
                  <button type="button" id="mid" class="btn btn-warning">Moyenne</button>
                  <button type="button" id="high" class="btn btn-danger">Haute</button>
                </div>
                <input type="hidden" id="labpriohidden" name="labpriohidden" />
                <input type="hidden" name="ticket_hidden" value="<?php echo $id; ?>" />
              </div>
            </div>
            <div class="form-group"> 
                <div class="col-md-offset-2 col-md-4">
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Éditer le ticket</button>
                </div>
              </div>
            </div>
        </form>
    </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
      $(document).ready(function(){
        if($('#typeinter').val() == 'sav') {
            $('.retsav').fadeIn();
        } else {
            $('.retsav').fadeOut(); 
        } 
      });

      $(function() {
        showCustomer("<?php echo $ref_client ?>");
        $("#autocomplete").prop("readonly", true);
        $("#lock").prop("disabled", false);
      $('#typeinter').change(function(){
          if($('#typeinter').val() == 'sav') {
              $('.retsav').fadeIn();
          } else {
              $('.retsav').fadeOut(); 
          } 
      });
  });

    function showCustomer(str) {
    if (str == "") {
        document.getElementById("description").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("description").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","./getCustomer.php?q="+str,true);
        xmlhttp.send();
    }
}
    $( "#autocomplete" ).autocomplete({
      source: 'liste.php',
      minLength: 3,
      select : function(event, ui){ // lors de la sélection d'une proposition
        showCustomer(ui.item.value); // on ajoute la description de l'objet dans un bloc
        $("#autocomplete").prop("readonly", true);
        $("#lock").prop("disabled", false);
      }
    });
    $( "#dialog-link, #icons li" ).hover(
      function() {
        $( this ).addClass( "ui-state-hover" );
      },
      function() {
        $( this ).removeClass( "ui-state-hover" );
      }
    );
    $(".btn-group > .btn").click(function(){
        $(".btn-group > .btn").removeClass("active");
        $(this).addClass("active");
    });

    $("#low").click(function(){
      $("#labprio").text("priorité : basse");
      $("#labpriohidden").val("0");
    });

    $("#mid").click(function(){
      $("#labprio").text("priorité : moyenne");
      $("#labpriohidden").val("1");
    });

    $("#high").click(function(){
      $("#labprio").text("priorité : haute");
      $("#labpriohidden").val("2");
    });

    $("#typeclient").change(function(){
      if ($("#typeclient").val() == "col" || $("#typeclient").val() == "pro" || $("#typeclient").val() == "edu") {
        var n = 5;
      }
      else var n = 7;
      var date = new Date();
      date.setDate(date.getDate() + n);
      var day = ("0" + date.getDate()).slice(-2);
      var month = ("0" + (date.getMonth() + 1)).slice(-2);
      var parsedate = date.getFullYear()+"-"+(month)+"-"+(day) ;
      $("#datepicker").val(parsedate);

    });

    $("#lock").click(function(){
      $("#autocomplete").prop("readonly", false);
      $("#lock").prop("disabled", true);
    });
    </script>
  </body>
</html>