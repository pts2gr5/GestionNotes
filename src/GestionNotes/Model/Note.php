<?php

class GestionNotes_Model_Note extends GestionNotes_Model
{
    public static function exchange(array $values) {}
        
    public static function fetchNotesBySemestreId($id)
    {
        $sth = self::$db->prepare('
            SELECT *
            FROM notes AS n
            WHERE n.node_id IN(
                SELECT GROUP_CONCAT(DISTINCT e.node_id) AS nodes_id
                FROM nodes AS s
                RIGHT JOIN nodes AS u ON u.parent_node_id = s.node_id
                RIGHT JOIN nodes AS m ON m.parent_node_id = u.node_id
                RIGHT JOIN nodes AS e ON e.parent_node_id = m.node_id
                WHERE e.node_type = 6 AND s.node_id = :node_id 
            )    
        ');
        
        $sth->bindParam(':node_id', $id, PDO::PARAM_INT);
        $sth->execute();
        
        return $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function fetchNotesByUserId($id, $formation)
    {
        $sth = self::$db->prepare('
            SELECT t.*,  s.student_note, s.user_id
            FROM notes AS t
            WHERE t.node_id IN(
                SELECT GROUP_CONCAT(DISTINCT e.node_id) AS nodes_id
                FROM formations AS f
                RIGHT JOIN nodes AS s ON f.parent_node_id = s.node_id
                RIGHT JOIN nodes AS u ON u.parent_node_id = s.node_id
                RIGHT JOIN nodes AS m ON m.parent_node_id = u.node_id
                RIGHT JOIN nodes AS e ON e.parent_node_id = m.node_id
                WHERE e.node_type = 6 AND f.formation_id = :formation_id 
            ) AND s.user_id = :user_id
        ');
        
        $sth->bindParam(':user_id', $id, PDO::PARAM_INT);
        $sth->bindParam(':formation_id', $formation, PDO::PARAM_INT);
        $sth->execute();
        
        return $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function fetchAllByUserId($id)
    {
        $sth = self::$db->prepare('
            SELECT s.*, n.node_id, n.coefficient
            FROM student_notes AS s
            LEFT JOIN notes AS n ON s.note_id = n.note_id
            WHERE s.user_id = :user_id
        ');
        
        $sth->bindParam(':user_id', $id, PDO::PARAM_INT);
        $sth->execute();
        
        $result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            $result[ $data['node_id'] ] = $data;
        return $result;
    }
}