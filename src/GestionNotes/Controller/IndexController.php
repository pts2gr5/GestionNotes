<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
class GestionNotes_Controller_IndexController extends GestionNotes_Controller
{
    /**
     * Dit bonjour !
     */
    public function indexAction()
    {
        switch ( $this->visitor['type'] )
        {
        case GestionNotes_Model_User::TYPE_ETUDIANT:
            $this->redirect($this->url('etudiant'));
            break;
        case GestionNotes_Model_User::TYPE_DIRETUDE:
            $this->redirect($this->url('diretude'));
            break;
        case GestionNotes_Model_User::TYPE_ADMIN:
            $this->redirect($this->url('admin'));
            break;
        }
        return $this->renderPage('index');
    }
}