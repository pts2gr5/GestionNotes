<div id="corps_titreEtSousMenu">
    <div id="corps_titreEtSousMenu_titre">
        <h1><?php echo $list_title ?></h1>
    </div>
</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">
        <form name="ajouterUser" method="post" action="<?php echo !isset($user['id']) ? $this->url('admin/etudiants/creer') : $this->url('admin/etudiants/editer') ?>">
        <table class="formulaire" >
        <tr>
            <td><label for="nom">Nom :</label></td>
            <td><input name="nom" class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $_POST['nom']) ?>" required /></td>
        </tr>
        <tr>
            <td><label for="prenom">Prénom :</label></td>
            <td><input name="prenom"  class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $_POST['prenom']) ?>" required /></td>
        </tr>
        <tr>
            <td><label for="email">Adresse e-mail :</label></td>
            <td><input name="email"  class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $_POST['email']) ?>" required /></td>
        </tr>
        <tr>
            <td><label for="apogee">Code Apogée :</label></td>
            <td><input name="apogee"  class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $_POST['apogee']) ?>" required /></td>
        </tr>
        <tr>
            <td><label for="password">Mot de passe :</label></td>
            <td><input name="password"  class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $_POST['password']) ?>" required /></td>
        </tr>
        <?php function show_input($title, $name, array $data, array $selected) { ?>
        <tr>
            <td><label for="<?php echo $name ?>"><?php echo $title ?> :</label></td>
            <td>
                <select id="<?php echo $name ?>" name="<?php echo $name ?>" onchange="ajouterUser.submit()">
                    <option></option>
                    <?php foreach ( $data as $entry ): ?>
                    <option value="<?php echo $entry['id'] ?>" <?php if ( $selected[$name] == $entry['id'] ) echo 'selected' ?>><?php echo utf8_decode($entry['title']) ?></option>
                    <?php endforeach ?>
                </select>
            </td>
        </tr>
        <?php } ?>
        <?php
            if ( isset($departements) && $departements ) {
                show_input('Département','departement',$departements,$selected);
                if ( isset($formations) && $formations ) {
                    show_input('Formation','formation',$formations,$selected);
                    if ( isset($semestres) && $semestres ) {
                        show_input('Semestre','semestre',$semestres,$selected);
                        if ( isset($td) && $td ) {
                            show_input('Groupe TD','td',$td,$selected);
                            if ( isset($tp) && $tp )    
                                show_input('Groupe TP','tp',$tp,$selected);
            }}}}
        ?>
        </table>
        
        <div align="center">
            <input type="submit" class="INPUT_submit" value="Ajouter" />
        </div>
        </form>
    </div>
</div>