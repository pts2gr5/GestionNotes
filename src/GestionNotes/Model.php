<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */
namespace GestionNotes;

use PDO;

/**
 * Classe abstraite représentant un modèle
 */
abstract class Model
{
    /** @var PDO */
    protected static $db;
    
    /**
     * Retourne l'instance de la base de données
     *
     * @return PDO
     */
    public static function getDbAdapter()
    {
        return self::$db;
    }
    
    /**
     * Définit l'instance de base de données
     *
     * @param PDO $db
     */
    public static function setDbAdapter(PDO $db)
    {
        self::$db = $db;
    }
}