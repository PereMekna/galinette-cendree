<?php

function abbrToFull($str) {
	if ($str == 'col') {
	    $str = 'Collectivité';
	  }
	  else if ($str == 'pro') {
	    $str = 'Professionnel';
	  }
	  else if ($str == 'part') {
	    $str = 'Particulier';
	  }
	  else if ($str == 'edu') {
	    $str = 'Éducation';
	  }
	  else if ($str == 'atel') {
	    $str = 'Atelier';
	  }
	  else if ($str == 'maint') {
	    $str = 'Maintenance';
	  }
	  else if ($str == 'mont') {
	    $str = 'Montage';
	  }
	  else if ($str == 'sav') {
	    $str = 'Retour SAV';
	  }
	  else if ($str == 'site') {
	    $str = 'Intervention sur site';
	  }
	  else if ($str == 'af') {
	    $str = 'A faire';
	  }
	  else if ($str == 'ec') {
	    $str = 'En cours';
	  }
	  else if ($str == 'arc') {
	    $str = 'En attente réponse client';
	  }
	  else if ($str == 'arf') {
	  	$str = 'En attente fournisseur/fabricant';
	  }
	  else if ($str == 'ap') {
	    $str = 'En attente pièce(s)';
	  }
	  else if ($str == 'te') {
	    $str = 'Terminé';
	  }
	  else if ($str == 'tl') {
	    $str = 'Terminé à livrer';
	  }
	  else if ($str == '0') {
	    $str = 'Priorité basse';
	  }
	  else if ($str == '1') {
	    $str = 'Priorité moyenne';
	  }
	  else if ($str == '2') {
	    $str = 'Priorité haute';
	  }

	  return $str;
}

?>