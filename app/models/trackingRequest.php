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

    private $player, $query, $table, $uid;
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
        $this->player = $method->fetch(self::PLAYER_NAME, true, null);
        $this->uid    = $method->fetch(self::PLAYER_UID, true, null);
        $this->table  = $method->fetch(self::TABLE_ID, true, null);
        $this->query  = $method->fetch(self::QUERY_ID, true, null);
    }

    public function load(){
        if($this->query != null){
            $query = 'CREATE TABLE IF NOT EXISTS tracking_'.$this->table.' (';
            $query.= '`ID` int(11) NOT NULL AUTO_INCREMENT, ';
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

    public function update(){
        foreach($this->method->getArray() as $key => $content){
            $this->source->log($key);
            foreach($content as $value)
                $this->source->log('  '.$value);
        }
    }
} 