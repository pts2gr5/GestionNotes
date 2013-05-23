<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes\Controller;

use GestionNotes\Controller;
 
class IndexController extends Controller
{
    /**
     * Dit bonjour !
     */
    public function indexAction()
    {
        return $this->renderPage('index');
    }
}