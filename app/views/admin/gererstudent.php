<div id="corps_titreEtSousMenu">
			<div id="corps_titreEtSousMenu_titre">
			<h1><?php echo $list_title ?></h1>
			</div>
<div id="corps_titreEtSousMenu_option"><img src="images/print.png" alt="Imprimer" /></div>
			<div id="corps_titreEtSousMenu_sousMenu">
			<ul><li><a href="<?php echo $this->url('admin/gererstudents') ?>">Voir tous</a></li><li><a href="<?php echo $this->url('admin/rechercherstudent') ?>">Rechercher</a></li></ul>
</div>
			
		</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">

    <table class="tableauTailleMini" cellspacing="0">
            <tr class="entete">
                <td>Code Apogée</td>
                <td>Nom</td>
				<td>Prénom</td>
				<td>TD</td>
				<td>TP</td>
				<td>Options</td>
			</tr>
            <?php foreach ($users as $user):?>
            <tr class="hoverable">
					<td><?php echo $user['id'];/* champs null */ ?></td> 
					<td><?php echo $user['lastName']; /* champs null */ ?></td>
					<td><?php echo $user['firstName']; /* champs null */ ?></td>
					<td><?php echo $user['formation']; /* champs null */ ?></td>
					<td><?php echo $user['formation'];  /* champs null */ ?></td>
					<td>
						<a href="<?php echo $this->url('admin/editerstudent') ?>"><img src="images/icone_editer.png" alt="Editer" /></a>
						<a href="<?php echo $this->url('admin/editerstudent') ?>"><img src="images/croix_rouge.png" alt="Supprimer" /></a>
					</td>
			</tr>
			<?php endforeach;?>
			
        </table>
       
         <!-- formulaire d'ajout node -->
        <div id="ajouterUneNoteACoteDuTableau">
            <span>Filtre</span>
			<br/><br/>
            <form method="post">
		<table class="no-border">
			<tr><td><label for="title">Formation</label></td></tr>
            <tr>
				<td class="select"><select name="choixFormation">
						<option selected>Tout</option> 
						<option>Dut Informatique</option> 
						<option>Dut Biologie</option> 
						<option>Dut SRC</option> 
					</select>
				</td>
			</tr>
			<tr>			
				<td> <br/><label for="title">TD :</label></td>
			</tr>
			<tr>
				<td class="select"><select name="choixTD"> 
					<option selected>Tout</option> 
					<option class="option">11</option> 
					<option class="option">12</option> 
				</select></td>
			</tr>
			<tr>
				<td><br/><label for="title">TP :</label></td>
			</tr>
			<tr>
				<td class="select"><select name="choixTP"> 
					<option selected>Tout</option> 
					<option>A</option> 
					<option>B</option> 
					<option>C</option> 
					<option>D</option> 
				</select></td>
			</tr>
			
			
			<tr>
				<td><br/><label for="title">Afficher :</label></td>
			</tr>
			<tr>
				<td>
						<input name="afficherMax" class="INPUT_text" type="text" size="4" value="50" style="text-align:center;" />
				</td>
			</tr>
				</table>
                <br/><input class="INPUT_submit" type="submit" value="Filtre"/>
            </form>
        </div>
        <!-- / formulaire d'ajout node -->
	


        
       
     
        
        
    </div>
</div>