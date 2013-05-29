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
class Visitor implements \ArrayAccess
{
    protected $user;
    
    public function __construct()
    {
        if ( ! session_id() )
            session_start();
        
        if ( isset($_SESSION['user_id']) && intval($_SESSION['user_id']) > 0 )
        {
            $user = User::fetchOneById(intval($_SESSION['user_id']));
            if ( $user ) $this->login( $user );
            else $this->logout();
        }
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
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function offsetGet($offset)
    {
        return $this->user->offsetGet($offset);
    }
    
    public function offsetExists($offset)
    {
        return $this->user->offsetExists($offset);
    }
    
    public function offsetSet($offset, $value)
    {
        return $this->user->offsetSet($offset, $value);
    }
    
    public function offsetUnset($offset)
    {
        return $this->user->offsetUnset($offset);
    }
}