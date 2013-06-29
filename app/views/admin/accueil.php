<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        Connecté(e) en tant que <b><?php echo $this->visitor ?></b>.<br />

        <a href="<?php echo $this->url('admin/etudiants') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_bleu">
                <span>Voir tous les étudiants</span>
            </div>
        </a>
        <a href="<?php echo $this->url('admin/etudiants/creer') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_jaune">
                <span>Ajouter un étudiant manuellement</span>
            </div>
        </a>
        <a href="<?php echo $this->url('admin/etudiants/importer') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_vert">
                <span>Importer des étudiants</span>
            </div>
        </a>
        <a href="<?php echo $this->url('admin/promotions') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_rouge">
                <span>Gérer les promotions d'étudiants</span>
            </div>
        </a>
        <a href="<?php echo $this->url('admin/etudiants/rechercher') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_gris">
                <span>Rechercher des étudiants</span>
            </div>    
        </a>  
        <a href="<?php echo $this->url('admin/formations') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_violet">
                <span>Gérer les formations</span>
            </div>    
        </a>
    </div>
</div>