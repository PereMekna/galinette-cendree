<?php 
    require_once('dbConn.php');

    $count = 0;
    $req = "SELECT * FROM tickets WHERE TYPE_CLIENT = ? ORDER BY PRIORITE DESC";
    $requete = $db->prepare($req);
    $requete->execute(array($cat));
    $nbrow = $db->query("SELECT FOUND_ROWS()")->fetchColumn();

    echo '<div class="panel panel-default">
        <div class="panel-heading">'.abbrToFull($cat).' <span class="badge">'.$nbrow.'</span></div>
        <div class="panel-body">';

    while ($data = $requete->fetch(PDO::FETCH_ASSOC)) {
    	if ($data["PRIORITE"] == 0) $class = "alert alert-success";
    	else if ($data["PRIORITE"] == 1) $class = "alert alert-warning";
    	else $class = "alert alert-danger";

    	$datelivraison = new DateTime($data["DATE_LIVRAISON"]);
    	$days = $datelivraison->diff(new DateTime())->format('%d jour(s)');

    	echo '<a class="alert-link" href="showTicket.php?id='.$data['ID'].'" ><div class="'.$class.'">
          <strong>'.abbrToFull($data["AVANCEMENT"]).' : '.abbrToFull($data["TYPE_INTER"]).' pour '.$data["REF_CLIENT"].'.</strong> '.$days.' restant(s).</div></a>';
        if(++$count >= $max_row) break;
    }

    if ($nbrow > $max_row) echo '<a class="btn btn-default" href="allTickets.php">Tickets suivants <span class="badge">'.($nbrow-$max_row).'</span></a>';

?>

</div>
</div>

