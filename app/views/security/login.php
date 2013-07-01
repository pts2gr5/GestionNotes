<div class="container">
    <form action="<?php echo $this->url('security/login') ?>" class="form-signin" method="post">
        <h2 class="form-signin-heading">Connexion</h2>
        <input type="text" name="username" class="input-block-level" placeholder="Nom d'utilisateur" required />
        <input type="password" name="password" class="input-block-level" placeholder="Mot de passe" required /></td>
        <button class="btn btn-large btn-primary" type="submit">Se connecter</button>
    </form>
</div>