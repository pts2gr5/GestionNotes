<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes;

use GestionNotes\Controller\SecurityController;

/**
 * Classe abstraite pour les contrôlleurs
 */ 
abstract class Controller
{
    protected $app;
    protected $config;
    protected $visitor;
    
    /**
     * Constructeur
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->config = $app->getConfig();
        $this->visitor = $app->getVisitor();
        
        // Seul le contrôlleur pour l'authentification peut être accessible
        // aux visiteurs
        if ( ! ($this->visitor->isLogged() || $_SERVER['REQUEST_URI'] == $this->url('security/login')) )
            $this->redirect($this->url('security/login'));
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
        $config = $this->config;
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
     * Redirige vers une autre page
     *
     * @param string $url
     * @return void
     */
    public function redirect($url)
    {
        ob_get_clean();
        header('Location: '.$url);
        exit();
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