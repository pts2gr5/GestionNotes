<div id="corps_titreEtSousMenu">
			<div id="corps_titreEtSousMenu_titre">
			<h1><?php echo $list_title ?></h1>
			</div>

			<div id="corps_titreEtSousMenu_sousMenu">
			<ul><li><a href="<?php echo $this->url('admin/ajoutermanuellementstudents') ?>">Manuellement</a></li><li><a href="<?php echo $this->url('admin/ajouterstudentsbyCSV') ?>">Par CSV</a></li></ul>
			
</div>
			
		</div>

<div id="corps_contenu">    
    <div id="corps_contenu_contenu">

    
    <div id="corps_contenu_titreEtSousTitre">
			<h2>Ajouter un étudiant manuellement</h2>
	</div>
		
    <!-- Ajout manuel d'étudiant -->
    <table class="formulaire" >
	    <tr>
	    	<td>Nom :</td>
	    	<td><input class="INPUT_text" type="text" /></td>
	    </tr>
	    <tr>
	    	<td>Prénom :</td>
	    	<td><input class="INPUT_text" type="text" /></td>
	    </tr>
	    <tr>
	    	<td>Code Apogée :</td>
	    	<td><input class="INPUT_text" type="text" /></td>
	    </tr>
	     <tr>
	    	<td>Email :</td>
	    	<td><input class="INPUT_text" type="text" /></td>
	    </tr>
	     <tr>
	    	<td>Groupe TP :</td>
	    	<td><select name="boite2">
						<option selected>A</option> 
						<option>B</option> 
						<option selected>C</option> 
						<option>D</option> 
						
					</select>
			</td>
	    </tr>
	    
	    
	    <tr><td><input class="INPUT_submit" type="submit" value="Ajouter"/></td></tr>
    </table>

        
       
     
        
        
    </div>
</div>