<?php

class GestionNotes_Model_Etudiant extends GestionNotes_Model_User
{
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
                u.formation_id AS formation
            FROM `users` AS u
            WHERE type = '.self::TYPE_ETUDIANT.' AND formation_id IN(
                SELECT tp.node_id
                FROM nodes AS tp
                '.$join.'
                WHERE u.type = '.self::TYPE_ETUDIANT.' AND '.$conditions.'
            )
        ');
        
    	$sth->execute();
    
    	$result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
                $result[] = self::exchange($data);
        return $result;
    }
}