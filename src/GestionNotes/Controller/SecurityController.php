<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */

class GestionNotes_Controller_SecurityController extends GestionNotes_Controller
{
    /**
     * Authentification de l'utilisateur
     */
    public function loginAction()
    {
        $params = array();
        
        if ( $this->app->getVisitor()->isLogged() )
            $this->redirect($this->url('security/logout'));
        
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
                
                if ( ! $user = GestionNotes_Model_User::fetchOneByCredentials($username, $password) )
                    $errors[] = 'Erreur d\'authentification';
                else {
                    $this->app->getVisitor()->login($user);
                    header('Location: '.$_SERVER['SCRIPT_NAME']);
                    exit;
                }
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
        $this->app->getVisitor()->logout();
        $this->redirect($this->url('security/login'));
    }
    
    /**
     * Affiche les préférences de l'utilisateur
     */
    public function profileAction()
    {
        $params = array();
        
        if ( ! $this->visitor->isLogged() )
            $this->redirect($this->url('security/login'));
        
        if ( strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' )
        {
            if ( isset($_POST['editpassword']) && $_POST['editpassword'] )
            {
                $errors = array();
            
                // Vérification des données saisies
            
                if ( ! isset($_POST['password']) || ! $_POST['password'] )
                    $errors[] = 'Le mot de passe est manquant';
                elseif ( strlen($_POST['password']) < 6 )
                    $errors[] = 'Le mot de passe est trop court';
                elseif ( $_POST['password'] == $this->visitor['name'] )
                    $errors[] = 'Le mot de passe ne peut pas être égal au nom d\'utilisateur';
                elseif ( strpos($_POST['password'], $this->visitor['name']) !== false )
                    $errors[] = 'Le mot de passe ne peut pas comprendre le nom d\'utilisateur';
            
                if ( ! isset($_POST['password_confirm']) || ! $_POST['password_confirm'] )
                    $errors[] = 'La confirmation du mot de passe est manquante';
                
                if ( (isset($_POST['password']) ? $_POST['password'] : '')
                        != (isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '') )
                    $errors[] = 'Les deux champs ne sont pas identiques';
            
                // Tente de s'identifier s'il n'y a pas d'erreur
            
                if ( ! $errors )
                {
                    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);    
                    $this->visitor->getUser()->changePassword($password);
                    $this->visitor->logout();
                    $this->redirect($this->url('security/login'));
                }
            
                $params['errors'] = &$errors;
            }
        }
        
        return $this->renderPage('security/profile', $params);
    } 
    
    protected function init() {}
}
