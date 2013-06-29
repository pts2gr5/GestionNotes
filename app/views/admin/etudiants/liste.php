<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
    
    <div id="corps_titreEtSousMenu_option">
        <a onclick="window.print()"><img src="images/print.png" alt="Imprimer" /></a>
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
                <td data-formation-id="<?php echo $user['formation'] ?>"><?php echo $user['formation'] ?></td>
                <td>
                    <a href="<?php echo $this->url('admin/etudiants/editer',array('id'=>$user['id'])) ?>"><img src="images/icone_editer.png" alt="Editer" /></a>
                    <a href="<?php echo $this->url('admin/etudiants/supprimer',array('id'=>$user['id'])) ?>"><img src="images/croix_rouge.png" alt="Supprimer" /></a>
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
                            <option selected>Tout</option> 
                            <?php foreach ( $choices as $choice ): ?>
                            <option value="<?php echo $choice['id'] ?>" <?php if ( $choice['id'] == $selected ) echo 'selected' ?>><?php echo utf8_decode($choice['title']) ?></option>
                            <?php endforeach ?>
                        </select>
                        <br /><br />
                    </td>
                </tr>
                <?php } ?>
                <?php !isset($filters['departements']) || show_criteria('Départements', 'departement', $filters['departements'], $selected['departement']) ?>
                <?php !isset($filters['formations']) || show_criteria('Formations', 'formation', $filters['formations'], $selected['formation']) ?>
                <?php !isset($filters['semestres']) || show_criteria('Semestres', 'semestre', $filters['semestres'], $selected['semestre']) ?>
                <?php !isset($filters['td']) || show_criteria('Groupes TD', 'td', $filters['td'], $selected['td']) ?>
                <?php !isset($filters['tp']) || show_criteria('Groupes TP', 'tp', $filters['tp'], $selected['tp']) ?>
                <?php !isset($filters['parcours']) || show_criteria('Parcours', 'parcours', $filters['parcours'], $selected['parcours']) ?>
                <noscript>
                <tr>
                    <td><input class="INPUT_submit" type="submit" value="Filtrer"/></td>
                </tr>
                </noscript>
            </table>
            </form>
        </div>
        <!-- / Rechercher dans les étudiants -->
        
        <div class="ajouterUneNoteACoteDuTableau" id="informationFormation" style="display:none;visiblity:hidden"></div>
    </div>
</div>

<script type="text/javascript">
formations_infos_url = '<?php echo $this->url('admin/promotions/infos'); ?>';
students_infos_url = '<?php echo $this->url('admin/etudiants/infos'); ?>';
GestionNotes.admin.etudiants_liste();
</script>