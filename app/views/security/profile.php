<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
	<h1>Paramètres Utilisateur</h1>
	</div>
</div>

<div id="corps_contenu">
    <h2>Modifier mon mot de passe</h2>
    <br />
	<form action="<?php echo $this->url('security/editpassword') ?>" method="post">
    <table class="no-border">
    <thead>
    <tr>
        <td><label for="password">Nouveau mot de passe :</label></td>
        <td><input class="INPUT_text" type="password" name="password" placeholder="Nouveau mot de passe" /></td>
    </tr>
    <tr>
        <td><label for="password_confirm">Confirmation du nouveau mot de passe :</label></td>
        <td><input class="INPUT_text" type="password" name="password_confirm" placeholder="Confirmer le mot de passe" /></td>
    </tr>
    <tr>
        <td colspan="2"><input class="INPUT_submit" type="submit" value="Changer le mot de passe"/></td>
    </tr>
    </table>
	</form>
</div>