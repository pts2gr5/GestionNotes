<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes;

/**
 * Classe abstraite pour les contrôlleurs
 */ 
abstract class Controller
{
    /**
     * Constructeur
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    } 
    
    /** 
     * Effectue le rendu d'un template
     *
     * @param string $template
     * @param array $params
     * @return string
     */
    public function render($template, array $params = array())
    {
        // Détermine le chemin des templates
        $config = $this->app->getConfig();
        $view_path = $config['path']['views'];
        
        // Rend les variables disponibles au template
        extract($params);
    
        // Place le contenu du template dans une variable
        ob_start();
        include($view_path.'/'.$template.'.php');
        $content = ob_get_clean();
        
        return $content;
    }     
}