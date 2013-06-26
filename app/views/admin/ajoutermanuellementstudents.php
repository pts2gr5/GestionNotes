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
    <form name="ajouterUser" method="post" action="<?php echo $this->url('admin/ajoutermanuellementstudents') ?>">
    <table class="formulaire" >
    <?php if ( isset($messages) ): //Il y a 1 ou plusieurs messages ?>
	<?php if ( is_array($messages) && count($messages) > 0 ):?>
		    <tr>
			    <td colspan="2" class="ContenerError">
		            <ul>
		            	<?php foreach($messages as $message):?>
		                       <li><?php echo $message;?></li>
		                <?php endforeach;?>               
		                          
		            </ul>
		        </td>
	    </tr>
	  <?php else : ?>
	  <tr>
			    <td colspan="2" class="ContenerSuccess">
		            <ul>
		            	
		               <li><?php echo $messages;?></li>
		                         
		                          
		            </ul>
		        </td>
	    </tr>
	 <?php endif;?>
	 <?php endif;?>
	    <tr>
	    	<td>Nom :</td>
	    	<td><input name="nomInscrit" class="INPUT_text" type="text" <?php if (!empty($_REQUEST['nomInscrit'])){echo 'value="',$_REQUEST['nomInscrit'],'"';} ?>/></td>
	    </tr>
	    <tr>
	    	<td>Prénom :</td>
	    	<td><input name="prenomInscrit"  class="INPUT_text" type="text" value="<?php echo htmlspecialchars(@ $_REQUEST['prenomInscrit']) ?>/></td>
	    </tr>
	    <tr>
	    	<td>Type :</td>
	    	<td><select name="typeInscrit" name="boite2" onchange="ajouterUser.submit()">
		    	<option selected></option>
				<option value="3" <?php if($selected==3)echo " selected"; ?>>Etudiant</option>
				<option value="2" <?php if($selected==2)echo " selected"; ?>>Directeur des études</option>
				<option value="1" <?php if($selected==1)echo " selected"; ?>>Administrateur</option>		
			</select>
			</td>
	    </tr>
	    <?php if ($type == 3):?>
			    <tr>
			    	<td>Code Apogée :</td>
			    	<td><input name="codeApogeeInscrit" class="INPUT_text" type="text" size="8" value="<?php echo htmlspecialchars(@ $_REQUEST['codeApogeeInscrit']) ?>/>/></td>
			    </tr>
			     <tr>
			    	<td>Formation :</td>
			    	<td><select name="formationInscrit" name="boite2" onchange="ajouterUser.submit()">
			    	<option selected></option>
			    	<?php if ( is_array($nodes) && count($nodes) > 0 ): ?>
								<?php foreach ( $nodes as $node ): ?>
									<?php $selected = (isset($_REQUEST['formationInscrit']) && intval($_REQUEST['formationInscrit']) == $node['id']) ? 'selected' : ''; ?>
									<option value="<?php echo $node['id'] ?>" <?php echo $selected ?>>
										<?php echo $node['title']; ?>
									</option>
								<?php endforeach; ?>
					<?php else : ?>
					<option>Aucune formation</option>
					<?php endif; ?>			
					</select>
					</td>
			    </tr>
			    
			    <?php if(isset($semestres)):?>
			    <tr>
			    	<td>Semestre :</td>
			    	<td><select name="semestreInscrit" name="boite2" onchange="ajouterUser.submit()">
			    	<option selected></option>
			    	<?php if ( is_array($semestres) && count($semestres) > 0 ): ?>
								<?php foreach ( $semestres as $semestre ): ?>
									<?php $selected = (isset($_REQUEST['semestreInscrit']) && intval($_REQUEST['semestreInscrit']) == $semestre['id']) ? 'selected' : ''; ?>
									<option value="<?php echo $semestre['id'] ?>" <?php echo $selected ?>>
										<?php echo $semestre['title']; ?>
									</option>
								<?php endforeach; ?>
					<?php else : ?>
					<option>Aucun TD</option>
					<?php endif; ?>			
					</select>
					</td>
			    </tr>
			    
			    <?php if(isset($tps)):?>
			    <tr>
			    	<td>TP :</td>
			    	<td><select name="TpInscrit" name="boite2" onchange="ajouterUser.submit()">
			    	<option selected></option>
			    	<?php if ( is_array($tps) && count($tps) > 0 ): ?>
								<?php foreach ( $tps as $tp ): ?>
									<?php $selected = (isset($_REQUEST['TpInscrit']) && intval($_REQUEST['TpInscrit']) == $tp['id']) ? 'selected' : ''; ?>
									<option value="<?php echo $tp['id'] ?>" <?php echo $selected ?>>
										<?php echo $tp['title']; ?>
									</option>
								<?php endforeach; ?>
					<?php else : ?>
					<option>Aucun TP</option>
					<?php endif; ?>			
					</select>
					</td>
			    </tr>
			    <?php endif; //fin condition $tps ?>
			    <?php endif; //fin condition $semestres ?>
	    <?php endif; //fin condition $type ?>
	    <tr><td><input name="envoie" class="INPUT_submit" type="submit" value="Ajouter"/></td></tr>
    </table>
	</form>
        
       
     
        
        
    </div>
</div>