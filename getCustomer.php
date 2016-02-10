<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
		$q = $_GET['q'];

		try
			{
			$db = new PDO('mysql:host=localhost;dbname=i-tech', 'root', 'root');
			}
			catch (Exception $e)
			{
		        die('Erreur : ' . $e->getMessage());
			}

		$requete = $db->prepare("SELECT * FROM CLIENTS WHERE NUMERO = ?");
		$requete->execute(array($_GET['q']));

		while ($data = $requete->fetch())
		{
			echo '<div class="row"><label class="control-label col-md-4">Intitulé client :</label><div class="col-md-8"><p class="form-control-static">'.$data['NOM'].'</p></div></div>';
			echo '<div class="row"><label class="control-label col-md-4">Téléphone :</label><div class="col-md-8"><p class="form-control-static">'.$data['TEL'].'</p></div></div>';
			echo '<div class="row"><label class="control-label col-md-4">Mail :</label><div class="col-md-8"><p class="form-control-static">'.$data['MAIL'].'</p></div></div>';
		}
		?>
	</body>
</html>