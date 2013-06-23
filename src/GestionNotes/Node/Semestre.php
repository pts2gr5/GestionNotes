<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
class GestionNotes_Node_Semestre extends GestionNotes_Model_Node implements GestionNotes_Node_NodeInterface
{
    public function getName()
    {
        return 'Semestre';
    }
    
    public function getType()
    {
        return 'semestre';
    }
    
    public function getFields()
    {
        return array();
    }
}