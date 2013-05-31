<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

<div id="corps_contenu">
    <div id="corps_contenu_contenu">
        <?php if ( is_array($nodes) && count($nodes) > 0 ): ?>
        <table class="tableauTailleMax" cellspacing="0">
            <tr class="entete">
                <td width="5%">#ID</td>
                <td width="40%">Titre</td>
				<?php if ( $show_parent_column ): ?><td width="30%">Parent</td><?php endif ?>
				<td>&nbsp;</td>
			</tr>
            <?php foreach ( $nodes as $node ): ?>
            <tr class="hoverable">
                <td><?php echo $node['id'] ?></td>
                <td>
                    <a href="<?php echo $this->url('admin/list-nodes',array('id'=>$node['id'])) ?>">
                        <?php echo $node['title'] ?>
                    </a>
                </td>
                <?php if ( $show_parent_column ): ?><td><?php echo $node['parent'] ? $node['parent']['title'] : 'N/D' ?></td><?php endif ?>
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
    </div>
</div>
