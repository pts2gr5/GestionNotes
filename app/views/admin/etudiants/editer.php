<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

<form action="<?php echo $this->url('admin/etudiants/enregistrer') ?>" method="post" class="form-horizontal">
<?php if ( isset($user['id']) ): ?><input type="hidden" name="id" value="<?php echo $user['id'] ?>" /><?php endif ?>
<div class="row-fluid">
<div class="span6">    
    <div class="control-group">
        <label class="control-label" for="nom">Nom :</label>
        <div class="controls"><input name="nom" class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $user['firstName']) ?>" required /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="nom">Prénom :</label>
        <div class="controls"><input name="nom" class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $user['lastName']) ?>" required /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="nom">Adresse e-mail :</label>
        <div class="controls"><input name="nom" class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $user['email']) ?>" required /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="nom">Code Apogée :</label>
        <div class="controls"><input name="nom" class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $user['apogee']) ?>" required /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="nom">Mot de passe :</label>
        <div class="controls"><input name="nom" class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $user['password']) ?>" /></div>
    </div>
</div>

<div class="span6">    
    <div class="control-group">
        <label class="control-label" for="departement">Département :</label>
        <div class="controls"><select name="departement" id="departement" required></select></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="formation">Formation :</label>
        <div class="controls"><select name="formation" id="formation" required></select></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="semestre">Semestre :</label>
        <div class="controls"><select name="semestre" id="semestre" required></select></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="td">Groupe TD :</label>
        <div class="controls"><select name="td" id="td" required></select></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="tp">Groupe TP :</label>
        <div class="controls"><select name="tp" id="tp" required></select></div>
    </div>
</div>
</div>

<div class="row-fluid">
<div class="span12">    
    <div class="control-group" id="submit" style="text-align:center">
        <button type="submit" class="btn"><?php echo isset($user['id']) && $user['id'] ? 'Modifier' : 'Créer' ?></button>
    </div>
</div>
</div>
</form>

<script type="text/javascript">
$(document).ready(function () {
    $('select#departement').jCombo('<?php echo $this->url('admin/promotions/combo',array('type'=>GestionNotes_Model_Node::TYPE_DEPARTEMENT)) ?>', { <?php if (isset($tree['departement_id'])) echo 'selected_value: "'.$tree['departement_id'].'"' ?> });
    $('select#formation').jCombo('<?php echo $this->url('admin/promotions/combo',array('type'=>GestionNotes_Model_Node::TYPE_FORMATION)) ?>&id=', { parent: '#departement' <?php if (isset($tree['formation_id'])) echo ',selected_value: "'.$tree['formation_id'].'"' ?> });
    $('select#semestre').jCombo('<?php echo $this->url('admin/promotions/combo',array('type'=>GestionNotes_Model_Node::TYPE_SEMESTRE)) ?>&id=', { parent: '#formation' <?php if (isset($tree['semestre_id'])) echo ',selected_value: "'.$tree['semestre_id'].'"' ?> });
    $('select#td').jCombo('<?php echo $this->url('admin/promotions/combo',array('type'=>GestionNotes_Model_Node::TYPE_GROUPE_TD)) ?>&id=', { parent: '#semestre' <?php if (isset($tree['td_id'])) echo ',selected_value: "'.$tree['td_id'].'"' ?> });
    $('select#tp').jCombo('<?php echo $this->url('admin/promotions/combo',array('type'=>GestionNotes_Model_Node::TYPE_GROUPE_TP)) ?>&id=', { parent: '#td' <?php if (isset($tree['tp_id'])) echo ',selected_value: "'.$tree['tp_id'].'"' ?>});
});
</script>