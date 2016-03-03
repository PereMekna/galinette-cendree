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
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css">

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
  ?>
  <div class="container">
      <h1>Nouveau ticket <small id="labprio" class="form-control-static">priorité : <span class="glyphicon glyphicon-ban-circle" /></small></h1>
        <br /><br />
          <form role="form" class="form-horizontal" action="addTicket.php" method="post" enctype="multipart/form-data" >
            <div class="form-group"> 
              <label for="customer" class="control-label col-md-2">Référence client :</label>
              <div class="col-md-4">
                <div class="input-group">
                <input id="autocomplete" title="Référence client" class="form-control" name="ref_client" required autofocus>
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
                  <option value="col"><?php echo abbrToFull('col') ?></option>
                  <option value="pro"><?php echo abbrToFull('pro') ?></option>
                  <option value="part"><?php echo abbrToFull('part') ?></option>
                  <option value="edu"><?php echo abbrToFull('edu') ?></option>
                </select>
              </div>
              <label for="datepicker" class="control-label col-md-2">Date de livraison :</label>
              <div class="col-md-4">
                <input type="date" class="form-control" id="datepicker" name="datepicker" />
              </div>
            </div>
            <div class="form-group">
              <label for="typeinter" class="control-label col-md-2">Type d'intervention :</label>
              <div class="col-md-4">
                <select id="typeinter" title="Type d'intervention" class="form-control" name="typeinter" required>
                  <option value="empty"></option>
                  <option value="atel"><?php echo abbrToFull('atel') ?></option>
                  <option value="maint"><?php echo abbrToFull('maint') ?></option>
                  <option value="mont"><?php echo abbrToFull('mont') ?></option>
                  <option value="sav"><?php echo abbrToFull('sav') ?></option>
                  <option value="site"><?php echo abbrToFull('site') ?></option>
                </select>
              </div>
              <label for="facturation" class="control-label col-md-2">Facturation :</label>
              <div class="col-md-4">
                <select id="facturation" title="Facturation" class="form-control" name="facturation" required>
                  <option value="fac">À facturer</option>
                  <option value="gar">Sous maintenance / garantie</option>
                </select>
              </div>
            </div>
            <div class="retsav">
            <div class="form-group"  id="retsav1" >
              <label for="bc" class="control-label col-md-2">Marque :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="marque" name="marque" />
              </div>
              <label for="bc" class="control-label col-md-2">Modèle :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="modele" name="modele" />
              </div>
            </div>
            <div class="form-group" display="none" id="retsav2" >
              <label for="bc" class="control-label col-md-2">N° série :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="no" name="noserie" />
              </div>
            </div>
          </div>
            <div class="form-group">
              <label for="bc" class="control-label col-md-2">N° bon de commande :</label>
              <div class="col-md-4">
                  <input type="text" class="form-control" id="bc" name="bc" />
              </div>
              <label for="priorite" class="control-label col-md-2">Priorité :</label>
              <div class="col-md-4">
                <div class="btn-group">
                  <button type="button" id="low" class="btn btn-success">Basse</button>
                  <button type="button" id="mid" class="btn btn-warning">Moyenne</button>
                  <button type="button" id="high" class="btn btn-danger">Haute</button>
                </div>
                <input type="hidden" id="labpriohidden" name="labpriohidden" />
              </div>
            </div>
            <div class="form-group">
              <label for="text1" class="control-label col-md-2">Description du ticket :</label>
              <div class="col-md-4">
                <textarea id="text1" class="form-control" rows="5" required title="Description " name="description"></textarea>
              </div>
              <label for="bc" class="control-label col-md-2">Fichier(s) à ajouter :</label>
              <div class="col-md-4">
                  <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>Select files...</span>
                      <!-- The file input field used as target for the file upload widget -->
                      <input id="fileupload" type="file" name="files[]" multiple>
                  </span>
                  <br>
                  <br>
                  <!-- The global progress bar -->
                  <div id="progress" class="progress">
                      <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <!-- The container for the uploaded files -->
                  <div id="files" class="files"></div>
              </div>
              
              </div>
            <div class="form-group"> 
                <div class="col-md-offset-2 col-md-4">
                  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Ajouter le ticket</button>
                </div>
              </div>
            </div>
        </form>
    </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <!-- The basic File Upload plugin -->
  <script src="js/jquery.fileupload.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
      $(function() {
        $('.retsav').hide();
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

    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = window.location.hostname === 'blueimp.github.io' ?
                    '//jquery-file-upload.appspot.com/' : 'server/php/';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
    </script>
  </body>
</html>