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
     * Navigation dans les nodes
     */
    public function list_nodesAction()
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
        $parentNodeId = filter_var( $_POST['parent_id'], FILTER_SANITIZE_NUMBER_INT );
        $nodeType     = filter_var( $_REQUEST['node_type'], FILTER_SANITIZE_NUMBER_INT );
        $nodeTitle    = filter_var( $_REQUEST['title'], FILTER_SANITIZE_STRING );
        
        GestionNotes_Model_Node::createNode2($nodeTitle, $nodeType, $parentNodeId);
        $this->redirect($this->url('admin/list-nodes', array('id'=>$parentNodeId)));
    }
    
	/**
	 * Rechercher un étudiant
	 */
	public function rechercherstudentAction()
	{
		$this->params['list_title'] = 'Rechercher un étudiant';
		return $this->renderPage('admin/rechercherstudent');
	}
	
	/**
	 * Page Gérer les groupes : TD, TP ...
	 */
	public function groupesAction()
	{
		$this->params['list_title'] = 'Gestion des groupes';
		return $this->renderPage('admin/groupes');
	}
	
	/**
	 * Page Gérer les étudiants accueil
	 */
	public function studentsAction()
	{
		$this->params['list_title'] = 'Gestion des étudiants';
		return $this->renderPage('admin/students');
	}
    
	/**
	 * Page Gérer les étudiants gérer
	 */
	public function gererstudentsAction()
	{
		$this->params['list_title'] = 'Gérer les étudiants';
		//on récupère tous les paramètres
		if (isset($_REQUEST['choixFormation']))
			$choixFormation = $_REQUEST['choixFormation'];
		else 
			$choixFormation = 'tout';
		
		if (isset($_REQUEST['choixTD']))
			$choixTd = $_REQUEST['choixTD'];
		else
			$choixTd = 'tout';
		
		if (isset($_REQUEST['choixTP']))
			$choixTp = $_REQUEST['choixTP'];
		else
			$choixTp = 'tout';
		
		if (isset($_REQUEST['afficherMax']))
			$afficherMax = $_REQUEST['afficherMax'];
		else
			$afficherMax = 50;
		
		$userTab = GestionNotes_Model_User::recupererAllUser();
		//$userTab contient bien 100 enregistrents mais toutes les 
		//valeurs sont en protected et sont null
		$this->params['users'] = & $userTab;
		
		//on met les paramètres dans l'url
		$this->url('admin/gererstudents', array('formation'=>$choixFormation, 'choixTD'=>$choixTd, 'choixTP'=>$choixTp, 'afficher'=>$afficherMax));
		//cela ne met rien dans l'url
        
		return $this->renderPage('admin/gererstudent');
	}
    
	/**
	 * Page d'édition/modification d'un étudiant
	 */
	public function editerstudentAction()
	{
		$this->params['list_title'] = 'Modifier un étudiant';
		return $this->renderPage('admin/editerstudent');
	}
	
	/**
	 * Page Gérer les étudiants ajouter
	 */
	public function ajouterstudentsAction()
	{
		$this->params['list_title'] = 'Ajouter des étudiants';
		$this->redirect($this->url('admin/ajoutermanuellementstudents'));
	}
	
	/**
	 * Page Gérer les étudiants :  ajouter manuellement un étudiant
	 */
	public function ajoutermanuellementstudentsAction()
	{
		$this->params['list_title'] = 'Ajouter des étudiants';
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
    
    protected function createListByNodeType(/* int */ $nodeType)
    {
        $nodes = GestionNotes_Model_Node::fetchByNodeType($nodeType);
        $this->params['nodes'] = & $nodes;
        return $this->renderPage('admin/list-nodes');
    }
}