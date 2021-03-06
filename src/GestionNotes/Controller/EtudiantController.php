<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
/**
 * Interface étudiant
 */ 
class GestionNotes_Controller_EtudiantController extends GestionNotes_Controller
{
    protected function init()
    {
        parent::init();
        
        $this->assert(
            $this->visitor['type'] == GestionNotes_Model_User::TYPE_ETUDIANT,
            'Cet espace est réservé aux étudiants'
        );
    }
    
	/**
	 * Accueil
	 */
	public function indexAction()
	{
		$this->params['list_title'] = 'Accueil';
		return $this->renderPage('etudiant/index');
	}
    
	public function moyennesAction()
	{
		$this->params['list_title'] = 'Mes résultats';
        $this->params['nodes'] = GestionNotes_Model_Formation::fetchAllByFormationid($this->visitor['formation']);
        $this->params['notes'] = GestionNotes_Model_Note::fetchAllByUserId($this->visitor['id']);
        return $this->renderPage('etudiant/moyennes');
	}
    
	public function simulationsAction()
	{
		$this->params['list_title'] = 'Simulation';
		return $this->renderPage('etudiant/simulations');
	}
	
	public function notesAction()
	{
		$this->params['list_title'] = 'Gestion des notes';
		return $this->renderPage('etudiant/notes');
	}
    
	public function ajouternoteAction()
	{
		$this->params['list_title'] = 'Ajouter une note';
		$nodes = GestionNotes_Model_Node::fetchByNodeType(6);
		$this->params['nodes'] = & $nodes;
        
		//Si on a cliqué sur une matière
		if ( isset($_REQUEST['matiere']) && $_REQUEST['matiere'] )
        {
            $matiere = filter_var($_REQUEST['matiere'], FILTER_SANITIZE_NUMBER_INT);
			$epreuvesTab = GestionNotes_Model_Node::listeEpreuvesByMatiereID($matiere);
			$this->params['epreuves'] = & $epreuvesTab;
			
			//Si on a cliqué sur une épreuve
			if ( isset($_REQUEST['epreuve']) && $_REQUEST['epreuve'] ) {
				//on teste si l'utilisateur a déjà entré une note pour cette épreuve-ci
				if ( isset($_REQUEST['note']) && $_REQUEST['note'] ) {
                    $note = filter_var($_REQUEST['note'], FILTER_SANITIZE_NUMBER_FLOAT);
                    GestionNotes_Model_Node::ajouterNote($this->visitor['id'], $matiere, $note);
					return $this->redirect($this->url('etudiant/moyennes'));
				}
			}
		}
        
		return $this->renderPage('etudiant/ajouternote');
	}
}