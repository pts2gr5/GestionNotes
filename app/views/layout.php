<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $title; ?></title>

    <!--
    <link rel="stylesheet" type="text/css" media="screen" href="css/structure.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/tableau.css" />
    -->
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>/css/style.css" />
	
    <script type="text/javascript" src="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>/js/jquery.jcombo.min.js"></script>
    <script type="text/javascript" src="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo dirname($_SERVER['SCRIPT_NAME']) ?>/js/application.js"></script>
</head>
<body>
    <div class="header">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2"><a href="<?php echo $this->url('') ?>" class="logo"></a></div>
            <div class="span10">
        	    <?php if ( $this->app->getVisitor()->isLogged() ): ?>
                <ul>
        			<li><a href="<?php echo $this->url('security/profile') ?>">Paramètres</a></li> &ndash;
        			<li><a href="<?php echo $this->url('security/logout') ?>">Déconnexion</a></li>
                </ul>
                <?php endif ?>
        		</div>
            </div>
        </div>
    </div>
    </div>

    <div class="content">
    <div class="container-fluid">
        <?php if ( $this->visitor->isLogged() ): ?>
        <div class="row-fluid">
            <div class="span3">
                <div class="menu">
                    <h2><span>Menu</span></h2>
                    <ul>
                        <?php if ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_ADMIN ): ?>
                        <li><a href="<?php echo $this->url('admin') ?>">Accueil</a></li>
                        <li><a href="<?php echo $this->url('admin/etudiants') ?>">Gérer les étudiants</a></li>
                        <li class="puce"><a href="<?php echo $this->url('admin/etudiants/liste') ?>">Liste</a></li>
                        <li class="puce"><a href="<?php echo $this->url('admin/etudiants/ajouter') ?>">Ajouter</a></li>
                        <li class="puce"><a href="<?php echo $this->url('admin/promotions') ?>">Promotions</a></li>
                        <li class="puce"><a href="<?php echo $this->url('admin/etudiants/rechercher') ?>">Rechercher</a></li>
                        <li><a href="<?php echo $this->url('admin/formations') ?>">Gérer les formations</a></li>
                        <?php elseif ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_DIRETUDE ):  ?>
                        <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('diretude') ?>">Accueil</a></li>
                        <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('diretude/moyennes') ?>">Consulter les moyennes</a></li>
                        <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('diretude/consulterresultat') ?>">Consulter les résultats</a></li>
                        <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('diretude/apogee') ?>">Code Apogée</a></li>
                        <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('diretude/nom') ?>">Nom/Prénom</a></li>
                        <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('diretude/parcours') ?>">Parcours</a></li>
                        <?php elseif ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_ETUDIANT ): ?>
                        <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant') ?>">Accueil</a></li>
                        <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant/moyennes') ?>">Consulter les moyennes</a></li>
                        <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant/notes') ?>">Gestion des notes</a></li>
                        <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('etudiant/ajouternote') ?>">Ajouter une note</a></li>
                        <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant/simulations') ?>">Gestion des simulations</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
            <div class="span9">
                <?php echo $content ?>
            </div>
        </div>
        <?php else: ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $content ?>
            </div>
        </div>
        <?php endif ?>
    </div>
    </div>
<div id="footer">
	<span id="footer_copyright">&copy Gestion des notes - IUT de Laval</span>
	<span id="footer_groupe">PTS2 Groupe 5</span>
</div>

</body>
</html>