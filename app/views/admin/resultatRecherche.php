<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
		<h1><?php echo $list_title ?></h1>
	</div>

	<div id="corps_titreEtSousMenu_sousMenu">
        <ul><li><a href="<?php echo $this->url('admin/gererstudents') ?>">Voir tous</a></li><li><a href="<?php echo $this->url('admin/rechercherstudent') ?>">Rechercher</a></li></ul>
    </div>
</div>

<div id="corps_contenu">
	<div id="corps_contenu_titreEtSousTitre">
		<h2>Résultat de la recherche</h2>
		<h3><?php echo htmlspecialchars(@ $_REQUEST['termeRecherche'])  ?></h3>
	</div>
	
	<div id="corps_contenu_contenu">
        <?php if ( ! $this->params['userRecherche'] ):?>
        <div class="ContenerError">
            Il n'y a aucun résultat pour la requête : <?php echo htmlspecialchars(@ $_REQUEST['termeRecherche']) ?>
        </div>
        <?php else : ?>	
        <table class="tableauTailleMini" cellspacing="0">
        	<tr class="entete">
        		<td>Code Apogée</td>
        		<td>Nom</td>
        		<td>Prénom</td>
        		<td>TD</td>
        		<td>TP</td>
        	</tr>
        	<tr class="hoverable">
        		<td><?php echo  $this->params['userRecherche']['apogee_code']; ?></td>
        		<td><?php echo  $this->params['userRecherche']['last_name']; ?></td>
        		<td><?php echo  $this->params['userRecherche']['first_name']; ?></td>
        		<td><?php if (isset($td)) echo $td; ?></td>
        		<td><?php if (isset($tp)) echo $tp; ?></td>
        	</tr>
        </table>
        <?php endif ?>
    </div>
</div>			