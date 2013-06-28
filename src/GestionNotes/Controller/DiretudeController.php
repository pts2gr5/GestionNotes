<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
/**
 * Interface directeur des études
 */ 
class GestionNotes_Controller_DiretudeController extends GestionNotes_Controller
{
    protected function init()
    {
        parent::init();
        
        $this->assert(
            $this->visitor['type'] == GestionNotes_Model_User::TYPE_DIRETUDE,
            'Cet espace est réservé aux directeurs des études'
        );
    }
	
	/**
	 * Accueil
	 */
	public function indexAction()
	{
		$this->params['list_title'] = 'Accueil';
	
		return $this->renderPage('diretude/index');
	}
	
	private function favorisAction(){
		
	}
	
	
    /**
     * Gestion des formations
     */
    public function moyennesAction()
    {
    	$this->params['list_title'] = 'Voir les moyennes';
    	//$this->params['users'] = & $userTab;
    	
    	
    	
    	return $this->renderPage('diretude/moyennes');
    }
    
    /**
     * Consulter résultat
     */
    public function consulterresultatAction()
    {
    	$this->params['list_title'] = 'Consulter les résultats';
    	
    
    	return $this->renderPage('diretude/consulterresultat');
    }
    
    public function resultatsAction()
    {
    	$this->params['list_title'] = 'Consulter les résultats';
    	//$this->params['users'] = & $userTab;
    	 
    	 
    	
    	return $this->renderPage('diretude/resultats');
    }
    
    public function apogeeAction()
    {
    	$this->params['list_title'] = 'Consulter les résultats';
    	//$this->params['users'] = & $userTab;
    
    
    	
    	return $this->renderPage('diretude/apogee');
    }
    

    public function nomAction()
    {
    	$this->params['list_title'] = 'Consulter les résultats';
    	//$this->params['users'] = & $userTab;
    
    
    	
    	return $this->renderPage('diretude/nom');
    }
    

    public function parcoursAction()
    {
    	$this->params['list_title'] = 'Consulter les résultats';
    	//$this->params['users'] = & $userTab;
    
    
    	
    	return $this->renderPage('diretude/parcours');
    }
    
   
}