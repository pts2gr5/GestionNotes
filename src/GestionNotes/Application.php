<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
if(function_exists('lcfirst') === false) {
    function lcfirst($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }
}

/**
 * Classe principale de l'application.
 */
class GestionNotes_Application
{
    /** @var array */
    protected $config;
    
    /** @var GestionNotes\Controller */
    protected $controller;
    
    /** @var PDO */
    protected $db;
    
    /** @var GestionNotes\Visitor */
    protected $visitor;
    
    /**
     * Constructeur
     *
     * @param array $config Configuration de l'application
     */
    public function __construct(array $config = array())
    {
        // Affiche toutes les erreurs
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        
        // Charge le fichier de configuration
        if ( count($config) == 0 )
        {
            if ( ! file_exists($config_file = dirname($_SERVER['SCRIPT_FILENAME']) . '/config.ini.php') )
                throw new RuntimeException('Fichier de configuration manquant');
            elseif ( ! (is_file($config_file) && is_readable($config_file)) )
                throw new RuntimeException('Impossible de lire le fichier de configuration');
            else
                $config = parse_ini_file($config_file, true);
        }
        $this->config = $config;
        
        // Chargement automatique des classes
        spl_autoload_register(array($this, 'autoload'));
        
        // Connexion à la base de données
        $db = new PDO(
            sprintf('mysql:host=%s;dbname=%s', $config['db']['host'], $config['db']['dbname']),
            $config['db']['user'], $config['db']['password'] );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("set names utf8");
        GestionNotes_Model::setDbAdapter($db);
        
        // Gestion des sessions/utilisateurs
        $this->visitor = new GestionNotes_Visitor();
    }
    
    /**
     * Lance le dispatch
     */
    public function dispatch()
    {
        // On recherche si le paramètre 'r' existe. Si oui, on en extrait les morceaux
        // séparés par des '/' pour récupérer le controlleur et la méthode à appeler
        $parts = isset($_REQUEST['r']) ? explode('/', $_REQUEST['r']) : array();
        
        // Petit nettoyage par défaut pour éviter de répéter ce code à la fois 
        // pour le controlleur et l'action
        array_walk($parts, array($this, 'sanitizeUrl'));
        
        // Le nom du controller se présente sous la forme FooController
        $controller = (count($parts) >= 1 && $parts[0]) ? 
            ucfirst($parts[0]).'Controller' : 'IndexController';
        
        // Détermine le nom de la méthode à appeler
        if ( count($parts) >= 2 && $parts[1] ) {
            $action = '';
            
            // admin/semestre/new => AdminController::newSemestreAction() 
            foreach ( array_reverse(array_slice($parts, 1, null, true)) as $part )
                $action .= ucfirst($part);
            
            $action = lcfirst($action).'Action';
        }
        else
            // admin => AdminController::indexAction()
            $action = 'indexAction';
        
        // On y ajoute le namespace
        // Comme piste d'amélioration, définir un fichier avec les routes
        $controller = 'GestionNotes_Controller_'.$controller;
        
        // On vérifie si le controlleur existe et si la méthode souhaitée y est définie.
        if ( ! (class_exists($class = $controller) && method_exists($this->controller = new $class($this), $action) ) ) {
            // Envoie un code d'erreur 404 au navigateur
            // Selon le navigateur, il y aura soit le message 'Page non trouvée' (Firefox, Chrome) soit une page
            // propre au navigateur (Internet Explorer)
            header('HTTP/1.0 404 Not Found');
            // Important car les navigateurs utilisent par défaut l'ISO-8859-1
            header('Content-Type: text/html; charset=utf-8');
            // Notre joli message à afficher (TODO: le rendre beau :p)
            //echo '<h1>Page non trouvée</h1>';
            echo GestionNotes_Controller::show404($this);
            // On veillera à arrêter le script à la fin pour éviter que d'autres actions s'effectuent.
            exit;
        }
        
        // On exécute l'action demandée et on quitte le script. Fin de l'histoire.
        echo $this->controller->{$action}();
        exit;
    }
    
    protected function sanitizeUrl( & $input )
    {
        $input = strtolower(trim(str_replace('-','_',$input))); 
    }
    
    /**
     * Chargement automatique d'une classe
     *
     * @param string $class
     * @return boolean
     */
    public function autoload($class)
    {
        $file = $this->config['path']['src'].'/'.str_replace('_', DIRECTORY_SEPARATOR, $class).'.php';
        return ( file_exists($file) && include_once($file) );
    } 
    
    /** @return array */
    public function getConfig() { return $this->config; }
    
    /** @return GestionNotes\Controller */
    public function getController() { return $this->controller; }
    
    /** @return GestionNotes\Visitor */
    public function getVisitor() { return $this->visitor; }
}