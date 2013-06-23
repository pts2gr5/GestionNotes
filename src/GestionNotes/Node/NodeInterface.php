<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
interface GestionNotes_Node_NodeInterface
{
    /**
     * Retourne l'intitulé de la node
     *
     * @return string
     */
    public function getName();
    
    /**
     * Retourne l'identifiant unique de la node
     *
     * @return string
     */
    public function getType(); 
    
    /**
     * Retourne les champs à afficher
     *
     * @return array
     */
    public function getFields();
}