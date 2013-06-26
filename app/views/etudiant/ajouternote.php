<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
		<h1><?php echo $list_title ?></h1>
	</div>

</div>

<div id="corps_contenu">
	<div id="corps_contenu_contenu">
		<form name="ajouternote" method="post" action="<?php echo $this->url('etudiant/ajouternote') ?>">
		<table class="formulaire">
		<tr>
			<?php if ( is_array($nodes) && count($nodes) > 0 ): ?>
				<td><label for="matiere">Matière :</label></td>
				<td><select name="matiere" onchange="ajouternote.submit()">
						<option value="0" select />
						<?php foreach ( $nodes as $node ): ?>
						<?php $selected = (isset($_REQUEST['matiere']) && intval($_REQUEST['matiere']) == $node['id']) ? 'selected' : ''; ?>
						<option value="<?php echo $node['id'] ?>" <?php echo $selected ?>>
							<?php echo $node['title']; ?>
						</option>
						<?php endforeach; ?>
				</select>
				</td>
		</tr>
		<tr>
			<!-- Si on a cliqué sur une matière, on affiche les épreuves -->
			<?php if ( isset($_REQUEST['matiere']) ): ?>
			<?php  if ( isset($epreuves) && is_array($epreuves) && count($epreuves) > 0 ): ?>
			<td><label for="epreuve">Epreuve :</label></td>
			<td>
                <select name="epreuve" onchange="form.submit()">
                    <?php foreach ( $epreuves as $ep ): ?>
					<option value="<?php echo $ep['id'] ?>"><?php echo $ep['title']; ?></option>
					<?php endforeach; ?>
			    </select>
			</td>
		</tr>
		<tr>
			<!-- Si on a cliqué sur une épreuve, on affiche les un champs de texte -->
			<?php if ( isset($_REQUEST['epreuve']) ): ?>
			<td><label for="note">Note:</label>
			</td>
			<td><input type="text" class="INPUT_text" size="2" name="note" />
			</td>
			<?php endif;?>
			<?php else:  ?>
			<div class="ContenerError">
      			  Aucune épreuve définie pour cette matière.<br />
      		</div>
			<?php endif;?>
			<?php endif ?>
		</tr>
        <tr>
            <td colspan="2"><input type="submit" value="Ajouter" style="display: none;" /></td>
        </tr>
		<?php else: ?>
		<tr>
			<td colspan="2">Encore aucune matière dans la base !</td>
		</tr>
		<?php endif  ?>
		</table>
		</form>
	</div>
</div>
