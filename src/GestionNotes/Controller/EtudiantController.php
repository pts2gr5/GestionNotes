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
	public function moyennesAction()
	{
		$this->params['list_title'] = 'Mes résultats';
        return $this->renderPage('etudiant/moyennes');
	}
}