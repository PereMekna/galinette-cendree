<?php 
require_once('../dbConn.php');
require_once('../inc/functions.php');
$max_row = $_GET['nb_row'];
$cat = $_GET['cat'];


    $count = 0;

    $requete = $db->prepare("SELECT * FROM tickets WHERE TYPE_CLIENT = :type_client AND TYPE_INTER <> 'sav' AND (AVANCEMENT = 'af' OR AVANCEMENT = 'ec' OR AVANCEMENT = 'arc' OR AVANCEMENT = 'ap' OR AVANCEMENT = 'arf') ORDER BY PRIORITE DESC");
    $requete->bindValue('type_client', $cat);
    $requete->execute();
    $nbrow = $requete->rowCount();
    $today = new DateTime();

    echo '<table class="table table-alert">';
    if ($nbrow == 0) {
        echo '<tr class="alert"><td>Pas de ticket ouvert dans cette catégorie.</td></tr>';
    }
    while ($data = $requete->fetch()) {
    	if ($data["PRIORITE"] == 0) $class = "alert alert-success";
    	else if ($data["PRIORITE"] == 1) $class = "alert alert-warning";
    	else $class = "alert alert-danger";

    	$datelivraison = new DateTime($data["DATE_LIVRAISON"]);
        if ($datelivraison > $today) {
            $days = $datelivraison->diff($today)->format('%d jour(s) restant(s)');
        }
    	else $days = $datelivraison->diff($today)->format('Dépassé de %r%a jour(s)');

    	echo '<tr class="clickable-row" data-href="../showTicket.php?id='.$data["ID"].'" ><td><strong>'.abbrToFull($data["AVANCEMENT"]).' : '.abbrToFull($data["TYPE_INTER"]).' pour '.$data["REF_CLIENT"].'.</strong> '.$days.'.</td><td class="'.$class.'">&nbsp;</td></tr>';
        if(++$count >= $max_row) break;
    }

    if ($nbrow > $max_row) echo '<tr><td>Encore <span class="badge">'.($nbrow-$max_row).'</span> autre(s) ticket(s)</td></tr>';

?>

</table>
<script>
  jQuery(document).ready(function($) {
      $(".clickable-row").click(function() {
          window.document.location = $(this).data("href");

      });
  });
  </script>