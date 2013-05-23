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
    public function render($template, array & $params = array())
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
    
    /**
     * Effectue le rendu d'une page
     *
     * @param string $template
     * @param array $params
     * @return string
     */
    public function renderPage($template, array & $params = array())
    {
        $config = $this->app->getConfig();
        
        $params['title']    = $config['school']['name'];
        $params['content']  = $this->render($template, $params);
        
        return $this->render('layout', $params);
    } 
    
    /**
     * Affiche un simple message d'information
     *
     * @param string $message
     * @param string $redirect
     * @return string
     */
    public function showMessage($message, $redirect = null)
    {
        $config = $this->app->getConfig();
        
        $params['title']    = $config['school']['name'];
        $params['content']  = $message;
        
        if ( $redirect != null )
            $params['content'] .= '<meta http-equiv="Refresh" content="3;url='.$redirect.'" />';
        
        return $this->render('layout', $params);
    }
    
    /**
     * Génère une URL
     *
     * @param string $page
     * @param array  $params
     * @return string
     */
    public function url($page, array $params = array())
    {
        return $_SERVER['SCRIPT_NAME'] . '?' . http_build_query(array_merge(array('r' => $page, $params)));
    } 
}