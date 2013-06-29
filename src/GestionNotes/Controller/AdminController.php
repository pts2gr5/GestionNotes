<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
/**
 * Interface administrateur
 */ 
class GestionNotes_Controller_AdminController extends GestionNotes_Controller
{
    protected function init()
    {
        parent::init();
        
        $this->assert(
            $this->visitor['type'] == GestionNotes_Model_User::TYPE_ADMIN,
            'Cet espace est réservé aux administrateurs'
        );
    }
    
	/**
	 * Page d'accueil administrateur
	 */
	public function indexAction()
	{
		$this->params['list_title'] = 'Accueil';
		return $this->renderPage('admin/accueil');
	}
	
    // ------------------------------------------------------------------------ //
    //                              GERER LES ETUDIANTS                         //
    // ------------------------------------------------------------------------ //

	/**
	 * Liste des actions pour gérer les étudiants
	 */
	public function etudiantsAction()
	{
		$this->params['list_title'] = 'Gestion des étudiants';
		return $this->renderPage('admin/etudiants/accueil');
	}
    
	/**
	 * Gérer les étudiants
	 */
	public function listeEtudiantsAction()
	{
		$this->params['list_title'] = 'Gérer les étudiants';
        
        $params = array(
            'departement' => filter_var(@ $_REQUEST['departement'], FILTER_SANITIZE_NUMBER_INT),
            'formation'   => filter_var(@ $_REQUEST['formation'], FILTER_SANITIZE_NUMBER_INT),
            'semestre'    => filter_var(@ $_REQUEST['semestre'], FILTER_SANITIZE_NUMBER_INT),
            'td'          => filter_var(@ $_REQUEST['td'], FILTER_SANITIZE_NUMBER_INT),
            'tp'          => filter_var(@ $_REQUEST['tp'], FILTER_SANITIZE_NUMBER_INT),
        );
        
        $filters = array();
        foreach ( GestionNotes_Model_Node::fetchAll() as $node ) {
            if ( $node['type'] == GestionNotes_Model_Node::TYPE_DEPARTEMENT )
                $filters['departements'][] = $node;
            elseif ( $node['type'] == GestionNotes_Model_Node::TYPE_FORMATION && $node['parent'] == $params['departement'] )
                $filters['formations'][] = $node;
            elseif ( $node['type'] == GestionNotes_Model_Node::TYPE_SEMESTRE && $node['parent'] == $params['formation'] )
                $filters['semestres'][] = $node;
            elseif ( $node['type'] == GestionNotes_Model_Node::TYPE_GROUPE_TD && $node['parent'] == $params['semestre'] )
                $filters['td'][] = $node;
            elseif ( $node['type'] == GestionNotes_Model_Node::TYPE_GROUPE_TP && $node['parent'] == $params['td'] )
                $filters['tp'][] = $node;
        }
        
        if ( $params['tp'] )
            $this->params['users'] = GestionNotes_Model_Etudiant::fetchAllByTp($params['tp']);
        elseif ( $params['td'] )
            $this->params['users'] = GestionNotes_Model_Etudiant::fetchAllByTd($params['td']);
        elseif ( $params['semestre'] )
            $this->params['users'] = GestionNotes_Model_Etudiant::fetchAllBySemestre($params['semestre']);
        elseif ( $params['formation'] )
            $this->params['users'] = GestionNotes_Model_Etudiant::fetchAllByFormation($params['formation']);
        elseif ( $params['departement'] )
            $this->params['users'] = GestionNotes_Model_Etudiant::fetchAllByDepartement($params['departement']);
        else
            $this->params['users'] = GestionNotes_Model_Etudiant::fetchAll();
        
        $this->params['filters'] = & $filters;
        $this->params['selected'] = & $params;
        
		return $this->renderPage('admin/etudiants/liste');
	}
    
