<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes\Model;

use GestionNotes\Model as AbstractModel;

/**
 * Représente un étudiant
 */
class User extends AbstractModel
{
    const TYPE_ADMIN        = 1;
    const TYPE_DIRETUDE     = 2;
    const TYPE_ETUDIANT     = 3;
    
    /**
     * @var int Identifiant Utilisateur
     */
    protected $id;
    
    /**
     * @var string Nom d'utilisateur
     */
    protected $name;
    
    /**
     * @var string Adresse e-mail
     */
    protected $email;
    
    /**
     * @var string Mot de passe
     */
    protected $password;
    
    /**
     * @var string "Sel" pour le mot de passe
     */
    protected $salt; 
    
    /**
     * @var int Type d'utilisateur
     */
    protected $type;
    
    /**
     * @var string Nom de famille
     */
    protected $firstName; 
    
    /**
     * @var string Prénom
     */
    protected $lastName;
    
    /**
     * @var string Code Apogée
     */
    protected $apogee;
    
    /**
     * @var int Identifiant Formation (étudiants + directeur des études)
     */
    protected $formation;
    
    /**
     * @var string Etudiants suivis (directeur des études)
     */
    protected $followedStudents;
    
    // ------------------------- OPERATIONS DE LECTURE ------------------------- //
    
    /**
     * Récupère un utilisateur à parti de ses identifiants
     *
     * @param string $username
     * @param string $password
     * @return object
     */
    public static function fetchOneByCredentials($username, $password)
    {
        $sth = self::$db->prepare('
            SELECT u.user_id AS id, u.username AS name, u.email, /* u.password,
                u.password_salt AS salt, */ u.first_name AS firstName,
                u.last_name AS lastName, u.apogee_code AS apogee,
                u.formation_id AS formation, u.followed_students AS followedStudents
            FROM users AS u
            WHERE (
                    u.username = LOWER(:username)
                    OR u.email = LOWER(:username)
                ) AND 
                u.password = MD5(CONCAT( MD5(:password), u.password_salt ))
            LIMIT 0,1
        ');
        
        $sth->bindParam(':username', $username, \PDO::PARAM_STR, 45);
        $sth->bindParam(':password', $password, \PDO::PARAM_STR);
        $sth->execute();
        
        if ( $data = $sth->fetch(\PDO::FETCH_ASSOC) )
            return self::exchange($data);
        else
            return false;
    }
    
    /**
     * Récupère un utilisateur à partir de son ID
     *
     * @param string $username
     * @return object
     */
    public static function fetchOneByName($username)
    {
        $sth = self::$db->prepare('
            SELECT u.user_id AS id, u.username AS name, u.email, u.first_name AS firstName,
                u.last_name AS lastName, u.apogee_code AS apogee,
                u.formation_id AS formation, u.followed_students AS followedStudents
            FROM users AS u
            WHERE (
                    u.username = LOWER(:username)
                    OR u.email = LOWER(:username)
                )
            LIMIT 0,1
        ');
        
        $sth->bindParam(':username', $username, \PDO::PARAM_STR, 45);
        $sth->execute();
        
        if ( $data = $sth->fetch(\PDO::FETCH_ASSOC) )
            return self::exchange($data);
        else
            return false;
    }
    
    // ------------------------- OPERATIONS DE MODIFICATION ------------------------- //
    
    // ------------------------- OPERATIONS DE SUPPRESSION ------------------------- //
}