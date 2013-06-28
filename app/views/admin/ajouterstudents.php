<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        <a href="<?php echo $this->url('admin/ajoutermanuellementstudents') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_jaune">
                <span>Ajouter un étudiant manuellement</span>
            </div>
        </a>
        <a href="<?php echo $this->url('admin/ajouterstudentsbyCSV') ?>">
            <div id="accueil_boxConteneur" class="accueil_boxColor_vert">
                <span>Importer des étudiants</span>
            </div>
        </a>
    </div>
</div>
