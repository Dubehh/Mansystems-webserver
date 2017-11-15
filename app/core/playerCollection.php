<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

class PlayerCollection {

    const TABLE = "onlinePlayerRegister";
    private $source;

    /**
     * Constructs a new PlayerCollection class
     * @param $source Database
     */
    public function __construct($source){
        $this->source = $source;
        $query = 'CREATE TABLE IF NOT EXISTS '.self::TABLE.' (';
        $query.= '`ID` INT NOT NULL AUTO_INCREMENT, ';
        $query.= '`Name` VARCHAR(100) NULL, ';
        $query.= '`UUID` VARCHAR(255) NOT NULL, ';
        $query.= ' PRIMARY KEY (`ID`))';

        if(!$source->getConnection()->query($query))
            $source->log('Table '.self::TABLE.' could not be created.');
    }

    public function fetch($uuid){
        $query = "SELECT * FROM ".self::TABLE.' WHERE GUID = ?';
        $statement = $this->source->getConnection()->prepare($query);
        $statement->bind_param("s", $uuid);
        $statement->execute();
        $result = $statement->get_result();
        if($result->num_rows > 0 && $row = $result->fetch_assoc())
            return new Player(
               $row['ID'],
               $row['Name'],
               $row['UUID']);
        return null;
    }


    public function createNew($name, $uuid){

    }

    public function exists($uuid){
        return $this->fetch($uuid) != null;
    }
} 