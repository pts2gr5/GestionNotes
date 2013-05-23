<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title><?php echo $title; ?></title>

	<link rel="stylesheet" type="text/css" media="screen" href="css/structure.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/tableau.css" />
	
	<!--[if IE 7]><![endif]-->
</head>
<body>

<div id="header">
	<div id="header_logo"></div>
	<div id="header_partieDroite">
		<div id="partieDroite_parametre">
			<span><a href="#">Paramètres</a></span>
            &ndash;
			<span><a href="#">Déconnexion</a></span>
		</div>
	</div>
</div>
<div id="middle">
	<?php echo $content ?>
</div>
<div id="footer">
<div id="footer-container">
	<span id="footer_copyright">&copy Gestion des notes - IUT de Laval</span>
	<span id="footer_groupe">PTS2 Groupe 5</span>
</div>
</div>

</body>
</html>