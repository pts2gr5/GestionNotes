<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1>Editer un groupe <?php echo $formation['type'] == GestionNotes_Model_Formation::TYPE_TD ? 'TD':'TP' ?></h1>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        <div>
            <h1>Editer un groupe <?php echo $formation['type'] == GestionNotes_Model_Formation::TYPE_TD ? 'TD':'TP' ?></h1>
            <form method="post" action="<?php echo $this->url('admin/savegroup') ?>">
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="formation_id" value="<?php echo $formation['id'] ?>">
                <br/>
                <label for="title">Titre :</label> <input class="INPUT_text" type="text" name="title" value="<?php echo $formation['title'] ?>"/><br/>
                <input class="INPUT_submit" type="submit" value="Enregistrer"/>
            </form>
        </div>
        <!-- / formulaire d'ajout node -->
    </div>
</div>
