<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes;

use PDO;
use RuntimeException;

/**
 * Classe principale de l'application.
 */
class Application
{
    /** @var array */
    protected $config;
    
    /** @var GestionNotes\Controller */
    protected $controller;
    
    /** @var PDO */
    protected $db;
    
    /** @var GestionNotes\User */
    protected $user;
    
    /**
     * Constructeur
     *
     * @param array $config Configuration de l'application
     */
    public function __construct(array $config)
    {
        // Affiche toutes les erreurs
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        
        // Charge le fichier de configuration
        /*
        if ( ! file_exists($config_file = dirname($_SERVER['SCRIPT_FILENAME']) . '/config.ini.php') )
            throw new RuntimeException('Fichier de configuration manquant');
        elseif ( ! (is_file($config_file) && is_readable($config_file)) )
            throw new RuntimeException('Impossible de lire le fichier de configuration');
        else
            $this->config = $config = parse_ini_file($config_file, true);
        */
        $this->config = $config;
        
        // Chargement automatique des classes
        spl_autoload_register(array($this, 'autoload'));
        
        // Connexion à la base de données
        $db = new PDO(
            sprintf('mysql:host=%s;dbname=%s', $config['db']['host'], $config['db']['dbname']),
            $config['db']['user'], $config['db']['password'] );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Model::setDbAdapter($db);
        
        // Gestion des sessions/utilisateurs
        //$this->user = new User();
        
        // Rend l'object accessible depuis Template
        //Template::setApplication($this);
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
        array_walk($parts, function (&$input) { $input = strtolower(trim(str_replace('-','_',$input))); });
        
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
        
        if ( ! (class_exists($class = $controller) && method_exists($this->controller = new $class($this), $action) ) ) {
            // Envoie un code d'erreur 404 au navigateur
            // Selon le navigateur, il y aura soit le message 'Page non trouvée' (Firefox, Chrome) soit une page
            // propre au navigateur (Internet Explorer)
            header('HTTP/1.0 404 Not Found');
            // Important car les navigateurs utilisent par défaut l'ISO-8859-1
            header('Content-Type: text/html; charset=utf-8');
            // Notre joli message à afficher (TODO: le rendre beau :p)
            echo '<h1>Page non trouvée</h1>';
            // On veillera à arrêter le script à la fin pour éviter que d'autres actions s'effectuent.
            exit;
        }
        
        // On exécute l'action demandée et on quitte le script. Fin de l'histoire.
        echo $this->controller->{$action}();
        exit;
    }
    
    /**
     * Chargement automatique d'une classe
     *
     * @param string $class
     * @return boolean
     */
    public function autoload($class)
    {
        $file = $this->config['path']['src'].'/'.str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
        return ( file_exists($file) && include_once($file) );
    } 
    
    /** @return array */
    public function getConfig() { return $this->config; }
    
    /** @return GestionNotes\Controller */
    public function getController() { return $this->controller; }
    
    /** @return GestionNotes\User */
    public function getUser() { return $this->user; }
}