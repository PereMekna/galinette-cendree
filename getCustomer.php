
		<?php
		$q = $_GET['q'];

		require_once('dbConn.php');

		$requete = $db->prepare("SELECT * FROM clients WHERE NUMERO = :numero");
		$requete->execute(array('numero' => $_GET['q']));

		while ($data = $requete->fetch())
		{
			echo '<div class="row"><label class="control-label col-md-4">Intitulé client :</label><div class="col-md-8"><p class="form-control-static">'.$data['NOM'].'</p></div></div>';
			echo '<div class="row"><label class="control-label col-md-4">Téléphone :</label><div class="col-md-8"><p class="form-control-static">'.$data['TEL'].'</p></div></div>';
			echo '<div class="row"><label class="control-label col-md-4">Mail :</label><div class="col-md-8"><p class="form-control-static">'.$data['MAIL'].'</p></div></div>';
		}
		?>