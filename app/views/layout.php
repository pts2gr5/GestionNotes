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
	<a href="<?php echo $this->url('') ?>" id="header_logo"></a>
	<div id="header_partieDroite">
	<?php if ( $this->app->getVisitor()->isLogged() ): ?>
	<?php if ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_ETUDIANT ): ?>
	<div id="partieDroite_ajouterUneNote"><a href="<?php echo $this->url('etudiant/ajouternote') ?>">Ajouter une note</a></div>
	 <?php endif ?>
	
		<div id="partieDroite_parametre">
            
			<span><a href="<?php echo $this->url('security/profile') ?>">Paramètres</a></span>
            &ndash;
			<span><a href="<?php echo $this->url('security/logout') ?>">Déconnexion</a></span>
            <?php endif ?>
		</div>
	</div>
</div>
<div id="middle">
    <?php if ( $this->visitor->isLogged() ): ?>
	<div id="menuGauche">
		<div class="menu">
			<div class="moduleTitre"><span>Menu</span></div>
			<div class="moduleCorps">
                <ul>
                    
                    <?php if ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_ADMIN ): ?>
                     <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('admin/accueil') ?>">Accueil</a></li>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('admin/students') ?>">Gérer les étudiants</a></li>
                    <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('admin/gererstudents') ?>">Gérer</a></li>
                    <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('admin/ajouterstudents') ?>">Ajouter</a></li>
                     <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('admin/groupes') ?>">Groupes</a></li>
                      <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('admin/rechercherstudent') ?>">Rechercher</a></li>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('admin/formations') ?>">Gérer les formations</a></li>
                    <?php elseif ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_DIRETUDE ):  ?>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('diretude/accueil') ?>">Accueil</a></li>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('diretude/moyennes') ?>">Consulter les moyennes</a></li>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('diretude/consulterresultat') ?>">Consulter les résultats</a></li>
                    <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('diretude/apogee') ?>">Code Apogée</a></li>
                    <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('diretude/nom') ?>">Nom/Prénom</a></li>
                    <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('diretude/parcours') ?>">Parcours</a></li>
                    <?php elseif ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_ETUDIANT ): ?>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant/accueil') ?>">Accueil</a></li>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant/moyennes') ?>">Consulter les moyennes</a></li>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant/notes') ?>">Gestion des notes</a></li>
                    <li class="moduleCorps_listeAPuce"><a href="<?php echo $this->url('etudiant/ajouternote') ?>">Ajouter une note</a></li>
                    <li class="moduleCorps_titreListeAPuce"><a href="<?php echo $this->url('etudiant/simulations') ?>">Gestion des simulations</a></li>
                    <?php endif ?>
                </ul>
			</div>
			
	</div>
	<?php if ( $this->visitor['type'] == GestionNotes_Model_User::TYPE_DIRETUDE):  ?>
		<div id="menu_recherche" class="menu">
			<div class="moduleTitre"><span>Recherche</span></div>
				<div class="moduleCorps">
					<form method="#" action="#">
						<input class="INPUT_text" type="text" name="valeur" placeholder="ex: i12687"/>
						<input class="INPUT_submit" type="submit" value="Rechercher" />
					</form>			
				</div>
		</div>
		
		
		<div id="menu_favroris_eleve" class="menu">
			<div class="moduleTitre"><span>Favoris</span></div>
			<div class="moduleCorps"> 
				<ul>
					<li class="moduleCorps_FAVORIS_listeAPuce"><a href="#">Pierre Paul a a a a a a a</a></li>
					<li class="moduleCorps_FAVORIS_listeAPuce"><a href="#">Truc Muche</a></li>
					<li class="moduleCorps_FAVORIS_listeAPuce"><a href="#">Lili Plop</a></li>
					<li class="moduleCorps_FAVORIS_listeAPuce"><a href="#">Riri pepe</a></li>
				</ul>
			<!-- Que si nb > 10 -->	<span id="menuFavorisEleveVoirTous"><a href="#">Voir tous</a></span>
			</div>
		</div>
	<?php endif ?>
    </div>
    
    <div id="corps">
	    <?php echo $content ?>
    </div>
    <?php else: ?>
        <?php echo $content ?>
    <?php endif ?>
</div>

<div id="footer">
	<span id="footer_copyright">&copy Gestion des notes - IUT de Laval</span>
	<span id="footer_groupe">PTS2 Groupe 5</span>
</div>


</body>
</html>