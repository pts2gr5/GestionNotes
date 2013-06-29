<?php

class GestionNotes_Model_Etudiant extends GestionNotes_Model_User
{
    // ------------------------- OPERATIONS DE LECTURE ------------------------- //
    
    public static function fetchAll()
    {
    	$sth = self::$db->prepare('
            SELECT u.user_id AS id, u.username AS name, u.email, u.first_name AS firstName,
                u.last_name AS lastName, u.apogee_code AS apogee, u.type,
                u.formation_id AS formation
            FROM `users` AS u
            WHERE type = '.self::TYPE_ETUDIANT.'
        ');
        
    	$sth->execute();
    
    	$result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
                $result[] = self::exchange($data);
        return $result;
    }
    
    public static function fetchAllByDepartement($id)
    {
    	return self::_fetchAllBy('
            RIGHT JOIN nodes AS td ON tp.parent_node_id = td.node_id
            RIGHT JOIN nodes AS s ON td.parent_node_id = s.node_id
            RIGHT JOIN nodes AS f ON s.parent_node_id = f.node_id
            RIGHT JOIN nodes AS d ON f.parent_node_id = d.node_id','
            d.node_id ='.self::$db->quote($id, PDO::PARAM_INT)
        );
    }
    
    public static function fetchAllByFormation($id)
    {
    	return self::_fetchAllBy('
            RIGHT JOIN nodes AS td ON tp.parent_node_id = td.node_id
            RIGHT JOIN nodes AS s ON td.parent_node_id = s.node_id
            RIGHT JOIN nodes AS f ON s.parent_node_id = f.node_id','
            f.node_id ='.self::$db->quote($id, PDO::PARAM_INT)
        );
    }
    
    public static function fetchAllBySemestre($id)
    {
    	return self::_fetchAllBy('
            RIGHT JOIN nodes AS td ON tp.parent_node_id = td.node_id
            RIGHT JOIN nodes AS s ON td.parent_node_id = s.node_id','
            s.node_id ='.self::$db->quote($id, PDO::PARAM_INT)
        );
    }
    
    public static function fetchAllByTd($id)
    {
    	return self::_fetchAllBy('
            RIGHT JOIN nodes AS td ON tp.parent_node_id = td.node_id','
            td.node_id ='.self::$db->quote($id, PDO::PARAM_INT)
        );
    }
    
    public static function fetchAllByTp($id)
    {
    	return self::_fetchAllBy('','
            tp.node_id ='.self::$db->quote($id, PDO::PARAM_INT)
        );
    }
    
    protected static function _fetchAllBy($join, $conditions = '1')
    {
    	$sth = self::$db->prepare('
            SELECT u.user_id AS id, u.username AS name, u.email, u.first_name AS firstName,
                u.last_name AS lastName, u.apogee_code AS apogee, u.type,
                u.formation_id AS formation_id, n.node_title AS formation_title
            FROM `users` AS u
            RIGHT JOIN nodes AS n ON u.formation_id = n.node_id
            WHERE type = '.self::TYPE_ETUDIANT.' AND formation_id IN(
                SELECT tp.node_id
                FROM nodes AS tp
                '.$join.'
                WHERE u.type = '.self::TYPE_ETUDIANT.' AND '.$conditions.'
            )
        ');
        
    	$sth->execute();
    
    	$result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) ) {
            $data['formation'] = GestionNotes_Model_Node::exchange(array('id'=>$data['formation_id'],'title'=>$data['formation_title']));
            $result[] = self::exchange($data);
        }
        return $result;
    }
    
    // ------------------------- OPERATIONS DE MODIFICATION ------------------------- //
    
    public static function creerEtudiant(array $params)
    {
        $sth = self::$db->prepare('
            INSERT INTO users (username, email, password, password_salt, type, first_name, last_name, apogee_code, formation_id)
            VALUES (:username, :email, :password, :salt, '.self::TYPE_ETUDIANT.', :first_name, :last_name, :apogee, :formation)
        ');
        
        $sth->bindParam(':username',    $params['apogee'], PDO::PARAM_STR);
        $sth->bindParam(':email',       $params['email'], PDO::PARAM_STR);
        $sth->bindParam(':salt',        $salt = uniqid(), PDO::PARAM_STR);
        $sth->bindParam(':password',    md5(md5($params['password']).$salt), PDO::PARAM_STR);
        $sth->bindParam(':first_name',  $params['nom'], PDO::PARAM_STR);
        $sth->bindParam(':last_name',   $params['prenom'], PDO::PARAM_STR);
        $sth->bindParam(':apogee',      $params['apogee'], PDO::PARAM_STR);
        $sth->bindParam(':formation',   $params['formation'], PDO::PARAM_INT);
        
        return $sth->execute();
    }
    
    // ------------------------- OPERATIONS DE SUPPRESSION ------------------------- //
}