	<form>
		<?php
		$q = $_GET['q'];
		echo '<input type="hidden" id="hiddenid" value="'.$q.'" />';

		require_once('dbConn.php');

		$requete = $db->prepare("SELECT * FROM clients WHERE NUMERO = :numero");
		$requete->execute(array('numero' => $_GET['q']));

		while ($data = $requete->fetch())
		{
			echo '<div class="form-group"><label class="control-label col-md-4">Intitulé client :</label><div class="col-md-8"><p class="form-control-static">'.$data['NOM'].'</p></div></div>';
			echo '<div class="form-group"><label class="control-label col-md-4">Téléphone :</label><div class="col-md-8"><input id="telephone" class="form-control"  value="'.$data['TEL'].'" /></div></div>';
			echo '<div class="form-group"><label class="control-label col-md-4">Mail :</label><div class="col-md-8"><input id="mail" class="form-control" value="'.$data['MAIL'].'" /></div></div>';
		}
		?>

		<div class="pull-right"><a class="btn btn-default" href="#" id="update"><span class="glyphicon glyphicon-refresh"></span></a></div>
		<div id="info"></div>
</form>