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
            <?php if ( $this->app->getVisitor()->isLogged() ): ?>
			<span><a href="<?php echo $this->url('security/profile') ?>">Paramètres</a></span>
            &ndash;
			<span><a href="<?php echo $this->url('security/logout') ?>">Déconnexion</a></span>
            <?php endif ?>
		</div>
	</div>
</div>
<div id="middle">
    <?php if ( $this->app->getVisitor()->isLogged() ): ?>
	<div id="menuGauche">
		<div class="menu">
			<div class="moduleTitre"><span>Menu</span></div>
			<div class="moduleCorps"> 
				<ul>
					<li class="moduleCorps_titreListeAPuce"><a href="#">Menu 1</a></li>
					<li class="moduleCorps_listeAPuce"><a href="#">Menu 1.1</a></li>
					<li class="moduleCorps_listeAPuce"><a href="#">Menu 1.2</a></li>
					<li class="moduleCorps_titreListeAPuce"><a href="#">Menu 1</a></li>
				</ul>
			</div>
		</div>
    </div>
    
    <div id="corps">
	    <?php echo $content ?>
    </div>
    <?php else: ?>
        <?php echo $content ?>
    <?php endif ?>
</div>
<div id="footer">
<div id="footer-container">
	<span id="footer_copyright">&copy Gestion des notes - IUT de Laval</span>
	<span id="footer_groupe">PTS2 Groupe 5</span>
</div>
</div>

</body>
</html>