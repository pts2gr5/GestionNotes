<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Titre de la page</title>

<link rel="stylesheet" type="text/css" media="screen" href="css/structure.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/tableau.css" />

<!--[if IE 7]><![endif]-->
</head>
<body>

	<div id="header">
		<div id="header_logo"></div>
		<div id="header_partieDroite">
		<!-- Juste pour Etudiant -->
		<?php if(etudiant)
			<div id="partieDroite_ajouterUneNote">
				<a href="#">Ajouter une note</a>
			</div>
			
		?>
		<!-- Fin de la condition -->	
			<div id="partieDroite_parametre">
				<?php if(etudiant)
					if(connecte) <span> <a href="#">Paramètre</a></span> <span><a href="#">Déconnexion</a>
					if(pas_connecte) <span><a href="login.php">Connexion</a></span>
				?>
				
			</div>
		</div>
	</div>
	<div id="middle">
		<div id="menuGauche">
			<?php 
				if(DDE) include ('dde/menu_dde.php');
				else if (admin) include ('admin/menu_admin.php');
				else if (étudiant) include ('etudiant/menu_etudiant.php');
				else (rien); //pour les personnes non logué ? ça va faire moche non ?
			?>

		
		<div id="corps">
			<div id="corps_titreEtSousMenu">
				<div id="corps_titreEtSousMenu_titre">
					<h1>Titre de la page</h1>
				</div>
				<div id="corps_titreEtSousMenu_option">
					<img src="images/print.png" alt="Imprimer" />
				</div>
				<?php 
				if (il y a des sous-menu)
				//comment faire ça ?
				<div id="corps_titreEtSousMenu_sousMenu">
					
					<ul>
						<li><a href="#">Menu 1.1</a></li>
						<li><a href="#">Menu 1.2</a></li>
						<li><a href="#">Menu 1.3</a></li>
					</ul>
				</div>
				?>
			</div>
			<div id="corps_contenu">

			<?php	if (titre de type h2)
				{
				<!-- <div id="corps_contenu_titreEtSousTitre">
				<h2>Pierre Dupont (i120722)</h2>
				}
			?>
			<?php	if (titre de type h3)
				{
				<h3>dans INFO1 > Semestre 1 > TD11 > TP11A</h3>
				}
			?>
			</div>
			<?php	if ("si c'est une page de profil alors mettre l'étoile à droite du h2")
				{
			<div id="corps_contenu_optionDroite">
				<a href="#"><img src="images/favoris_plein.png" alt="favoris"/></a>
			</div>
			}
			?>
				<div id="corps_contenu_contenu">
					<!-- Corps de la page -->
					include (pageAinclure.php);
					<!-- Fin Corps de la page -->
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<span id="footer_copyright">©Gestion des notes - iut de Laval</span> <span
			id="footer_groupe">PTS2 Groupe 5</span>
	</div>


</body>
</html>

