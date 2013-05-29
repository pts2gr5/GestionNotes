<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */

// Patch pour le serveur HTTP de l'IUT
$_SERVER['SCRIPT_NAME'] = '/12inf1pj05/'.$_SERVER['SCRIPT_NAME'];

// Chargement de la configuration
if ( ! file_exists($configFile = dirname(__FILE__).'/app/config.php') )
    die('Fichier de configuration introuvable.');
elseif ( ! is_file($configFile) || ! is_readable($configFile) )
    die('Fichier de configuration illisible.');
else
    $config = require $configFile;

// Affichage des erreurs (mode debug)
if ( isset($config['debug']) && $config['debug'] ) {
    @ ini_set('display_errors', true);
    error_reporting(E_ALL);
}

// Chargement de la classe principale
require_once (isset($config['path']['src']) ? $config['path']['src'] : dirname(__FILE__))
    .'/GestionNotes/Application.php';

// Initialisation de l'application
$app = new GestionNotes_Application($config);

// C'est parti !
$app->dispatch();