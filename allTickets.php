<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tickets - i-tech</title>

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
        <h1>Liste des tickets</h1>
      </div>
      <div class="col-sm-4">
        <div class="pull-right">
        <a class="btn btn-success" href="newTicket.php"><span class="glyphicon glyphicon-plus"></span> Nouveau ticket</a>
      </div>
      </div>
    </div>
    <div class="row top-buffer-xs">
      <div class="col-md-6 col-sm-8 col-xs-12">
        <div class="input-group">
          <input type="text" id="search" class="form-control" placeholder="Recherche (référence client, n° BC ou description)" /> 
          <span class="input-group-btn">
            <button id="search_btn" class="btn btn-default" type="button" ><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
          </span>
        </div>
      </div>
      <div class="col-md-6 col-sm-4 col-xs-12 top-buffer-xs">
        <div class="pull-right">
        <span class="dropdown">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span>&nbsp;<span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Afficher les catégories</li>
            <li><a href="#" class="small" data-value="atel" tabIndex="-1"><input type="checkbox" checked />&nbsp;Atelier</a></li>
            <li><a href="#" class="small" data-value="maint" tabIndex="-1"><input type="checkbox" checked />&nbsp;Maintenance</a></li>
            <li><a href="#" class="small" data-value="mont" tabIndex="-1"><input type="checkbox" checked />&nbsp;Montage</a></li>
            <li><a href="#" class="small" data-value="sav" tabIndex="-1"><input type="checkbox" checked />&nbsp;Retour SAV</a></li>
            <li><a href="#" class="small" data-value="site" tabIndex="-1"><input type="checkbox" checked />&nbsp;Intervention sur site</a></li>
          </ul>
        </span>
        <span class="dropdown">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;<span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Type de client</li>
            <li><a href="#" class="small" data-value="pro" tabIndex="-1"><input type="checkbox" checked />&nbsp;Professionel</a></li>
            <li><a href="#" class="small" data-value="part" tabIndex="-1"><input type="checkbox" checked />&nbsp;Particulier</a></li>
            <li><a href="#" class="small" data-value="col" tabIndex="-1"><input type="checkbox" checked />&nbsp;Collectivité</a></li>
            <li><a href="#" class="small" data-value="edu" tabIndex="-1"><input type="checkbox" checked />&nbsp;Éducation</a></li>
          </ul>
        </span>
      </div>
    </div>
  </div>
      <div class="table-responsive top-buffer-xs">
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Référence client</th>
          <th>Date de livraison</th>
          <th>Description</th>
          <th>Avancement</th>
          <th>N° BC</th>
          <th><span class="glyphicon glyphicon-bell"></span></th>
        </tr>
      </thead>
      <tbody id="jtable">
        </tbody>
        </table>
      </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="jquery-ui.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script>
        var options = ["maint", "atel", "mont", "sav", "site", "pro", "part", "col", "edu"];


        $( '.dropdown-menu a' ).on( 'click', function( event ) {

           var $target = $( event.currentTarget ),
               val = $target.attr( 'data-value' ),
               $inp = $target.find( 'input' ),
               idx;

           if ( ( idx = options.indexOf( val ) ) > -1 ) {
              options.splice( idx, 1 );
              setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
           } else {
              options.push( val );
              setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
           }

           $( event.target ).blur();
           var url = 'lt.php?';
           $.each( options, function( index, value ) {
             switch (value) {
                case 'atel': url+='atel=1&'; break;
                case 'maint': url+='maint=1&'; break;
                case 'mont': url+='mont=1&'; break;
                case 'sav': url+='sav=1&'; break;
                case 'site': url+='site=1&'; break;
                case 'pro': url+='pro=1&'; break;
                case 'part': url+='part=1&'; break;
                case 'col': url+='col=1&'; break;
                case 'edu': url+='edu=1&'; break;
             }
           });
            url = url.substring(0,url.length-1);              
           $('#jtable').load(url);           
           return false;

        });

        jQuery(document).ready(function($) {
          $('#jtable').load('lt.php');
            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");

            });
        });

        $('#search').change(function() {
          var url = 'lt.php?';
          $.each( options, function( index, value ) {
            switch (value) {
               case 'atel': url+='atel=1&'; break;
               case 'maint': url+='maint=1&'; break;
               case 'mont': url+='mont=1&'; break;
               case 'sav': url+='sav=1&'; break;
               case 'site': url+='site=1&'; break;
               case 'pro': url+='pro=1&'; break;
               case 'part': url+='part=1&'; break;
               case 'col': url+='col=1&'; break;
               case 'edu': url+='edu=1&'; break;
            }
          });
           url = url.substring(0,url.length-1);
           console.log( options);
           if ($('#search').val() != '') {
            url += '&search='+$('#search').val();
           }
             
          $('#jtable').load(url);
        });



        </script>
        <?php
        //$reponse->closeCursor(); ?>
  
  </body>
</html>
