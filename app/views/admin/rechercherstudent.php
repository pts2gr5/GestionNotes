<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
		<h1><?php echo $list_title ?></h1>
	</div>
	<div id="corps_titreEtSousMenu_sousMenu">
		<ul>
            <li><a href="<?php echo $this->url('admin/gererstudents') ?>">Voir tous</a></li>
            <li><a href="<?php echo $this->url('admin/rechercherstudent') ?>">Rechercher</a></li>
        </ul>
    </div>
</div>

<div id="corps_contenu">
<div id="corps_contenu_contenu">	
	<!-- Recherche par code apogée -->
	<div id="corps_contenu_titreEtSousTitre">
		<h2>Rechercher par code apogée</h2>
	</div>
	<form method="post" action="<?php echo $this->url('admin/rechercherstudent') ?>">
	<table class="formulaire">
		<tr>
			<td>Code apogée:</td>
			<td><input name="codeApogee" class="INPUT_text" type="text" size="8" /></td>
		</tr>
		<tr>
			<td><input class="INPUT_submit" type="submit" value="Rechercher" />
			</td>
		</tr>
	</table>
	</form>
	<!-- / Recherche par code apogée -->
	
	<br/><br/><br/><br/>
	<!-- Recherche par nom/prénom -->
	<div id="corps_contenu_titreEtSousTitre">
		<h2>Rechercher par nom/prénom</h2>
	</div>
	<form method="post" action="<?php echo $this->url('admin/rechercherstudent') ?>">
	<table class="formulaire">
		<tr>
			<td>Nom :</td>
			<td><input name="nom" class="INPUT_text" type="text" /></td>
		</tr>
		<tr>
			<td>Prénom :</td>
			<td><input name="prenom" class="INPUT_text" type="text" /></td>
		</tr>
		<tr>
			<td colspan="2"><input  class="INPUT_submit" type="submit" value="Rechercher" /></td>
		</tr>
	</table>
	</form>
</div>
</div>
			