<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
    
    <div id="corps_titreEtSousMenu_option">
        <a onclick="window.print()"><img src="img/print.png" alt="Imprimer" /></a>
    </div>
    
    <div id="corps_titreEtSousMenu_sousMenu">
        <ul>
            <li><a href="<?php echo $this->url('admin/etudiants/liste') ?>">Voir tous</a></li>
            <li><a href="<?php echo $this->url('admin/etudiants/rechercher') ?>">Rechercher</a></li>
        </ul>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        <!-- Liste des étudiants -->
        <form action="<?php echo $this->url('admin/etudiants/liste') ?>" method="post">
        <table class="tableauTailleMini" cellspacing="0">
        <thead>
            <tr class="entete">
                <td>&nbsp</td>
                <td>N°Apogée</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Formation</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user):?>
            <tr class="hoverable">
                <td><input type="checkbox" name="etudiants[]" value="<?php echo $user['id'] ?>" /></td>
                <td data-student-id="<?php echo $user['id'] ?>"><?php echo $user['apogee'] ?></td> 
                <td data-student-id="<?php echo $user['id'] ?>"><?php echo $user['lastName'] ?></td>
                <td data-student-id="<?php echo $user['id'] ?>"><?php echo $user['firstName'] ?></td>
                <td data-formation-id="<?php echo $user['formation']['id'] ?>"><?php echo $user['formation']['title'] ?></td>
                <td>
                    <a href="<?php echo $this->url('admin/etudiants/editer',array('id'=>$user['id'])) ?>"><img src="img/icone_editer.png" alt="Editer" /></a>
                    <a href="<?php echo $this->url('admin/etudiants/supprimer',array('id'=>$user['id'])) ?>"><img src="img/croix_rouge.png" alt="Supprimer" /></a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
        </table>
        </form>
        <!-- / Liste des étudiants -->
        
        <!-- Rechercher dans les étudiants -->
        <div class="ajouterUneNoteACoteDuTableau" id="rechercherEtudiants">
            <form name="filters" action="<?php echo $this->url('admin/etudiants/liste') ?>" method="post">
            <table class="no-border">
                <?php function show_criteria($title, $name, array $choices, $selected) {?>
                <tr>
                    <td>
                        <label for="title"><?php echo $title ?></label>
                        <br /><br />
                        <select name="<?php echo $name ?>" class="select" onchange="filters.submit()">
                            <option <?php if ( ! $selected ) echo 'selected' ?> value="">Tout</option> 
                            <?php foreach ( $choices as $choice ): ?>
                            <option value="<?php echo $choice['id'] ?>" <?php if ( $choice['id'] == $selected ) echo 'selected' ?>><?php echo utf8_decode($choice['title']) ?></option>
                            <?php endforeach ?>
                        </select>
                        <br /><br />
                    </td>
                </tr>
                <?php } ?>
                <?php
                    if ( array_key_exists('departements', $filters) ) {
                        show_criteria('Département','departement',$filters['departements'],$selected['departement']);
                        if ( array_key_exists('formations', $filters) ) {
                            show_criteria('Formation','formation',$filters['formations'],$selected['formation']);
                            if ( array_key_exists('semestres', $filters) ) {
                                show_criteria('Semestre','semestre',$filters['semestres'],$selected['semestre']);
                                if ( array_key_exists('td', $filters) ) {
                                    show_criteria('Groupe TD','td',$filters['td'],$selected['td']);
                                    if ( array_key_exists('tp', $filters) )    
                                        show_criteria('Groupe TP','tp',$filters['tp'],$selected['tp']);
                    }}}}
                ?>
                <tr>
                    <td><noscript><input class="INPUT_submit" type="submit" value="Filtrer"/></noscript></td>
                </tr>                
            </table>
            </form>
        </div>
        <!-- / Rechercher dans les étudiants -->
        
        <div class="ajouterUneNoteACoteDuTableau" id="informationFormation" style="display:none;visiblity:hidden"></div>
    </div>
</div>