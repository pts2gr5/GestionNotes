<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
    	<h1><?php echo $list_title ?></h1>
	</div>			
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        Connecté(e) en tant que <b><?php echo $this->visitor ?></b>.<br />
        <a href="<?php echo $this->url('diretude/moyennes') ?>">
    	    <div id="accueil_boxConteneur" class="accueil_boxColor_jaune">
    			<span>Consulter les moyennes</span>
    		</div>
    	</a>
    	<a href="<?php echo $this->url('diretude/apogee') ?>">
    		<div id="accueil_boxConteneur" class="accueil_boxColor_vert">
    			<span>Consulter les résultats par code apogée</span>
    		</div>
    	</a>
    	<a href="<?php echo $this->url('diretude/nom') ?>">
    		<div id="accueil_boxConteneur" class="accueil_boxColor_bleu">
    			<span>Consulter les résultats par nom/prénom</span>
    		</div>
    	</a>
    	<a href="<?php echo $this->url('diretude/parcours') ?>">
    		<div id="accueil_boxConteneur" class="accueil_boxColor_rouge">
    			<span>Consulter les résultats par parcours</span>
    		</div>
    	</a>
    </div>
</div>