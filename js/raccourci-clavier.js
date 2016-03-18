
// Keyboard Shortcuts
// Antoine AUGUSTI - antoine@augusti.fr
// Merci à Adrien COURTOIS pour son aide

var isG = false;

$(document).keydown(function(e)
{
	if (e.which == 16 || e.keyCode == 16)
	{ 
		isG = true; // si la touche SHIFT a été pressée
	}
}).keyup(function(e)
{
	if ($('input:focus').length > 0 || $('textarea:focus').length > 0 || isG != true)
	{ 
		isG = false; // Si on se trouve dans un input, une textarea ou si on n'a pas pressé la touche SHIFT, on ne peut pas faire des raccourcis clavier
		return false;
	}

	if (e.keyCode == true)
	{
		var key = e.keyCode;
	} 
	else 
	{
		var key = e.which;
	}

	switch (key) // On regarde la deuxième touche pressée par l'utilisateur
	{
		// SHIFT + J
		case 74:
			window.location.href = "./newTicket.php";
			return false;
			break;
	}
	
	isG = false; // On réinitialise le booléen
});