<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes;

use GestionNotes\Model\User;

/**
 * Représente un utilisateur connecté
 */
class Visitor
{
    protected $user;
    
    public function __construct()
    {
        if ( ! session_id() )
            session_start();
        
        if ( isset($_SESSION['user_id']) && intval($_SESSION['user_id']) > 0 )
            $this->login( User::fetchOneById(intval($_SESSION['user_id'])) );
    }
    
    public function login(User $user)
    {
        $_SESSION['user_id'] = $user['id'];
        $this->user = $user;
    }
    
    public function logout()
    {
        $_SESSION['user_id'] = null;
        session_destroy();
    }
    
    public function isLogged()
    {
        return ( $this->user instanceof User );
    }
}