<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Licenses SMART</title>

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
  } ?>
  <div class="container">
    <div class="row">
       <div class="col-sm-8">
        <h1>Licenses SMART</h1>
      </div>
    </div>
    <div class="row">
      <form class="form-inline col-md-12">
        <div class="form-group">
          <input id="ville" type="text" placeholder="Ville" name="ville" class="form-control" />
        </div>
        <div class="form-group">
          <input id="etab" type="text" placeholder="Établissement" name="etab" class="form-control" />
        </div>
        <div class="form-group">
          <input id="modele" type="text" placeholder="Modèle" name="modele" class="form-control" />
        </div>
        <div class="form-group">
          <input id="sn" type="text" placeholder="S/N" name="sn" class="form-control" />
        </div>
        <div class="form-group">
          <input id="clef" type="text" placeholder="Clef de license" name="clef" class="form-control" />
        </div>
        <a class="btn btn-primary" id="search"><span class="glyphicon glyphicon-search"></span> Rechercher</a>
      </form>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Ville</th>
                <th>Établissement</th>
                <th>Modèle</th>
                <th>S/N</th>
                <th>Clef de license</th>
                <th>Validité</th>
                <th>Dernière version</th>
                <th><span class="glyphicon glyphicon-option-horizontal"></span></th>
              </tr>
            </thead>
            <tbody id="jtable">
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            Ajouter une nouvelle license
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="addSmartNS.php" method="post">
              <div class="form-group">
                <label for="ville" class="control-label col-md-4">Ville :</label>
                <div class="col-md-8">
                  <input type="text" placeholder="Ville" name="ville" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label for="etab" class="control-label col-md-4">Établissement :</label>
                <div class="col-md-8">
                  <input type="text" placeholder="Établissement" name="etab" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label for="modele" class="control-label col-md-4">Modèle :</label>
                <div class="col-md-8">
                  <input type="text" placeholder="Modèle" name="modele" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label for="clef" class="control-label col-md-4">Clef :</label>
                <div class="col-md-8">
                  <input type="text" placeholder="Clef" name="clef" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="control-label col-md-4">Date validité :</label>
                <div class="col-md-8">
                  <input type="date" name="date" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label for="version" class="control-label col-md-4">Version :</label>
                <div class="col-md-8">
                  <input type="text" placeholder="Numéro de version" name="version" class="form-control" />
                </div>
              </div>
              <div id="sn_area">
                <input id="cnt_ns" type="hidden" name="cnt_ns" />
                <div class="form-group">
                  <label for="sn1" class="control-label col-md-4">S/N 1 :</label>
                  <div class="col-md-8">
                    <input type="text" placeholder="S/N 1" name="sn1" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <div class="col-md-offset-4 col-md-4">
                    <a class="btn btn-success" id="add"><span class="glyphicon glyphicon-plus"></span>&nbsp;</a>
                  </div>
                </div>
              <div class="form-group">
                <div class="col-md-offset-4 col-md-4">
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Créer</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <script>
  var i = 1;
  $(document).ready(function () {
    $('#jtable').load('smartLT.php');
  });
  $( "#sn_auto" ).autocomplete({
      source: 'sn.php',
      minLength: 3});

  $("#add").click(function () {
    i++;
    $('<div class="form-group"><label for="sn'+i+'" class="control-label col-md-4">S/N '+i+' :</label><div class="col-md-8"><input type="text" placeholder="S/N '+i+'" name="sn'+i+'" class="form-control" id="sn'+i+'" /></div></div>').appendTo($("#sn_area"));
    $('#cnt_ns').val(i);
    $('#sn'+i).focus();
    return false;
  });

  $("#search").click(function () {
    $('#jtable').load('smartLT.php?ville='+$("#ville").val()+'&etab='+$("#etab").val()+'&modele='+$("#modele").val()+'&sn='+$("#sn").val()+'&clef='+$("#clef").val());
  })

  </script>
  </body>
</html>