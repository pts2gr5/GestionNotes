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
        return $this->renderPage('index');
    }
}