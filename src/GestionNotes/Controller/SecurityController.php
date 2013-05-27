<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes\Controller;

use GestionNotes\Controller;
use GestionNotes\Model\User;
 
class SecurityController extends Controller
{
    /**
     * Authentification de l'utilisateur
     */
    public function loginAction()
    {
        $params = array();
        
        if ( strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' )
        {
            $errors = array();
            
            // Vérification des données saisies
            
            if ( ! isset($_POST['username']) || ! $_POST['username'] )
                $errors[] = 'Le nom d\'utilisateur est manquant';
            else
                $params['username'] = $_POST['username'];
            
            if ( ! isset($_POST['password']) || ! $_POST['password'] )
                $errors[] = 'Le mot de passe est manquant';
            
            // Tente de s'identifier s'il n'y a pas d'erreur
            if ( ! $errors )
            {
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                
                if ( ! $user = User::fetchOneByCredentials($username, $password) )
                    $errors[] = 'Erreur d\'authentification';
            }
            
            
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