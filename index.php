<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
// Chargement de la configuration
if ( ! file_exists($configFile = __DIR__.'/app/config.php') )
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
require_once (isset($config['path']['src']) ? $config['path']['src'] : __DIR__)
    .'/GestionNotes/Application.php';

// Initialisation de l'application
$app = new GestionNotes\Application($config);

// C'est parti !
$app->dispatch();