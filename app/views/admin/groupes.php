<div id="corps_titreEtSousMenu">
			<div id="corps_titreEtSousMenu_titre">
			<h1><?php echo $list_title ?></h1>
			</div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        <h1>Liste des TDs</h1>
        <br />
        <table class="tableauTailleMini" cellspacing="0">
        <tr class="entete">
            <td>Département</td>
            <td>Formation</td>
            <td>Semestre</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
        <?php if ( isset($td) && is_array($td) && count($td) > 0 ): ?>
        <?php foreach ($td as $group):?>
        <tr class="hoverable">
            <td><?php echo utf8_encode($group['departement_title']);/* champs null */ ?></td> 
            <td><?php echo utf8_encode($group['formation_title']); /* champs null */ ?></td>
            <td><?php echo utf8_encode($group['semestre_title']); /* champs null */ ?></td>
            <td><?php echo utf8_encode($group['title']);  /* champs null */ ?></td>
            <td>
                <a href="<?php echo $this->url('admin/editgroup', array('id'=>$group['id'])) ?>"><img src="images/icone_editer.png" alt="Editer" /></a>
                <a href="<?php echo $this->url('admin/delgroup', array('id'=>$group['id'])) ?>"><img src="images/croix_rouge.png" alt="Supprimer" /></a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else: ?>
        <tr>
            <td colspan="6">Aucun groupe TD à afficher</td>
        </tr>
        <?php endif ?>
        </table>
        
        <div id="ajouterUneNoteACoteDuTableau">
            <span>Ajouter un TD</span>
			<br/><br/>
            <form method="post" action="<?php echo $this->url('admin/addgroup',array('type'=>GestionNotes_Model_Formation::TYPE_TD)) ?>">
            <input type="hidden" name="type" value="<?php echo GestionNotes_Model_Formation::TYPE_TD ?>">
            <div>
                <label for="parent">Semestre:</label><br />
                <select name="parent">
                    <?php foreach ($semestres AS $group): ?>
                    <option value="<?php echo $group['id'] ?>">
                        <?php printf('%s > %s', $group['parent']['title'], $group['title']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label for="title">Titre:</label><br />
                <input name="title" class="INPUT_text" type="text" size="35" value="" />
                <input type="submit" class="INPUT_submit" value="Ajouter" />
            </div>
            </form>
        </div>
    </div>
    
    <div>&nbsp;</div>
    
    <div id="corps_contenu_contenu">    
        <h1>Liste des TPs</h1>
        <br />
        <table class="tableauTailleMini" cellspacing="0">
        <tr class="entete">
            <td>Département</td>
            <td>Formation</td>
            <td>Semestre</td>
            <td>TD</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
        <?php if ( isset($tp) && is_array($tp) && count($tp) > 0 ): ?>
        <?php foreach ($tp as $group):?>
        <tr class="hoverable">
            <td><?php echo utf8_encode($group['departement_title']);/* champs null */ ?></td> 
            <td><?php echo utf8_encode($group['formation_title']); /* champs null */ ?></td>
            <td><?php echo utf8_encode($group['semestre_title']); /* champs null */ ?></td>
            <td><?php echo utf8_encode($group['td_title']); /* champs null */ ?></td>
            <td><?php echo utf8_encode($group['title']);  /* champs null */ ?></td>
            <td>
                <a href="<?php echo $this->url('admin/editgroup', array('id'=>$group['id'])) ?>"><img src="images/icone_editer.png" alt="Editer" /></a>
                <a href="<?php echo $this->url('admin/delgroup', array('id'=>$group['id'])) ?>"><img src="images/croix_rouge.png" alt="Supprimer" /></a>
            </td>
        </tr>
        <?php endforeach;?>
        <?php else: ?>
        <tr>
            <td colspan="6">Aucun groupe TP à afficher</td>
        </tr>
        <?php endif ?>
        </table>
        
        <div id="ajouterUneNoteACoteDuTableau">
            <span>Ajouter un TP</span>
			<br/><br/>
            <form method="post" action="<?php echo $this->url('admin/addgroup',array('type'=>GestionNotes_Model_Formation::TYPE_TP)) ?>">
            <input type="hidden" name="type" value="<?php echo GestionNotes_Model_Formation::TYPE_TP ?>">
            <div>
                <label for="parent">Groupe TD:</label><br />
                <select name="parent">
                    <?php foreach ($tp AS $group): ?>
                    <option value="<?php echo $group['id'] ?>">
                        <?php printf('%s > %s > %s', /*$group['departement_title'],*/ $group['formation_title'], $group['semestre_title'], $group['title']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label for="title">Titre:</label><br />
                <input name="title" class="INPUT_text" type="text" size="35" value="" />
                <input type="submit" class="INPUT_submit" value="Ajouter" />
            </div>
            </form>
        </div>
    </div>
</div>