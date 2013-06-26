<div id="corps_titreEtSousMenu">
			<div id="corps_titreEtSousMenu_titre">
			<h1><?php echo $list_title ?></h1>
			</div>

			
		</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
    <a href="<?php echo $this->url('admin/ajoutermanuellementstudents') ?>">
	    <div id="accueil_boxConteneur" class="accueil_boxColor_jaune">
			<span>Ajouter des étudiants manuellement</span>
		</div>
	</a>
	<a href="<?php echo $this->url('admin/ajouterstudentsbyCSV') ?>">
		<div id="accueil_boxConteneur" class="accueil_boxColor_vert">
			<span>Ajouter des étudiants par csv</span>
		</div>
	</a>
	<a href="<?php echo $this->url('admin/gererstudents') ?>">
		<div id="accueil_boxConteneur" class="accueil_boxColor_bleu">
			<span>Voir tous les étudiants</span>
		</div>
	</a>
	<a href="<?php echo $this->url('admin/groupes') ?>">
		<div id="accueil_boxConteneur" class="accueil_boxColor_rouge">
			<span>Gérer les groupes d'étudiants</span>
		</div>
	</a>
	<a href="<?php echo $this->url('admin/formations') ?>">
	    <div id="accueil_boxConteneur" class="accueil_boxColor_violet">
			<span>Gérer les formations</span>
		</div>    
    </a>   
	<a href="<?php echo $this->url('admin/rechercherstudent') ?>">
	    <div id="accueil_boxConteneur" class="accueil_boxColor_gris">
			<span>Rechercher des étudiants</span>
		</div>    
    </a>   
    
    
     
        
        
    </div>
</div>