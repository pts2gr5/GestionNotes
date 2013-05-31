<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
/**
 * Interface administrateur
 */ 
class GestionNotes_Controller_AdminController extends GestionNotes_Controller
{
    /**
     * Gestion des formations
     */
    public function formationsAction()
    {
        $this->params['list_title'] = 'Gestion des formations'; 
        $this->params['show_parent_column'] = false;
        return $this->createListByNodeType(GestionNotes_Model_Node::TYPE_FORMATION);
    }
    
    /**
     * Navigation dans les nodes
     */
    public function list_nodesAction()
    {
        $parentNodeId = filter_var( $_REQUEST['id'], FILTER_SANITIZE_STRING );
        $this->params['show_parent_column'] = false;
        if ( $nodes = GestionNotes_Model_Node::fetchByParentNodeId($parentNodeId) )
        {
            $this->params['nodes'] = & $nodes;
            $this->params['list_title'] = $nodes['parent']['title'];
            unset($nodes['parent']);
        }
        else
        {
            $parentNode = GestionNotes_Model_Node::fetchOneByNodeId($parentNodeId);
            $this->params['nodes'] = array();
            $this->params['list_title'] = $parentNode ? $parentNode['title'] : 'Element inconnu';
        }
        return $this->renderPage('admin/list-nodes');
    } 
    
    protected function createListByNodeType(/* int */ $nodeType)
    {
        $nodes = GestionNotes_Model_Node::fetchByNodeType($nodeType);
        $this->params['nodes'] = & $nodes;
        return $this->renderPage('admin/list-nodes');
    }
}