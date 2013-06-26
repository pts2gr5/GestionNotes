<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */

/**
 * Représente une node
 */
class GestionNotes_Model_Node extends GestionNotes_Model
{
    const TYPE_DEPARTEMENT  = 1;
    const TYPE_FORMATION    = 2;
    const TYPE_SEMESTRE     = 3;
    const TYPE_UE           = 4;
    const TYPE_MODULE       = 5;
    const TYPE_MATIERE      = 6;
    const TYPE_EPREUVE      = 7;
    
    /**
     * @var int Identifiant Node
     */
    protected $id;
    
    /**
     * @var string Titre de la node
     */
    protected $title;
    
    /**
     * @var int Type de la node
     */
    protected $type;
    
    /**
     * @var object|int Node parente
     */
    protected $parent;
    
    /**
     * @var float Coefficient
     */
    protected $coefficient; 
    
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
     * Récupère le titre du parent de l'id en paramètre
     *
     * @param integer $nodeId
     * @return object
     */
    public static function titreParent($nodeId)
    {
    	$sth = self::$db->prepare('
           SELECT `node_title` FROM `nodes` 
    			WHERE `node_id` = :nodeId 
    			LIMIT 0 , 1
        ');
    
    	$sth->bindParam(':nodeId', $nodeId, PDO::PARAM_INT);
    	$sth->execute();
    
    	
    	 $data = $sth->fetch(PDO::FETCH_ASSOC);
    	
    	
    	return $data['node_title'];
    }
    
    public static function idParent($nodeId)
    {
    	$sth = self::$db->prepare('
           SELECT `node_id` FROM `nodes`
    			WHERE `node_id` = :nodeId
    			LIMIT 0 , 1
        ');
    
    	$sth->bindParam(':nodeId', $nodeId, PDO::PARAM_INT);
    	$sth->execute();
    
    	 
    	$data = $sth->fetch(PDO::FETCH_ASSOC);
    	 
    	 
    	return $data['node_id'];
    }
    
    public static function typeById($nodeId)
    {
    	$sth = self::$db->prepare('
           SELECT `node_type` FROM `nodes`
    			WHERE `node_id` = :nodeId
    			LIMIT 0 , 1
        ');
    
    	$sth->bindParam(':nodeId', $nodeId, PDO::PARAM_INT);
    	$sth->execute();
    
    
    	$data = $sth->fetch(PDO::FETCH_ASSOC);
    
    
    	return $data['node_type'];
    }
    
    
    /**
     * Récupère des notes d'un certain type
     *
     * @param integer $nodeId
     * @return object
     */
    public static function fetchByNodeType($nodeId)
    {
        $sth = self::$db->prepare('
            SELECT n.node_id AS id, n.node_title AS title, n.node_type AS type,
                   n.parent_node_id AS parent, p.node_title AS parent_title,
                   p.node_id AS parent_id, IF( n.node_type = '.self::TYPE_EPREUVE.', n.coefficient, NULL) AS coefficient
            FROM nodes AS n
            LEFT JOIN nodes AS p ON n.parent_node_id = p.node_id
            WHERE n.node_type = :node_type
        ');
        
        $sth->bindParam(':node_type', $nodeId, PDO::PARAM_INT, 45);
        $sth->execute();
        
        $nodes = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) ) {
            $data['parent'] = ! $data['parent_id'] ? null :
                self::exchange(array('title'=>$data['parent_title'],'id'=>$data['parent_id']));
            $nodes[] = self::exchange($data);
        }
        return $nodes;
    }
    
    /**
     * Récupère des nodes à partir de l'ID parent
     *
     * @param integer $parentNodeId
     * @return object
     */
    public static function fetchByParentNodeId($parentNodeId)
    {
        $sth = self::$db->prepare('
            SELECT n.node_id AS id, n.node_title AS title, n.node_type AS type,
                   n.parent_node_id AS parent, p.node_title AS parent_title, p.node_type AS parent_type,
                   p.node_id AS parent_id, IF( n.node_type = '.self::TYPE_EPREUVE.', n.coefficient, NULL) AS coefficient
            FROM nodes AS n
            LEFT JOIN nodes AS p ON n.parent_node_id = p.node_id
            WHERE n.parent_node_id = :parent_node_id
        	ORDER BY title ASC
        ');
        
        $sth->bindParam(':parent_node_id', $parentNodeId, PDO::PARAM_INT );
        $sth->execute();
        
        $nodes = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) ) {
            $nodes['parent'] = ! $data['parent_id'] ? null :
                self::exchange(array('title'=>$data['parent_title'],'id'=>$data['parent_id'],'type'=>$data['parent_type']));
            $nodes[] = self::exchange($data);
        }
        return $nodes;
    } 
    
    /**
     * Récupère un node
     *
     * @param integer $nodeId
     * @return object
     */
    public static function fetchOneByNodeId($nodeId)
    {
        $sth = self::$db->prepare('
            SELECT n.node_id AS id, n.node_title AS title, n.node_type AS type,
                   n.parent_node_id AS parent, IF( n.node_type = '.self::TYPE_EPREUVE.', n.coefficient, NULL) AS coefficient
            FROM nodes AS n
            WHERE n.node_id = :node_id
        ');
        
        $sth->bindParam(':node_id', $nodeId, PDO::PARAM_INT );
        $sth->execute();
        
        if ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
            return self::exchange($data);
        else
            return false;
    } 
    
    /**
     * Récupère toutes les épreuves d'une matière
     *
     * @param integer $nodeId
     * @return object
     */
	public static function listeEpreuvesByMatiereID($node_id)
    {
        $sth = self::$db->prepare('
           SELECT n.note_id AS id, n.title AS title, n.coefficient as coefficient
           FROM notes AS n
           WHERE n.node_id = :node_id
       ');
       
        $sth->bindParam(':node_id', $node_id, PDO::PARAM_INT );
        $sth->execute();
       
        $result = array();
        
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) ){
        	 $result[] = $data;
        }
        
        return $result;
    }
    
    public static function listeEpreuvesByEtudiantID($etudiantId)
    {
        $sth = self::$db->prepare('
            
        ');
        
        $sth->bindParam(':etudiant_id', $etudiantId, PDO::PARAM_INT);
        $sth->execute();
        
        $result = array();
        while ( $data = $sth->fetch(PDO::FETCH_ASSOC) )
                $result[] = self::exchange($data);
        return $result;
    }
    
    // ------------------------- OPERATIONS DE MODIFICATION ------------------------- //
    
    /**
     * Ajoute une node à partir d'un objet
     *
     * @param GestionNotes_Model_Node $node
     * @return boolean
     */
    public static function createNode(GestionNotes_Model_Node $node)
    {
        return self::createNode2(
            $node['title'], $node['type'], $node['parent'], $node['coefficient']
        );
    } 
    
    /**
     * Ajoute une node
     *
     * @param string $title
     * @param int   $type
     * @param int   $parentId
     * @param float $coefficient
     * @return boolean
     */
    public static function createNode2($title, $type, $parentId = null, $coefficient = null)
    {
        $sth = self::$db->prepare('
            INSERT INTO nodes ( node_title, node_type '.($parentId?',parent_node_id':'').($coefficient?',coefficient':'').')
            VALUES ( :title, :type '.($parentId?",:parent_node_id":'').($coefficient?",:coefficient":'').' );
        ');
        
        $sth->bindParam(':title', $title, PDO::PARAM_STR, 35);
        $sth->bindParam(':type', $type, PDO::PARAM_INT);
        if ( $parentId ) $sth->bindParam(':parent_node_id', $parentId, PDO::PARAM_INT);
        if ( $coefficient )$sth->bindParam(':coefficient', $coefficient, PDO::PARAM_STR);   // Il n'existe pas de PDO::PARAM_FLOAT
        
        return $sth->execute();
    }
    
    public static function ajouterNote($userId,$epreuveId, $note){
        // Récupère la node
        $sth = self::$db->prepare('SELECT n.note_id FROM notes AS n WHERE n.node_id = :node_id LIMIT 1');
        $sth->bindParam(':node_id', $epreuveId, PDO::PARAM_INT);
        $sth->execute();
        $parent = $sth->fetch(PDO::FETCH_ASSOC);
        
        // Effectue l'insertion
    	$sth = self::$db->prepare('
            INSERT IGNORE INTO `student_notes`(`user_id`, `note_id`, `student_note`) VALUES (:user_id,:note_id,:note)
        ');
    	
    	$sth->bindParam(':user_id', $userId, PDO::PARAM_INT );
    	$sth->bindParam(':note_id', $parent['note_id'], PDO::PARAM_INT );
    	$sth->bindParam(':note', $note, PDO::PARAM_INT );
        
    	return $sth->execute();
    }
    
    public static function modifierNode($nodeId, $title, $type,$parent_node_id, $coefficient ){
    	$sth = self::$db->prepare('
    			UPDATE `nodes`
    			SET 
    			`node_title` = :title,
    			`node_type` = :type,
				 `parent_node_id` = :parent_node_id,
 				`coefficient` = :coefficient
    			WHERE `node_id` = :nodeId ;
        ');
    	 
    	$sth->bindParam(':title', $title, PDO::PARAM_STR );
    	$sth->bindParam(':nodeId', $nodeId, PDO::PARAM_INT );
    	$sth->bindParam(':type', $type, PDO::PARAM_INT );
    	$sth->bindParam(':parent_node_id', $parent_node_id, PDO::PARAM_INT );
    	$sth->bindParam(':coefficient', $coefficient, PDO::PARAM_INT );
    	
    	return $sth->execute();
    }
    
    
    
    // ------------------------- OPERATIONS DE SUPPRESSION ------------------------- //
    public static function supprimerNode($nodeId){
    	$sth = self::$db->prepare('
    			DELETE FROM `nodes` WHERE `node_id` = :nodeID
        ');
    
    	$sth->bindParam(':nodeID', $nodeId, PDO::PARAM_INT );
    	return $sth->execute();
    }
    
}