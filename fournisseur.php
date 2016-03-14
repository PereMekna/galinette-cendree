<?php session_start();
require_once('dbConn.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Fournisseurs</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ 
                selector:'textarea',
                height: '400' });</script>
</head>
<body>
  <?php 
  include('navbar.php');
  if (!isset($_SESSION["login"])) {
    header('Location: ./login.php');
    exit();
  }
  $req = $db->query('SELECT * FROM content WHERE ID ="fournisseur"');
  $reponse = $req->fetch(); ?>
  <div class="container">

    <div class="row">
      <div class="col-md-10">
        <div id="editor"><?php echo $reponse['CONTENT']; ?></div>
        <div id="editorarea" style="display:none; height:100%">
          <textarea id="editortext"><?php echo $reponse['CONTENT']; ?></textarea>
        </div>
      </div>
      <div class="col-md-2 top-buffer-sm">
        <a href="#" id="btn" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div id="info-fournisseur"><p>Édité par : <?php echo $reponse['USER']; ?>, <?php echo $reponse['DATE_MODIF']; ?></p></div>
      </div>
    </div>
    
  </div>
  <script>
  $(document).ready(function() {
    $("#editor").html(tinymce.activeEditor.getContent());
  });
  $('#btn').click(function() {
    if ($('#btn').hasClass('active')) {
      $("#editor").html(tinymce.activeEditor.getContent());
      $("#editorarea").hide();
      $("#editor").fadeIn();
      $(this).toggleClass('active');
      $.post('fournisseurUpdate.php',
      {
        id: 'fournisseur',
        content: tinymce.activeEditor.getContent()
      });
    }
    else {
      $("#editor").html(tinymce.activeEditor.getContent());
      $("#editorarea").fadeIn();
      $("#editor").hide();
      $(this).toggleClass('active');
    }
      
  });

  </script>
</body>
</html>