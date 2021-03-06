<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */

/**
 * Représente une formation
 */ 
class GestionNotes_Model_Formation extends GestionNotes_Model
{
    const TYPE_TRAVAUX_DIRIGES   = 1;
    const TYPE_TRAVAUX_PRATIQUES = 2;
    const TYPE_TD                = 1;
    const TYPE_TP                = 2;
    const TYPE_PARCOURS          = 3;
    
    protected $id;
    protected $title;
    protected $parent;
    protected $node;
    protected $type;
    
    public static function exchange(array $values)
    {
        $obj = new self();
        foreach ( $values as $name => $value )
            $obj->offsetSet($name, $value);
        return $obj;
    }
    
    public static function fetchOneByFormationId($id)
    {
        $sth = self::$db->prepare('
            SELECT formation_id AS id, formation_title AS title, formation_type AS type,
                parent_formation_id AS parent, parent_node_id AS node
            FROM formations AS f
            WHERE f.formation_id = :formation_id
        ');
        
        $sth->bindParam(':formation_id', intval($id), PDO::PARAM_INT);
        $sth->execute();
        
        if ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            return self::exchange($data);
        else
            return false;
    }
    
    public static function fetchTreeByFormationId($id)
    {
        $sth = self::$db->prepare('
            SELECT
                tp.node_id AS tp_id, tp.node_title AS tp_title,
                td.node_id AS td_id, td.node_title AS td_title,
                s.node_id AS semestre_id, s.node_title AS semestre_title,
                f.node_id AS formation_id, f.node_title AS formation_title,
                d.node_id AS departement_id, d.node_title AS departement_title
            FROM nodes AS tp
            RIGHT JOIN nodes AS td ON tp.parent_node_id = td.node_id
            RIGHT JOIN nodes AS s ON td.parent_node_id = s.node_id
            RIGHT JOIN nodes AS f ON s.parent_node_id = f.node_id
            RIGHT JOIN nodes AS d ON f.parent_node_id = d.node_id
            WHERE tp.node_id = :formation_id
        ');
        
        $sth->bindParam(':formation_id', intval($id), PDO::PARAM_INT);
        $sth->execute();
        
        return $data = $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function fetchTreeByUserId($id)
    {
        $sth = self::$db->prepare('
            SELECT
                tp.formation_id AS tp_id, tp.formation_id AS tp_title,
                td.formation_id AS td_id, td.formation_title AS td_title,
                s.node_id AS semestre_id, s.node_title AS semestre_title,
                f.node_id AS formation_id, f.node_title AS formation_title,
                d.node_id AS departement_id, d.node_title AS departement_title
            FROM formations AS tp
            RIGHT JOIN formations AS td ON tp.parent_formation_id = td.formation_id
            RIGHT JOIN nodes AS s ON td.parent_node_id = s.node_id
            RIGHT JOIN nodes AS f ON s.parent_node_id = f.node_id
            RIGHT JOIN nodes AS d ON f.parent_node_id = d.node_id
            WHERE tp.formation_id = (
                SELECT u.formation_id
                FROM users AS u
                WHERE u.user_id = :user_id
            )
            ORDER BY d.node_id, f.node_id, s.node_id, td.formation_id, tp.formation_id
        ');
        
        $sth->bindParam(':user_id', intval($id), PDO::PARAM_INT);
        $sth->execute();
        
        return $data = $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function fetchAllByFormationid($id)
    {
        $sth = self::$db->prepare('
            SELECT n.node_id AS id, n.node_type AS type, n.node_title AS title, n.parent_node_id AS parent, t.note_id
            FROM nodes AS n
            LEFT JOIN notes AS t ON n.node_id = t.node_id
            WHERE FIND_IN_SET(n.parent_node_id, (
                SELECT CONCAT_WS(\',\',
                    GROUP_CONCAT(DISTINCT d.node_id), GROUP_CONCAT(DISTINCT f.node_id), GROUP_CONCAT(DISTINCT s.node_id),
                    GROUP_CONCAT(DISTINCT m.node_id), GROUP_CONCAT(DISTINCT e.node_id), GROUP_CONCAT(DISTINCT u.node_id),
                    GROUP_CONCAT(DISTINCT m2.node_id), GROUP_CONCAT(DISTINCT td.parent_node_id), GROUP_CONCAT(tp.parent_node_id)
                ) AS nodes
                FROM formations AS tp
                LEFT JOIN formations AS td ON tp.parent_formation_id = td.formation_id
                LEFT JOIN nodes AS s ON td.parent_node_id = s.node_id   -- TYPE_SEMESTRE
                LEFT JOIN nodes AS f ON s.parent_node_id = f.node_id    -- TYPE_FORMATION
                LEFT JOIN nodes AS d ON f.parent_node_id = d.node_id    -- TYPE_DEPARTEMENT
                LEFT JOIN nodes AS m ON m.parent_node_id = s.node_id    -- TYPE_MODULE
                LEFT JOIN nodes AS m2 ON m2.parent_node_id = m .node_id -- TYPE_MATIERE
                LEFT JOIN nodes AS e ON e.parent_node_id = m.node_id    -- TYPE_EPREUVE
                LEFT JOIN nodes AS u ON u.parent_node_id = s.node_id    -- TYPE_UE
                WHERE tp.formation_id = :formation_id
                ORDER BY d.node_id, f.node_id, s.node_id, td.formation_id, tp.formation_id
            ))
        ');
        
        $sth->bindParam(':formation_id', intval($id), PDO::PARAM_INT);
        $sth->execute();
        
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ( $data as $node )
            if ( $node['type'] == GestionNotes_Model_Node::TYPE_FORMATION ) { $parent = $node['parent']; break; }
        return self::toTree($data, $parent);
    }
    
    protected static function toTree(array &$elements, $parentId = 0)
    {
        $branch = array();
       	foreach ($elements as $element) {
        	if ($element['parent'] == $parentId) {
            	$children = self::toTree($elements, $element['id']);
               	$element['children'] = is_array($children) ? $children : array();
               	$branch[$element['id']] = $element;
               	unset($elements[$element['id']]);
           	}
       	}
        return $branch;
    }
    
    public static function fetchAllTD()
    {
        $sth = self::$db->prepare('
            SELECT
                td.formation_id AS id, td.formation_title AS title,
                s.node_id AS semestre_id, s.node_title AS semestre_title,
                f.node_id AS formation_id, f.node_title AS formation_title,
                d.node_id AS departement_id, d.node_title AS departement_title
            FROM formations AS td
            RIGHT JOIN nodes AS s ON td.parent_node_id = s.node_id
            RIGHT JOIN nodes AS f ON s.parent_node_id = f.node_id
            RIGHT JOIN nodes AS d ON f.parent_node_id = d.node_id
            WHERE td.formation_type = '.self::TYPE_TD.'
            GROUP BY td.formation_id
            ORDER BY d.node_id, f.node_id, s.node_id, td.formation_id, td.formation_id
        ');
        
        $sth->execute();
        
        $result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            $result[] = $data;
        return $result;
    }
    
    public static function fetchAllTP()
    {
        $sth = self::$db->prepare('
            SELECT
                tp.formation_id AS id, tp.formation_title AS title, tp.formation_type AS type,
                td.formation_id AS td_id, td.formation_title AS td_title,
                s.node_id AS semestre_id, s.node_title AS semestre_title,
                f.node_id AS formation_id, f.node_title AS formation_title,
                d.node_id AS departement_id, d.node_title AS departement_title
            FROM formations AS tp
            RIGHT JOIN formations AS td ON tp.parent_formation_id = td.formation_id
            RIGHT JOIN nodes AS s ON td.parent_node_id = s.node_id
            RIGHT JOIN nodes AS f ON s.parent_node_id = f.node_id
            RIGHT JOIN nodes AS d ON f.parent_node_id = d.node_id
            WHERE tp.formation_type = '.self::TYPE_TP.'
            GROUP BY tp.formation_id
            ORDER BY d.node_id, f.node_id, s.node_id, td.formation_id, tp.formation_id
        ');
        
        $sth->execute();
        
        $result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            $result[] = $data;
        return $result;
    }
    
    public static function addFormation($title, $type, $parent)
    {
        $sth = self::$db->prepare('
            INSERT INTO formations (formation_title, formation_type, parent_formation_id, parent_node_id)
            VALUES (:title, :type, :parent, :node)
        ');
        
        $null = null;
        $sth->bindParam(':title',   $title, PDO::PARAM_STR);
        $sth->bindParam(':type',    $type, PDO::PARAM_INT);
        
        
        //nb est l'id du semestre parent au TD
        //id du TD est la variable $parent
        if ( $type == self::TYPE_TP ) {
        	$nb = GestionNotes_Model_Formation::idTdToIdSemestre($parent);
            $sth->bindParam(':parent', $parent, PDO::PARAM_INT);
            $sth->bindParam(':node', $nb);
        } else {
        	$null = null;
            $sth->bindParam(':node', $parent, PDO::PARAM_INT );
            $sth->bindParam(':parent', $null);
        }
        
        return $sth->execute();
    }
    
    
    public static function idTdToIdSemestre($idTd)
    {
    	$sth = self::$db->prepare('
            SELECT `parent_node_id` FROM `formations` 
    			WHERE `formation_id` = :idTd
        ');
    
    	
    	$sth->bindParam(':idTd',$idTd, PDO::PARAM_INT);
    	
    
    	$sth->execute();
    	
    	
    	$data = $sth->fetch(PDO::FETCH_ASSOC);
    	return $data['parent_node_id'];
    }
    
    public static function idTpToIdTd($idTp)
    {
    	$sth = self::$db->prepare('
    			SELECT `formation_title` FROM `formations`
    			WHERE `formation_id`
    			in (
    			Select `parent_formation_id`
    			from formations
    			where `formation_id`= :idTp
    			)
        ');
    
    	 
    	$sth->bindParam(':idTp',$idTp, PDO::PARAM_INT);
    	 
    
    	$sth->execute();
    	 
    	 
    	$data = $sth->fetch(PDO::FETCH_ASSOC);
    	return $data['formation_title'];
    }
    
    public static function tpIdToTitle($idTp)
    {
    	$sth = self::$db->prepare('
    			SELECT `formation_title` FROM `formations`
    			where `formation_id`= :idTp
    			
        ');
    
    
    	$sth->bindParam(':idTp',$idTp, PDO::PARAM_INT);
    
    
    	$sth->execute();
    
    
    	$data = $sth->fetch(PDO::FETCH_ASSOC);
    	return $data['formation_title'];
    }
    
    public static function delFormation($id)
    {
        $sth = self::$db->prepare('
            DELETE FROM formations WHERE formation_id = :id
        ');
        
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        return $sth->execute();
    }
    
    public static function updateFormation($id, $title)
    {
        $sth = self::$db->prepare('
            UPDATE formations SET formation_title = :title WHERE formation_id = :id
        ');
        
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->bindParam(':title', $title, PDO::PARAM_STR);
        return $sth->execute();
    }
    
    
    public static function fetchtpBySemestreId($idSemestre)
    {
    	$sth = self::$db->prepare('
            SELECT formation_id AS id, formation_title AS title
            FROM `formations` as f
            WHERE f.formation_type = '.self::TYPE_TP.' AND f.parent_node_id = :idSemestre
            GROUP BY formation_id
            ORDER BY parent_node_id, parent_formation_id
        ');
    
    	$sth->bindParam(':idSemestre', $idSemestre, PDO::PARAM_INT);
    	$sth->execute();
       
        $result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
                $result[] = self::exchange($data);
        return $result;
    	
    }
}