<?php if ( is_array($nodes) && count($nodes) > 0 ): ?>
<form name="ajouternote" method="post" action="<?php echo $this->url('etudiant/ajouternote') ?>">
	<label for="matiere">Matière :</label>
   <select name="matiere" onchange="ajouternote.submit()">
        <?php foreach ( $nodes as $node ): ?>
        <?php $selected = (isset($_REQUEST['matiere']) && intval($_REQUEST['matiere']) == $node['id']) ? 'selected' : ''; ?>
        <option value="<?php echo $node['id'] ?>" <?php echo $selected ?>><?php echo $node['title']; ?></option>
        <?php endforeach; ?>
   </select>
   <br /><br />
   
   <!-- Si on a cliqué sur une matière, on affiche les épreuves -->
   <?php if ( isset($_REQUEST['matiere']) ): ?>
   		<?php  if ( is_array($epreuves) && count($epreuves) > 0 ): ?>
			<label for="epreuve">Epreuve :</label>
            <select name="epreuve" onchange="form.submit()">
		        <?php foreach ( $epreuves as $ep ): ?>
		        <option value="<?php echo $ep['id'] ?>"><?php echo $ep['title']; ?></option>
		        <?php endforeach; ?>
		   	</select>
            <br /><br />
        <?php else:  ?>
            Aucune épreuve définie pour cette matière.<br />
        <?php endif ?>
		
        <!-- Si on a cliqué sur une épreuve, on affiche les un champs de texte -->
		<?php if ( isset($_REQUEST['epreuve']) ): ?>
            Note: <input type="text" name="note"/>
            <br /><br />
	    <?php endif;?>
	<?php endif;  ?>
    
    <input type="submit" value="Ajouter" />
   </form>
<?php else: ?>
   Encore aucune matière dans la base !
<?php endif  ?>
