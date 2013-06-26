<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_titreEtSousTitre">
		<h2><?php if (isset($titleNode)) echo $titleNode; ?></h2>
		<h3> 
			<!-- Le fils d'ariane des formations -->
		<?php if(isset($path)):?>
		<?php if (is_array($path)): ?>
			<?php foreach ($path as $val):?>
				<?php //echo ':',$val;?>
			<?php endforeach;?>
		<?php endif;?>
		<?php endif;?>
		
		
		</h3>
	</div>
	
	<div id="corps_contenu_contenu">
        <!-- liste des nodes -->
        <?php if ( is_array($nodes) && count($nodes) > 0 ): ?>
        <table class="tableauTailleMini" cellspacing="0">
            <tr class="entete">
                
                <td width="80%">Titre</td>
				<?php if ( $show_parent_column ): ?><td width="30%">Parent</td><?php endif ?>
				<td></td>
			</tr>
            <?php foreach ( $nodes as $node ): ?>
            <tr class="hoverable">
                <td>
                    <a href="<?php echo $this->url('admin/list-nodes',array('id'=>$node['id'])) ?>">
                        <?php echo $node['title'] ?>
                    </a>
                </td>
                <?php if ( $show_parent_column ): ?><td><?php echo $node['parent'] ? $node['parent']['title'] : 'N/D' ?></td><?php endif ?>
                <td>
                    <a href="<?php echo $this->url('admin/edit-node', array('id'=>$node['id'])) ?>"><img src="images/icone_editer.png" alt="Editer" /></a>
                    <a href="<?php echo $this->url('admin/delete-node',array('id'=>$node['id'])) ?>"><img src="images/croix_rouge.png" alt="Supprimer" /></a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
        <?php else: ?>
        Aucun enfant
        <?php endif ?>
        <!-- / liste des nodes -->
        <?php if (!empty($node)):?>
        <!-- formulaire d'ajout node -->
        <div id="ajouterUneNoteACoteDuTableau">
            <span>Ajouter un élément</span>
            <form method="post" action="<?php echo $this->url('admin/create-node') ?>">
                <input type="hidden" name="parent_id" value="<?php echo $node['parent']['id'] ?>">
                <input type="hidden" name="node_type" value="<?php echo ($node['parent']['type']) ?>">
                <br/>
                <label for="title">Intitulé :</label> <input class="INPUT_text" type="text" name="title"/><br/>
                <input class="INPUT_submit" type="submit" value="Ajouter"/>
            </form>
        </div>
        <!-- / formulaire d'ajout node -->
        <?php else:?>
        <div id="ajouterUneNoteACoteDuTableau">
        <?php if ($typeNode+1 == 7): ?>
        <span>Ajouter une épreuve</span>
        <?php else:?>
            <span>Ajouter un élément</span>
            <?php endif;?>
        	<form method="post" action="<?php echo $this->url('admin/create-node') ?>">
                <input type="hidden" name="parent_id" value="<?php echo $idNode; ?>">
                <input type="hidden" name="node_type" value="<?php echo $typeNode+1; ?>">
               	<br/>
                <label for="title">Intitulé :</label> <input class="INPUT_text" type="text" name="title"/><br/><br/>
                <?php if ($typeNode+1 == 7): ?>
                	<label for="title">Coefficient :</label> <input class="INPUT_text" type="text" name="coef"/><br/>
				<?php endif;?>
                <input class="INPUT_submit" type="submit" value="Ajouter"/>
            </form>
        </div>
        <?php endif;?>
    </div>
</div>
