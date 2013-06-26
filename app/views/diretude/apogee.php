<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
		<h1><?php echo $list_title ?></h1>
	</div>

	<div id="corps_titreEtSousMenu_sousMenu">
		<ul>
			<li><a href="<?php echo $this->url('diretude/parcours') ?>">Parcours</a></li>
			<li><a href="<?php echo $this->url('diretude/apogee') ?>">Code apogée</a></li>
			<li><a href="<?php echo $this->url('diretude/nom') ?>">Nom</a></li>
		</ul>
	</div>

</div>

<div id="corps_contenu">
	<div id="corps_contenu_contenu">
		<div id="corps_contenu_titreEtSousTitre">
			<h2>Recherche par code apogée</h2>
		</div>
		<table class="formulaire">


			<tr>

				<td>Code apogée:</td>
				<td><input class="INPUT_text" type="text" /></td>
				
			</tr>
			<tr>
				<td><input class="INPUT_submit" type="submit" value="Rechercher" />
				</td>
			</tr>
		</table>
		<br/><br/>
		<p>1 résultat</p>
		
		<table class="tableauTailleMini" cellspacing="0">
			<tr class="entete">
				<td>Code Apogée</td>
				<td>Nom</td>
				<td>Prénom</td>
				<td>TD</td>
				<td>TP</td>

			</tr>

			<tr class="hoverable">
				<td>i120728</td>
				<td>Dupont</td>
				<td>Paul</td>
				<td>11</td>
				<td>A</td>

			</tr>
		</table>


	</div>
</div>
