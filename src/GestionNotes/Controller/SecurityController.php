<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes\Controller;

use GestionNotes\Controller;
 
class SecurityController extends Controller
{
    /**
     * Authentification de l'utilisateur
     */
    public function loginAction()
    {
        $params = array('errors'=>array('foo'));
        return $this->renderPage('security/login', $params);
    }
    
    /**
     * Déconnexion de l'utilisateur
     */
    public function logoutAction()
    {
    
    } 
}