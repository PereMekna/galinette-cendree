<?php 
    require_once('dbConn.php');

    $count = 0;

    $requete = $db->prepare("SELECT * FROM tickets WHERE TYPE_CLIENT = :type_client AND (AVANCEMENT = 'af' OR AVANCEMENT = 'ec' OR AVANCEMENT = 'arc' OR AVANCEMENT = 'ap' OR AVANCEMENT = 'arf') ORDER BY PRIORITE DESC");
    $requete->bindValue(':type_client', $cat);
    $requete->execute();
    $nbrow = $requete->rowCount();
    $today = new DateTime();

    echo '<div class="panel panel-default">
        <div class="panel-heading">'.abbrToFull($cat).' <span class="badge">'.$nbrow.'</span></div>
        <div class="panel-body">';
    if ($nbrow == 0) {
        echo '<p>Pas de ticket ouvert dans cette catégorie.</p>';
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

    	echo '<a class="alert-link" href="showTicket.php?id='.$data['ID'].'" ><div class="'.$class.'">
          <strong>'.abbrToFull($data["AVANCEMENT"]).' : '.abbrToFull($data["TYPE_INTER"]).' pour '.$data["REF_CLIENT"].'.</strong> '.$days.'.</div></a>';
        if(++$count >= $max_row) break;
    }

    if ($nbrow > $max_row) echo '<a class="btn btn-default" href="allTickets.php">Tickets suivants <span class="badge">'.($nbrow-$max_row).'</span></a>';

?>

</div>
</div>

