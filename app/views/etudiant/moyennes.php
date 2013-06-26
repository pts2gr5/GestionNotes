<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
		<h1><?php echo $list_title ?></h1>
	</div>

</div>

<div id="corps_contenu">
	<div id="corps_contenu_contenu">
		<table class="tableauTailleMax" cellspacing="0">
			<tr class="entete">
				<td width="60%">Matière</td>
				<td>Coeff.</td>
				<td>Note</td>
				<td>Moy.</td>
			</tr>
            <?php
            function moyenne(array &$node, array &$notes) {
                $count = $total = 0;
                if ( isset($node['children']) && count($node['children']) > 0 ) {
                    foreach ( $node['children'] as $child )
                        if ( $total += moyenne($child, $notes) ) $count++;
                    return ( $count > 0 ) ? round($total / $count, 2) : null;
                } else {
                    if ( ! isset($notes[$node['id']]) ) return;
                    $total = $notes[$node['id']]['coefficient'] * $notes[$node['id']]['student_note'];
                    $count = $notes[$node['id']]['coefficient'];
                    return ( $count > 0 ) ? round($total / $count, 2) : null;
                }
            }
            ?>
            <?php function show_tree(array &$nodes, array &$notes) { ?>
                <?php foreach ( $nodes as $node ): ?>
			<tr class="hoverable">
                <?php if ( ! in_array($node['type'], array(GestionNotes_Model_Node::TYPE_MATIERE, GestionNotes_Model_Node::TYPE_EPREUVE)) ): ?>
                    <?php if ( in_array($node['type'], range(GestionNotes_Model_Node::TYPE_FORMATION, GestionNotes_Model_Node::TYPE_UE)) ): ?>
    				<td class="UE"><?php echo utf8_encode($node['title']) ?></td>
                    <?php elseif ( $node['type'] == GestionNotes_Model_Node::TYPE_MODULE ): ?>
    				<td class="MODULE"><?php echo utf8_encode($node['title']) ?></td>
                    <?php elseif ( $node['type'] == GestionNotes_Model_Node::TYPE_MATIERE ): ?>
    				<td class="MATIERE clickable"><?php echo utf8_encode($node['title']) ?></td>
                    <?php endif ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php echo moyenne($node, $notes) ?></td>
                <?php else: ?>
    				<td class="MATIERE clickable"><?php echo utf8_encode($node['title']) ?></td>
    				<td><?php echo isset($notes[$node['id']]) ? $notes[$node['id']]['coefficient'] : 'N/A' ?></td>
    				<td><?php echo isset($notes[$node['id']]) ? $notes[$node['id']]['student_note'] : 'N/A' ?></td>
    				<td>&nbsp;</td>
                <?php endif ?>
            </tr>
                <?php show_tree($node['children'], $notes) ?>
                <?php endforeach ?>
            <?php } ?>
            <?php show_tree($nodes, $notes) ?>
            <!--
			<tr class="hoverable">
				<td class="MATIERE clickable">Matière</td>
				<td>2</td>
				<td>Note</td>
				<td>1</td>
			</tr>
			<tr class="hoverable good">
				<td class="MATIERE clickable">Matière</td>
				<td>2</td>
				<td>Note</td>
				<td>1</td>
			</tr>
			<tr class="hoverable bad">
				<td class="MATIERE clickable">Matière</td>
				<td>2</td>
				<td>Note</td>
				<td>1</td>
			</tr>
            -->
		</table>
		


	</div>
</div>
