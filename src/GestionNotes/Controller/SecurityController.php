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
        $params = array('errors' => array());
        if ( strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' )
        {
            $errors = array();
            
            if ( ! isset($_POST['username']) || ! $_POST['username'] )
                $errors[] = 'Le nom d\'utilisateur est manquant';
            else
                $params['username'] = $_POST['username'];
            
            if ( ! isset($_POST['password']) || ! $_POST['password'] )
                $errors[] = 'Le mot de passe est manquant';
            
            $params['errors'] = &$errors;
        }
        
        return $this->renderPage('security/login', $params);
    }
    
    /**
     * Déconnexion de l'utilisateur
     */
    public function logoutAction()
    {
    
    } 
}