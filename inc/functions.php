<?php

function abbrToFull($str) {
	if ($str == 'col') {
	    $str = 'Collectivités';
	  }
	  else if ($str == 'pro') {
	    $str = 'Professionnels';
	  }
	  else if ($str == 'part') {
	    $str = 'Particuliers';
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

	  return $str;
}