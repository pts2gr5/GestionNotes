<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
 
// Ne pas éditer cette ligne
$config = array('db' => array(), 'path' => array(), 'school' => array());

// Informations sur le site
$config['school']['name']   = 'IUT Laval';
$config['school']['logo']   = null;         // null = valeur par défaut

// Configuration de la base de données
$config['db']['host']       = 'localhost';
$config['db']['dbname']     = 'gestion_notes';
$config['db']['user']       = 'root';
$config['db']['password']   = '';
$config['db']['charset']    = 'UTF-8';

// Configuration des chemins
$config['path']['root']     = dirname(__FILE__).'/../';
$config['path']['views']    = dirname(__FILE__).'/views';
$config['path']['src']      = $config['path']['root'].'/src';

// Réglages avancées
$config['debug']            = true;         // Affiche les erreurs
$config['url_rewriting']    = true;         // Active la réécriture d'URLs

return $config;