    /**
     * Retourne des informations sur un étudiant
     */
    public function infosEtudiantsAction()
    {
        $id = filter_var(@ $_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $this->params['student'] = GestionNotes_Model_Etudiant::fetchOneById($id);
        return $this->render('admin/etudiants/infos');
    }
    
    /**
     * Page d'ajout d'un étudiant
     */
    public function ajouterEtudiantsAction()
    {
		$this->params['list_title'] = 'Ajouter des étudiants';
		return $this->renderPage('admin/etudiants/ajouter');
    }
    
    /**
     * Ajout manuel d'un étudiant
     */
    public function creerEtudiantsAction()
    {
        $this->params['list_title'] = 'Créer un nouvel étudiant';
        $htis->params['user'] = new GestionNotes_Model_User();
        return $this->renderPage('admin/etudiants/editer');
    }
    
    /**
     * Editer un étudiant existant
     */
    public function editerEtudiantsAction()
    {
        $this->params['list_title'] = 'Editer un étudiant';
        $id = filter_var(@ $_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $this->params['user'] = $user = GestionNotes_Model_User::fetchOneById($id);
        $this->params['tree'] = GestionNotes_Model_Formation::fetchTreeByFormationId($user['formation']);
        return $this->renderPage('admin/etudiants/editer');
    }
    
    /**
     * Enregistre un étudiant
     */
    public function enregistrerEtudiantsAction()
    {
        $params = array(
            'id'        => filter_var(@ $_POST['id'], FILTER_SANITIZE_NUMBER_INT),
            'nom'       => filter_var(@ $_POST['nom'], FILTER_SANITIZE_STRING),
            'prenom'    => filter_var(@ $_POST['prenom'], FILTER_SANITIZE_STRING),
            'email'     => filter_var(@ $_POST['email'], FILTER_SANITIZE_STRING),
            'apogee'    => filter_var(@ $_POST['apogee'], FILTER_SANITIZE_STRING),
            'password'  => filter_var(@ $_POST['password'], FILTER_SANITIZE_STRING),
            // Seul l'ID TP nous intéresse, le reste (formation, dpt, etc.) s'en déduit.
            'formation' => filter_var(@ $_POST['tp'], FILTER_SANITIZE_NUMBER_INT),
        );
        
        if ( ! $params['id'] )
            // Création d'un nouvel étudiant
            GestionNotes_Model_Etudiant::creerEtudiant($params);
        else
            // Mise à jour d'un étudiant existant
            GestionNotes_Model_Etudiant::updateEtudiant($params['id'], $params);
        
        return $this->redirect($this->url('admin/etudiants/liste'));
    }
    
    /**
     * Effacer un étudiant
     */
    public function supprimerEtudiantsAction()
    {
        $id = filter_var(@ $_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        GestionNotes_Model_User::deleteUser($id);
        return $this->redirect($this->url('admin/etudiants/liste'));
    } 
    
    // ------------------------------------------------------------------------ //
    //                     GERER LES GROUPES / PROMOTIONS                       //
    // ------------------------------------------------------------------------ //
    
    /**
     * Retourne des informations sur une formation
     */
    public function infosPromotionsAction()
    {
        $id = filter_var(@ $_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $this->params['formation'] = GestionNotes_Model_Node::fetchTreeByNodeId($id);
        return $this->render('admin/promotions/infos');
    }
    
    /**
     * Retourne les formations pour un jCombo
     */
    public function comboPromotionsAction()
    {
        if ( isset($_REQUEST['id']) ) {
            $id = filter_var(@ $_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
            $nodes = GestionNotes_Model_Node::fetchByParentNodeId($id);
        } else {
            $type = filter_var(@ $_REQUEST['type'], FILTER_SANITIZE_NUMBER_INT);
            $nodes = GestionNotes_Model_Node::fetchByNodeType($type);
        }
        
        $result = array();
        foreach ( $nodes as $node )
            $result[ $node['id'] ] = utf8_decode($node['title']);
        return isset($_GET['callback']) ? sprintf('%s(%s)', $_GET['callback'], json_encode($result)) : json_encode($result);
    } 

	/**
	 * Page Gérer les étudiants :  ajouter manuellement un étudiant
	 */
	public function ajoutermanuellementstudentsAction()
	{
		$this->params['list_title'] = 'Ajouter des étudiants';
		$pretAEnvoie = true;
		$messages = array();
		
        $submit = isset($_REQUEST['envoie']) && $_REQUEST['envoie'];
		
		if (isset($_REQUEST['typeInscrit']) && $_REQUEST['typeInscrit'])
			$type = $_REQUEST['typeInscrit'];
		else {
			$type = 0;
			
			$pretAEnvoie = false;
			$messages[] = "Le champs 'type' est obligatoire !";
		}
		$this->params['selected'] = & $type;
		
        //on récupère tout les champs
		if (isset($_REQUEST['nomInscrit']) && !empty($_REQUEST['nomInscrit']))
			$nom = $_REQUEST['nomInscrit'];
		else {
			$pretAEnvoie = false;
			$messages[] = "Le nom est obligatoire !";
		}
		
		if (isset($_REQUEST['prenomInscrit']) && !empty($_REQUEST['prenomInscrit']))
			$prenom = $_REQUEST['prenomInscrit'];
		else {
			$pretAEnvoie = false;
			$messages[] = "Le prénom est obligatoire !";
		}
		
		if ( $type == GestionNotes_Model_User::TYPE_ETUDIANT ) {
    		if (isset($_REQUEST['codeApogeeInscrit']) && !empty($_REQUEST['codeApogeeInscrit']))
    			$apogee = $_REQUEST['codeApogeeInscrit'];
    		else {
    			$pretAEnvoie = false;
    			$messages[] = "Le code apogée est obligatoire !";
    		}
		
    		if (isset($_REQUEST['formationInscrit']) && !empty($_REQUEST['formationInscrit'])){
    			//on a cliqué sur une formation
    			$formation = $_REQUEST['formationInscrit'];
    			//on récupère les semestres de la formation	et on les transmets
    			$semestreTab = GestionNotes_Model_Node::fetchByParentNodeId($formation);
    			$this->params['semestres'] = & $semestreTab;
                if (isset($_REQUEST['semestreInscrit']) && !empty($_REQUEST['semestreInscrit'])) {
                    //on a cliqué sur un semestre
                    $semestre = $_REQUEST['semestreInscrit'];

                    //on récupère les tp de celui-ci et on les transmet
                    $tpTab = GestionNotes_Model_Formation::fetchtpBySemestreId($semestre);
                    $this->params['tps'] = & $tpTab;

                    if (isset($_REQUEST['TpInscrit']) && !empty($_REQUEST['TpInscrit'])){
                        //on a cliqué sur un tp
                        $tp = $_REQUEST['TpInscrit'];

                        //on ajoute l'étudiant
                        if ($pretAEnvoie && $submit){
                            $result = GestionNotes_Model_User::addUserEtudiant($nom,$nom,$prenom,$apogee,$tp);
                            if ($result){ //succès
                                $messages = "L'utilisateur à bien été ajouté à la base
                                <br/><br/>
                                <em>Son mots de passe est <strong>'secret'</strong></em>";
                                $this->params['messages'] = & $messages;
                            }
                            else {
                                $messages[] = "Erreur dans l'enregistrement de l'utilisateur";
                                $this->params['messages'] = & $messages;
                            }
                        }
                    } else {
                        //transmettre juste le message texte
                        $pretAEnvoie = false;
                        $messages[] = "Le champs 'TP' est obligatoire !";
                    }	
    			} else {
    				$pretAEnvoie = false;
    				//transmettre juste le message texte
    				$messages[] = "Un semestre est obligatoire !";
    			}			
    		}	
    		else {
    			$pretAEnvoie = false;
    			//transmettre juste le message texte
    			$messages[] = "Une formation est obligatoire !";
    		}
		} elseif($type == GestionNotes_Model_User::TYPE_ADMIN && $submit){
			//admin
			if ($pretAEnvoie){
				$result = GestionNotes_Model_User::addUserAdmin($nom,$nom,$prenom);
				if ($result){ //succès
					$messages = "L'utilisateur à bien été ajouté à la base
							<br/><br/>
							<em>Son mots de passe est <strong>'secret'</strong></em>";
					$this->params['messages'] = & $messages;
				}
				else {
					$messages[] = "Erreur dans l'enregistrement de l'utilisateur";
					$this->params['messages'] = & $messages;
				}
				
			}
		}
		elseif ($type == GestionNotes_Model_User::TYPE_DIRETUDE && $submit){
			//Directeur des études
			if ($pretAEnvoie){
				$result = GestionNotes_Model_User::addUserDD($nom,$nom,$prenom);
				if ($result){ //succès
					$messages = "L'utilisateur à bien été ajouté à la base
							<br/><br/>
							<em>Son mots de passe est <strong>'secret'</strong></em>";
					$this->params['messages'] = & $messages;
				}
				else {
					$messages[] = "Erreur dans l'enregistrement de l'utilisateur";
					$this->params['messages'] = & $messages;
				}
			}
		}
		
		$nodes = GestionNotes_Model_Node::fetchByNodeType(GestionNotes_Model_User::TYPE_DIRETUDE);
		$this->params['nodes'] = & $nodes;
		$this->params['type'] = & $type;

		//si il manque des informations
		if ($submit)
			if (!$pretAEnvoie)
				$this->params['messages'] = & $messages;
                
		return $this->renderPage('admin/ajoutermanuellementstudents');
	}

	/**
	 * Page Gérer les étudiants :  ajouter des étudiants par csv
	 */
	public function ajouterstudentsbyCSVAction()
	{
		$this->params['list_title'] = 'Ajouter des étudiants';
		return $this->renderPage('admin/ajouterstudentsbyCSV');
	}
    
    // ------------------------------------------------------------------------ //
    //                              GERER LES FORMATIONS                        //
    // ------------------------------------------------------------------------ //
    
    /**
     * Gestion des formations
     */
    public function formationsAction()
    {
        $this->params['list_title'] = 'Gestion des formations'; 
        $this->params['show_parent_column'] = false;
        return $this->createListByNodeType(GestionNotes_Model_Node::TYPE_FORMATION);
    }
    
    /**
     * Edition d'une formation
     */
    public function edit_nodeAction()
    {
    	$this->params['list_title'] = 'Editer une formation';
    	$idNode = filter_var( $_GET['id'], FILTER_SANITIZE_NUMBER_INT );
    	$nodes=GestionNotes_Model_Node::fetchOneByNodeId($idNode);
    	$this->params['node'] = & $nodes;
        
        if ( $nodes['type'] == GestionNotes_Model_Node::TYPE_EPREUVE ) {    		
		   if ( (isset($_REQUEST['coef']) && $_REQUEST['coef']) && (isset($_REQUEST['title']) && $_REQUEST['title'])) {
               $coef    = filter_var( $_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT );
               $title   = filter_var( $_REQUEST['title'], FILTER_SANITIZE_STRING );
   			   $result  = GestionNotes_Model_Node::modifierNode($idNode, $title, $nodes['type'], $nodes['parent'], $coef);
               if($result)
		    		$this->params['success'] = "Modification effectué avec succès.";
		       else
		    		$this->params['echec'] = sprintf('Echec de la modification de "%s"', htmlspecialchars($title));
           }
        } else if ( isset($_REQUEST['title']) && $_REQUEST['title'] ) {
           $title   = filter_var( $_REQUEST['title'], FILTER_SANITIZE_STRING );
           $result = GestionNotes_Model_Node::modifierNode($idNode,$title,$nodes['type'], $nodes['parent'], $nodes['coefficient'] );
           if($result)
	    		$this->params['success'] = "Modification effectué avec succès.";
	       else
	    		$this->params['echec'] = sprintf('Echec de la modification du %s', htmlspecialchars($title));
    	}
    	return $this->renderPage('admin/edit-node');	
    }
    
    public function delete_nodeAction()
    {
    	$this->params['list_title'] = 'Editer une formation';
    	$idNode = filter_var( $_GET['id'], FILTER_SANITIZE_NUMBER_INT );
    	$result = GestionNotes_Model_Node::supprimerNode($idNode);
    	$this->redirect($this->url('admin/formations'));
    	
    }
    
    /**
     * Navigation dans les nodes
     */
    public function list_nodesAction()
    {
    	$this->params['list_title'] = 'Gestion des formations';
        $parentNodeId = filter_var(@ $_REQUEST['id'], FILTER_SANITIZE_STRING );
        $this->params['show_parent_column'] = false;
        
        if ( $nodes = GestionNotes_Model_Node::fetchByParentNodeId($parentNodeId) )
        {
            $this->params['nodes']      = & $nodes;
            $this->params['parent']     = & $nodes['parent'];
            $this->params['titleNode']  = & $nodes['parent']['title'];
            unset($nodes['parent']);
        }
        else
        {
        	//Quand il n'y a pas d'enfant 
            $parentNode = GestionNotes_Model_Node::fetchOneByNodeId($parentNodeId);
            $this->params['nodes'] = array();
            $this->params['idNode'] = $parentNodeId;
            $this->params['typeNode'] = GestionNotes_Model_Node::typeById($parentNodeId);
        }
        
        return $this->renderPage('admin/list-nodes');
    }
    /**
     * Liste des utilisateurs
     * @return string
     */
    public function list_studentsAction()
    {
    	$parentNodeId = filter_var( $_REQUEST['id'], FILTER_SANITIZE_STRING );
    	$this->params['show_parent_column'] = false;
    	if ( $nodes = GestionNotes_Model_Node::fetchByParentNodeId($parentNodeId) )
    	{
    		$this->params['nodes'] = & $nodes;
    		$this->params['parent'] = $nodes['parent'];
    		$this->params['list_title'] = $nodes['parent']['title'];
    		unset($nodes['parent']);
    	}
    	else
    	{
    		$parentNode = GestionNotes_Model_Node::fetchOneByNodeId($parentNodeId);
    		$this->params['nodes'] = array();
    		$this->params['list_title'] = $parentNode ? $parentNode['title'] : 'Element inconnu';
    	}
    	return $this->renderPage('admin/list-nodes');
    }
    
    /**
     * Ajoute un élément
     */
    public function create_nodeAction()
    {
        $parentNodeId = filter_var( $_REQUEST['parent_id'], FILTER_SANITIZE_NUMBER_INT );
        $nodeType     = filter_var( $_REQUEST['node_type'], FILTER_SANITIZE_NUMBER_INT );
        $nodeTitle    = filter_var( $_REQUEST['title'], FILTER_SANITIZE_STRING );
        $coef         = filter_var( $_REQUEST['coef'], FILTER_SANITIZE_NUMBER_INT);
        
        if ($nodeType == GestionNotes_Model_Node::TYPE_EPREUVE && !empty($_REQUEST['coef']))
        	GestionNotes_Model_Node::createNode2($nodeTitle, $nodeType, $parentNodeId,$coef );
        else
        	GestionNotes_Model_Node::createNode2($nodeTitle, $nodeType, $parentNodeId);
        
    	$this->redirect($this->url('admin/list-nodes', array('id'=>$parentNodeId)));
    }
    
	/**
	 * Rechercher un étudiant
	 */
	public function rechercherstudentAction()
	{
        $this->params['list_title'] = 'Rechercher un étudiant';

        if ( isset($_REQUEST['codeApogee']) && $_REQUEST['codeApogee'] ){
            //si on cherche un code Apogée
            $_REQUEST['termeRecherche'] = $codeApogee = filter_var($_REQUEST['codeApogee'], FILTER_SANITIZE_STRING);
            $userRechercher = GestionNotes_Model_User::recupererByCodeApogee($codeApogee);
            $this->params['userRecherche'] = & $userRechercher;
            $tp = $userRechercher['formation_id'];
            $td = GestionNotes_Model_Formation::idTpToIdTd($tp);
            $tp = GestionNotes_Model_Formation::tpIdToTitle($tp);
            $this->params['tp'] = $tp;
            $this->params['td'] = $td;
            return $this->renderPage('admin/resultatRecherche');
        }
        elseif ( isset($_REQUEST['nom']) || isset($_REQUEST['prenom']) ){
            $nom = filter_var($_REQUEST['nom'], FILTER_SANITIZE_STRING);
            $prenom = filter_var($_REQUEST['prenom'], FILTER_SANITIZE_STRING);
            //si on cherche un nom ou un prénom
            $_REQUEST['termeRecherche'] = sprintf('%s %s', $nom, $prenom);
            $userRechercher = GestionNotes_Model_User::recupererByNomPrenom($nom, $prenom);
            $this->params['userRecherche'] = & $userRechercher;
            //faire passer le td en paramètre
            $tp = $userRechercher['formation_id'];
            $td = GestionNotes_Model_Formation::idTpToIdTd($tp);
            $tp = GestionNotes_Model_Formation::tpIdToTitle($tp);
            $this->params['tp'] = $tp;
            $this->params['td'] = $td;
            return $this->renderPage('admin/resultatRecherche');
        }

        return $this->renderPage('admin/rechercherstudent');
	}

	/**
	 * Page Gérer les groupes : TD, TP ...
	 */
	public function groupesAction()
	{
		$this->params['list_title'] = 'Gestion des groupes';
        $this->params['semestres'] = GestionNotes_Model_Node::fetchByNodeType(GestionNotes_Model_Node::TYPE_SEMESTRE);
        $this->params['td'] = GestionNotes_Model_Formation::fetchAllTD();
        $this->params['tp'] = GestionNotes_Model_Formation::fetchAllTP();
		return $this->renderPage('admin/groupes');
	}
    
    public function editgroupAction()
    {
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $this->params['formation'] = GestionNotes_Model_Formation::fetchOneByFormationId($id);
        return $this->renderPage('admin/editgroup');
    }
    
    public function savegroupAction()
    {
        $id     = filter_var($_REQUEST['formation_id'], FILTER_SANITIZE_NUMBER_INT);
        $title  = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        GestionNotes_Model_Formation::updateFormation($id, $title);
        return $this->redirect($this->url('admin/groupes'));
    }
    
    public function addgroupAction()
    {
        $title  = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $parent = filter_var($_POST['parent'], FILTER_SANITIZE_NUMBER_INT);
        $type   = filter_var($_POST['type'], FILTER_SANITIZE_NUMBER_INT);
        GestionNotes_Model_Formation::addFormation($title, $type, $parent);
        return $this->redirect($this->url('admin/groupes'));
    }
    
    public function delgroupAction()
    {
        $id = filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        GestionNotes_Model_Formation::delFormation($id);
        return $this->redirect($this->url('admin/groupes'));
    }
    
	/**
	 * Page d'édition/modification d'un étudiant
	 */
	public function editerstudentAction()
	{
		$this->params['list_title'] = 'Modifier un étudiant';
		return $this->renderPage('admin/editerstudent');
	}
    
    protected function createListByNodeType(/* int */ $nodeType)
    {
        $nodes = GestionNotes_Model_Node::fetchByNodeType($nodeType);
        $this->params['nodes'] = & $nodes;
        return $this->renderPage('admin/list-nodes');
    }
}