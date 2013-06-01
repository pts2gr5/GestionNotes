<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */

/**
 * Classe abstraite pour les contrôlleurs
 */ 
abstract class GestionNotes_Controller
{
    protected $app;
    protected $config;
    protected $params;
    protected $visitor;
    
    /**
     * Constructeur
     *
     * @param Application $app
     */
    public function __construct(GestionNotes_Application $app)
    {
        $this->app = $app;
        $this->config = $app->getConfig();
        $this->params = array();
        $this->visitor = $app->getVisitor();
        
        $this->init();
    } 
    
    protected function init()
    {
        // Seul le contrôleur pour l'authentification peut être accessible
        // aux visiteurs
        if ( ! $this->visitor->isLogged() )
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
        extract($this->params);
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
     * Gestion des pages inexistantes
     */
    public static function show404(GestionNotes_Application $app)
    {
        $obj = new GestionNotes_Controller_IndexController($app);
        
        $msg = '<h1 style="font-size:x-large;">Oops :(</h1>
                <br />
                <p>Impossible de trouver la page demandée.</p>';
        
        if ( ini_get('display_errors') && (error_reporting() & E_USER_ERROR) )
        {
            $page = htmlspecialchars_decode($_REQUEST['r'], ENT_QUOTES);
            $params = print_r($_REQUEST, true);
            $session = print_r($_SESSION, true);
            $method = $_SERVER['REQUEST_METHOD'];
        
            $msg .= "
                <br />
                <p>
                    <b>Page demandée:</b> $page<br /><br />
                    <b>Paramètres:</b> <pre>$params</pre><br />
                    <b>Session:</b> <pre>$session</pre><br />
                    <b>Méthode:</b> $method
                </p>";
        }

        return $obj->showMessage($msg);
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
        return $_SERVER['SCRIPT_NAME'] . '?' . http_build_query(array_merge(array('r' => $page), $params));
    } 
}