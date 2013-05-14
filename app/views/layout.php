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
		<div id="partieDroite_ajouterUneNote"><a href="#">Ajouter une note</a></div><!-- Juste pour Etudiant -->
		<div id="partieDroite_parametre">
			<span><a href="#">Paramètre</a></span>
			<span><a href="#">Déconnexion</a></span>
		</div>
	</div>
</div>
<div id="middle">
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
		
		<div id="menu_recherche" class="menu">
			<div class="moduleTitre"><span>Recherche</span></div>
				<div class="moduleCorps">
					<form method="#" action="#">
						<input class="INPUT_text" type="text" name="valeur" value="ex: i12687"/>
						<input class="INPUT_submit" type="submit"/>
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
		
	</div>
	<div id="corps">
		<div id="corps_titreEtSousMenu">
			<div id="corps_titreEtSousMenu_titre">
			<h1>Titre de la page fdg du chien</h1>
			</div>
			<div id="corps_titreEtSousMenu_option"><img src="images/print.png" alt="Imprimer" /></div>
			<div id="corps_titreEtSousMenu_sousMenu">
			<ul><li><a href="#">Menu 1.1</a></li><li><a href="#">Menu 1.2</a></li><li><a href="#">Menu 1.3</a></li></ul>
			</div>
			
		</div>
		<div id="corps_contenu">
			<div id="corps_contenu_titreEtSousTitre">
				<h2>Pierre Dupont (i120722)</h2>
				<h3>dans INFO1 > Semestre 1 > TD11 > TP11A</h3>
			</div>
			<div id="corps_contenu_optionDroite">
				<a href="#"><img src="images/favoris_plein.png" alt="favoris"/></a>
			</div>
			<div id="corps_contenu_contenu">
			
			
			<table class="tableauTailleMini" cellspacing="0">
				<tr class="entete">
					<td width="60%">Matière</td>
					<td>Coeff.</td>
					<td>Note</td>
					<td>Moy.</td>
				</tr>
				<tr class="hoverable">
					<td class="UE">UE Générale</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr>
				<tr class="hoverable">
					<td class="MODULE">Module</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr>
				<tr class="hoverable">
					<td class="MATIERE clickable">Matière</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr>
				<tr class="hoverable good">
					<td class="MATIERE clickable">Matière</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr>
				<tr class="hoverable bad">
					<td class="MATIERE clickable">Matière</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr>
				<tr class="hoverable">
					<td class="MODULE">Module</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr>
				<tr class="hoverable">
					<td class="MATIERE clickable">Matière</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr><tr class="hoverable">
					<td class="MATIERE clickable">Matière</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr><tr class="hoverable medium">
					<td class="MATIERE clickable">Matière</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr><tr class="hoverable">
					<td class="MATIERE clickable">Matière</td>
					<td>2</td>
					<td>Note</td>
					<td>1</td>
				</tr>
			</table>
			<div id="ajouterUneNoteACoteDuTableau">
				<span>Gestion de l'Informatique</span>
				
				<form method="#" action="#">
					<br/>
					<label for="Epreuve">Epreuve :</label> <input class="INPUT_text" type="text" name="epreuve"/><br/> 
					<label for="Note">Note (Coef 2) :</label> <input class="INPUT_text" type="text" name="note"/><br/>
					<input class="INPUT_submit" type="submit" value="Ajouter"/>
				</form>
			</div>
			
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<span id="footer_copyright">&copy Gestion des notes - iut de Laval</span>
	<span id="footer_groupe">PTS2 Groupe 5</span>
</div>

          
</body>
</html>