<div id="corps_titreEtSousMenu">
	<div id="corps_titreEtSousMenu_titre">
	<h1>Paramètres Utilisateur</h1>
	</div>
</div>

<div id="corps_contenu">
    <h2>Modifier mon mot de passe</h2>
    <br />
	<form id="change-password" action="<?php echo $this->url('security/profile') ?>" method="post">
    <table class="no-border" >
    <thead>
    <?php if ( isset($errors) && count($errors) > 0 ): ?>
    <tr>
        <td colspan="2" class="ContenerError">
            <ul>
                <?php foreach ( $errors as $error ): ?>
                <li><?php echo $error ?></li>
                <?php endforeach ?>
            </ul>
        </td>
    </tr>
    <?php endif ?>
    <tr class="text-align-left">
        <td  class="text-align-left"><label for="password">Nouveau mot de passe :</label></td>
        <td><input class="INPUT_text" type="password" name="password" placeholder="Nouveau mot de passe" required /></td>
    </tr>
    <tr>
        <td  class="text-align-left"><label for="password_confirm">Confirmation du nouveau mot de passe :</label></td>
        <td><input class="INPUT_text" type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required /></td>
    </tr>
    <tr>
        <td class="floatLeft" colspan="2"><input class="INPUT_submit" type="submit" name="editpassword" value="Changer le mot de passe"/></td>
    </tr>
    </table>
	</form>
</div>

<script type="text/javascript">
document.getElementById('change-password').addEventListener('submit', function (e) {
    var password1 = document.getElementsByName('password')[0].value;
    var password2 = document.getElementsByName('password_confirm')[0].value;
    if ( new String(password1).valueOf() !== new String(password2).valueOf() ) {
        alert('Les mots de passe ne sont pas égaux.');
        e.preventDefault();
    }
}, false);
</script>