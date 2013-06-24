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
            WHERE tp.formation_id = :formation_id
        ');
        
        $sth->bindParam(':formation_id', intval($id), PDO::PARAM_INT);
        $sth->execute();
        
        return $data = $sth->fetch(PDO::FETCH_ASSOC);
    }
}