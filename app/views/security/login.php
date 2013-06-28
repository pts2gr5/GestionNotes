<form action="<?php echo $this->url('security/login') ?>" method="post">
<table class="login-box">
<tbody>
    <tr>
        <td colspan="2"><h2>Identification</h2></td>
    </tr>
    <?php if ( isset($errors) && count($errors) > 0 ): ?>
    <tr class="errors">
        <td colspan="2">
            <ul>
                <?php foreach ($errors as $error): ?>
                <li><?php echo $error ?></li>
                <?php endforeach ?>
            </ul>
        </td>
    </tr>
    <?php endif ?>
    <tr>
        <td><label for="username">Nom d'utilisateur:</label></td>
        <td><input type="text" name="username" placeholder="Nom d'utilisateur" required /></td>
    </tr>
    <tr>
        <td><label for="password">Mot de passe:</label></td>
        <td><input type="password" name="password" placeholder="Mot de passe" required /></td>
    </tr>
    <tr>
        <td colspan="2"><input class="INPUT_submit" type="submit" value="Se connecter" /></td>
    </tr>
</tbody>
</table>
</form>