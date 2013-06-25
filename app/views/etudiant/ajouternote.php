<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1>Ajouter une note</h1>
    </div>
</div>

<div id="corps_contenu">
    <div id="corps_contenu_contenu">
        <form name="ajouternote" method="post" action="<?php echo $this->url('etudiant/ajouternote') ?>">
        <table class="formulaire">
        <?php if ( is_array($nodes) && count($nodes) > 0 ): ?>
            <tr>
                <td><label for="matiere">Matière :</label></td>
                <td>
                    <select name="matiere" size="<?php echo count($nodes) >= 5 ? 5 : count($nodes) ?>" onchange="ajouternote.submit()">
                        <option value="0" <?php echo ! isset($_REQUEST['matiere']) ? 'selected' : '' ?> />
                        <?php foreach ( $nodes as $node ): ?>
                        <?php $selected = (isset($_REQUEST['matiere']) && intval($_REQUEST['matiere']) == $node['id']) ? 'selected' : ''; ?>
                        <option value="<?php echo $node['id'] ?>" <?php echo $selected ?>><?php echo $node['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <!-- Si on a cliqué sur une matière, on affiche les épreuves -->
            <?php if ( isset($_REQUEST['matiere']) ): ?>
            <?php if ( isset($epreuves) && is_array($epreuves) && count($epreuves) > 0 ): ?>
            <tr>
                <td><label for="epreuve">Epreuve :</label></td>
                <td>
                    <select name="epreuve" onchange="ajouternote.submit()">
                        <option value="0" <?php echo ! isset($_REQUEST['epreuve']) ? 'selected' : '' ?> />
                        <?php foreach ( $epreuves as $ep ): ?>
                        <?php $selected = (isset($_REQUEST['epreuve']) && intval($_REQUEST['epreuve']) == $ep['id']) ? 'selected' : ''; ?>
                        <option value="<?php echo $ep['id'] ?>" <?php echo $selected ?>><?php echo $ep['title']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            
			<!-- Si on a cliqué sur une épreuve, on affiche les un champs de texte -->
            <tr>
			<?php if ( isset($_REQUEST['epreuve']) && $_REQUEST['epreuve'] ): ?>
                <td><label for="note">Note:</label></td>
                <td>
                    <input type="text" class="INPUT_text"  name="note" placeholder="Note" size="4" />
                    <br /><br />
                    <input type="submit" value="Ajouter" />
                </td>
            <?php endif  ?>
            <?php else: ?>
                <td colspan="2">Aucune épreuve définie pour cette matière.</td>
            </tr>
            <?php endif;  ?>
            <?php endif ?>
        <?php else: ?>
            <tr>
                <td colspan="2">Encore aucune matière dans la base !</td>
            </tr>
        <?php endif  ?>
        </table>
        </form>
    </div>
</div>