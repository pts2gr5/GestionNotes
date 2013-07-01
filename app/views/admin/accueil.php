<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

Connecté(e) en tant que <b><?php echo $this->visitor ?></b>.<br />

<div class="container-fluid">
<div class="row-fluid">
    <div class="span3 box-container box-container-blue">
        <a href="<?php echo $this->url('admin/etudiants/liste') ?>">
            <span>Voir tous les étudiants</span>
        </a>
    </div>
    <div class="span3 box-container box-container-yellow">
        <a href="<?php echo $this->url('admin/etudiants/creer') ?>">
            <span>Ajouter un étudiant manuellement</span>
        </a>
    </div>
    <div class="span3 box-container box-container-green">
        <a href="<?php echo $this->url('admin/etudiants/importer') ?>">
            <span>Importer des étudiants</span>
        </a>
    </div>
    <div class="span3 box-container box-container-red">
        <a href="<?php echo $this->url('admin/promotions') ?>">
            <span>Gérer les promotions d'étudiants</span>
        </a>
    </div>
</div>
<div class="row-fluid">
    <div class="span3 box-container box-container-gray">
        <a href="<?php echo $this->url('admin/etudiants/rechercher') ?>">
            <span>Rechercher des étudiants</span>
        </a>  
    </div>
    <div class="span3 box-container box-container-purple">
        <a href="<?php echo $this->url('admin/formations') ?>">
            <span>Gérer les formations</span>
        </a>
    </div>
</div>
</div>