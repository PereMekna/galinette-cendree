<?php try {
      $db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', '');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>