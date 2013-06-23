<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1>Editer un(e) <?php echo $node_name ?></h1>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        <div>
            <span>Editer un(e) <?php echo $node_name ?></span>
            <form method="post" action="<?php echo $this->url('admin/save-node') ?>">
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="node_id" value="<?php echo $node['id'] ?>">
                <input type="hidden" name="node_type" value="<?php echo $node['type'] ?>">
                <br/>
                <label for="title">Intitulé :</label> <input class="INPUT_text" type="text" name="title" value="<?php echo $node['title'] ?>"/><br/>
                <input class="INPUT_submit" type="submit" value="Enregistrer"/>
            </form>
        </div>
        <!-- / formulaire d'ajout node -->
    </div>
</div>
