<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */

/**
 * Représente un étudiant
 */
class GestionNotes_Model_User extends GestionNotes_Model
{
    protected static $__CLASS__ = 'GestionNotes_Model_User';
    
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
    
    /**
     * @var array $values
     */
    public static function exchange(array $values)
    {
        $obj = new self();
        
        foreach ( $values as $name => $value )
            $obj->offsetSet($name, $value);
        
        return $obj;
    }
    
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
                u.password_salt AS salt, */ u.first_name AS firstName, u.type,
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
        
        $sth->bindParam(':username', $username, PDO::PARAM_STR, 45);
        $sth->bindParam(':password', $password, PDO::PARAM_STR);
        $sth->execute();
        
        if ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            return self::exchange($data);
        else
            return false;
    }
    
    /**
     * Récupère un utilisateur à partir de son nom / email
     *
     * @param string $username
     * @return object
     */
    public static function fetchOneByName($username)
    {
        $sth = self::$db->prepare('
            SELECT u.user_id AS id, u.username AS name, u.email, u.first_name AS firstName,
                u.last_name AS lastName, u.apogee_code AS apogee, u.type,
                u.formation_id AS formation, u.followed_students AS followedStudents
            FROM users AS u
            WHERE (
                    u.username = LOWER(:username)
                    OR u.email = LOWER(:username)
                )
            LIMIT 0,1
        ');
        
        $sth->bindParam(':username', $username, PDO::PARAM_STR, 45);
        $sth->execute();
        
        if ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            return self::exchange($data);
        else
            return false;
    }
    
    /**
     * Récupère un utilisateur à partir de son ID
     *
     * @param int $userId
     * @return object
     */
    public static function fetchOneById($userId)
    {
        $sth = self::$db->prepare('
            SELECT u.user_id AS id, u.username AS name, u.email, u.first_name AS firstName,
                u.last_name AS lastName, u.apogee_code AS apogee, u.type,
                u.formation_id AS formation, u.followed_students AS followedStudents
            FROM users AS u
            WHERE u.user_id = :userid
            LIMIT 0,1
        ');
        
        $sth->bindParam(':userid', $userId, PDO::PARAM_INT);
        $sth->execute();
        
        if ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            return self::exchange($data);
        else
            return false;
    }
    
    /**
     * Récupère tous les users de la base
     *
     */
    public static function recupererAllUser()
    {
    	$sth = self::$db->prepare('
            SELECT u.user_id AS id, u.username AS name, u.email, u.first_name AS firstName,
                u.last_name AS lastName, u.apogee_code AS apogee, u.type,
                u.formation_id AS formation
            FROM `users` AS u
            WHERE `type` = '.self::TYPE_ETUDIANT.'
        ');
        
    	$sth->execute();
    
    	$result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
                $result[] = self::exchange($data);
        return $result;
    }
    
    // ------------------------- OPERATIONS DE MODIFICATION ------------------------- //
    
    /**
     * Modifie un mot de passe à partir de l'ID utilisateur
     *
     * @param string $password
     * @return boolean
     */
    public static function changePassword($password)
    {
        $sth = self::$db->prepare('
            UPDATE users AS u
            SET u.password =  MD5(CONCAT( MD5(:password), u.password_salt ))
            WHERE u.user_id = :userid
        ');
        
        $id = $this['id'];
        
        $sth->bindParam(':password', $password, PDO::PARAM_STR);
        $sth->bindParam(':userid', $id, PDO::PARAM_INT);
        
        return $sth->execute();
    } 
    
    /**
     * Ajoute un user
     *
     * @param string $password
     * @return boolean
     */
    public static function addUser($name,$prenom,$apogee,$semestre,$groupeTD,$groupeTP)
    {
    	//TODO
    }
    
    // ------------------------- OPERATIONS DE SUPPRESSION ------------------------- //
}