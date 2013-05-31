<?php
/**
 * Gestion des notes
 *
 * @copyright PTS2 Groupe 5
 * @license Redistribution interdite
 */

/**
 * Classe abstraite représentant un modèle
 */
abstract class GestionNotes_Model implements ArrayAccess, Serializable
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
    
    /**
     * Créer un objet à partir d'un tableau
     *
     * @param array Le nouveau tableau ou objet à utiliser.
     * @return self
     */
    public abstract static function exchange(array $values);
    
    // ---------------------- @implements \AccessAccess -----------------------  //

    /**
     * @param string $offset La position à laquelle assigner une valeur.
     * @param string $value La valeur à assigner.
     */
    public function offsetSet($offset, $value)
    {
        if ( ! property_exists($this, $offset) )
            //throw new UnexpectedValueException();
            return;
        
        if ( method_exists($this, $method = 'filter'.ucfirst($offset))
            && call_user_func(array($this, $method), $value) == false )
            throw new InvalidArgumentException();
        
        // L'utilisation de utf8_encode semble être requis sur certaines configurations.
        $this->{$offset} = is_string($value) ? utf8_encode($value) : $value;
    }

    /**
     * @param string $offset L'index à vérifier.
     */
    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    /**
     * @param string $offset L'index à effacer. 
     */
    public function offsetUnset($offset)
    {
        throw new RuntimeException('Impossible de supprimer un champ d\'un modèle.');
    }
    
    /**
     * @param string $offset L'index demandé.
     */
    public function offsetGet($offset)
    {
        if ( ! property_exists($this, $offset) )
            throw new InvalidArgumentException('Champ invalide: '.$offset);
        
        return $this->{$offset};
    }
    
    // ---------------------- @implements \Serializable -----------------------  //
    
    /**
     * @return string Les champs serializés
     */
    public function serialize()
    {
        $data = array();
        
        foreach ( get_object_vars($this) as $name => $value ) {
            if ( $name == 'db' ) continue;  // L'object $db ne peut être sérializé
            $data[ $name ] = $value;
        }
        
        return serialize($data);
    }
    
    /**
     * @param string $serialized L'objet ArrayObject linéarisé
     */
    public function unserialize($serialized)
    {
        foreach ( unserialize($serialized) as $key => $value )
            $this->offsetSet($key, $value);
    }
}