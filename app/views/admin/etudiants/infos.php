<table class="no-border">
    <tr>
        <td>
            <b><?php printf('%s %s', $student['firstName'], $student['lastName']) ?></b>
            <br /><br />
        </td>
    <tr>
        <td>
            <label for="departement">Nom d'utilisateur</label>
            <br /><br />
            <?php echo $student['name'] ?>
            <br /><br />
        </td>
    </tr>
    <tr>
        <td>
            <label for="departement">Adresse e-mail</label>
            <br /><br />
            <?php echo $student['email'] ?>
            <br /><br />
        </td>
    </tr>
    <tr>
        <td>
            <label for="departement">Code apogée</label>
            <br /><br />
            <?php echo $student['apogee'] ?>
        </td>
    </tr>
</table>