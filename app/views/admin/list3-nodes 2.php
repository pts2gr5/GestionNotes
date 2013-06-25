<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        <!-- liste des nodes -->
        <?php if ( is_array($nodes) && count($nodes) > 0 ): ?>
        <table class="tableauTailleMini" cellspacing="0">
            <tr class="entete">
                <td width="40%">Titre</td>
				<?php if ( isset($show_parent_column) && $show_parent_column ): ?><td width="30%">Parent</td><?php endif ?>
				<td>&nbsp;</td>
			</tr>
            <?php foreach ( $nodes as $node ): ?>
            <tr class="hoverable" id="node-<?php echo $node['id'] ?>">
                <td>
                    <a href="<?php echo $this->url('admin/list-nodes',array('id'=>$node['id'])) ?>">
                        <?php echo $node['title'] ?>
                    </a>
                </td>
                <?php if ( isset($show_parent_column) && $show_parent_column ): ?><td><?php echo $node['parent'] ? $node['parent']['title'] : 'N/D' ?></td><?php endif ?>
                <td>
                    <a href="<?php echo $this->url('admin/edit-node', array('id'=>$node['id'])) ?>">Editer</a> &dash;
                    <a href="<?php echo $this->url('admin/delete-node',array('id'=>$node['id'])) ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
        <?php else: ?>
        Aucun enfant
        <?php endif ?>
        <!-- / liste des nodes -->
        
        <!-- formulaire d'ajout node -->
        <div id="ajouterUneNoteACoteDuTableau">
            <span>Ajouter un(e) <?php echo $node_name ?></span>
            <form method="post" action="<?php echo $this->url('admin/create-node') ?>">
                <input type="hidden" name="parent_id" value="<?php echo $parent['id'] ?>">
                <input type="hidden" name="node_type" value="<?php echo ($parent['type'] + 1) ?>">
                <br/>
                <label for="title">Intitulé :</label> <input class="INPUT_text" type="text" name="title"/><br/>
                <input class="INPUT_submit" type="submit" value="Ajouter"/>
            </form>
        </div>
        <!-- / formulaire d'ajout node -->
    </div>
</div>
