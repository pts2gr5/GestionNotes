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
			<h2>Recherche par parcours</h2>
		</div>
		<table class="formulaire">


			<tr>

				<td>Population :</td>
				<td><select name="boite2">
						<option selected>TD11</option>
						<option>TD12</option>

				</select>
				</td>
			</tr>
			<tr>
				<td><input class="INPUT_submit" type="submit" value="Rechercher" />
				</td>
			</tr>
		</table>
		<br/><br/>
		<p>11 résultats</p>
		
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
			<tr class="hoverable">
				<td>i120729</td>
				<td>James</td>
				<td>Hooper</td>
				<td>11</td>
				<td>A</td>

			</tr>
			<tr class="hoverable">
				<td>i120730</td>
				<td>Krames</td>
				<td>Marion</td>
				<td>11</td>
				<td>B</td>

			</tr>
			<tr class="hoverable">
				<td>i120731</td>
				<td>Duponta</td>
				<td>Antoine</td>
				<td>11</td>
				<td>A</td>

			</tr>
			<tr class="hoverable">
				<td>i120732</td>
				<td>Dugues</td>
				<td>Corentin</td>
				<td>11</td>
				<td>A</td>

			</tr>
			<tr class="hoverable">
				<td>i120733</td>
				<td>Potter</td>
				<td>Harry</td>
				<td>11</td>
				<td>B</td>

			</tr>
		<tr class="hoverable">
				<td>i120734</td>
				<td>Granger</td>
				<td>Hermionne</td>
				<td>11</td>
				<td>B</td>

			</tr>
			<tr class="hoverable">
				<td>i120735</td>
				<td>Wiselet</td>
				<td>Ron</td>
				<td>11</td>
				<td>A</td>

			</tr>
			<tr class="hoverable">
				<td>i120736</td>
				<td>Harpe</td>
				<td>Jessica</td>
				<td>11</td>
				<td>B</td>

			</tr>
			<tr class="hoverable">
				<td>i120739</td>
				<td>hugre</td>
				<td>Laure</td>
				<td>11</td>
				<td>A</td>

			</tr>
		</table>


	</div>
</div>
