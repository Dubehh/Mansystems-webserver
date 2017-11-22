<?php
/**
 * Project ManSystems
 * Author: Eelco
 * Date: 8-11-2017
 */

class TrackingRequest {

    const PLAYER_NAME = "player_name";
    const PLAYER_UID  = "player_uuid";
    const QUERY_ID  = "creation_query";
    const TABLE_ID  = "table_name";

    private $name, $query, $table, $uid;
    /** @var Database source */
    private $source;
    /** @var Method method */
    private $method;

    /**
     * @param $source Database source
     * @param $method Method method
     */
    public function __construct($source, $method){
        $this->method = $method;
        $this->source = $source;
        $this->query  = $method->fetch(self::QUERY_ID, true, null);
        $this->name   = $method->fetch(self::PLAYER_NAME, true, null);
        $this->uid    = $method->fetch(self::PLAYER_UID, true, null);
        $this->table  = $method->fetch(self::TABLE_ID, true, null);
        $this->table  = 'tracking_'.$this->table;
    }

    /**
     * Loads the tracking request and creates the datatable
     */
    public function load(){
        if($this->query != null){
            $query = 'CREATE TABLE IF NOT EXISTS '.$this->table.' (';
            $query.= '`ID` int(11) NOT NULL AUTO_INCREMENT, ';
            $query.= '`PlayerID` int(11) NOT NULL, ';
            $query.= '`DateAdded` datetime DEFAULT NULL, ';
            $query.= $this->query;
            $query.=', PRIMARY KEY (`ID`))';
            try{
                $stmt = $this->source->getHandler()->getPdo()->prepare($query);
                $stmt->execute();
            }catch(PDOException $exception){
                $this->source->log($exception->getMessage());
            }
        }
    }

    /**
     * Proceeds to update the database table with all data content from the tracking request
     * @throws Exception throws when an SQL error occurs
     */
    public function update(){
        $player = App::instance()->getPlayerManager()->create($this->name, $this->uid);
        if($player==null) return;
        $handler = $this->source->getHandler();
        $handler->getPdo()->exec('START TRANSACTION');
        for($index = 0; $index < count(reset($this->method->getArray())); $index++){
            $data = array(
               "PlayerID"   => $player->getID(),
               "DateAdded"  => date("y-m-d H:m:s"));
            foreach($this->method->getArray() as $key => $content)
                $data[$key] = $content[$index];
            $handler->insertInto($this->table)->values($data)->execute();
        }
        $handler->getPdo()->exec('COMMIT');
    }
} 