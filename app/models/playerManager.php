<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

class PlayerManager {

    const TABLE = "onlinePlayerTable";
    private $handler;

    /**
     * Constructs a new player collection
     * @param $source Database
     */
    public function __construct($source){
        $this->handler = $source->getHandler();
    }

    public function fetch($uuid){
        $query = $this->handler->from(self::TABLE)->where('UUID', $uuid);
        if($query->count()>0)
            return new Player(
                $query->fetch('ID'),
                $query->fetch('UUID'),
                $query->fetch('Name')
            );
        return null;
    }


    public function create($name, $uuid){
        if($this->fetch($uuid) == null){
            $this->handler->insertInto(self::TABLE)->values(array(
                "Name" => $name,
                "UUID" => $uuid
            ))->execute();
        }
    }

}

class Player{

    private $id, $uuid, $name;
    public function __construct($id, $uuid, $name){
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
    }

    public function getID(){
        return $this->id;
    }

    public function getUUID(){
        return $this->uuid;
    }

    public function getName(){
        return $this->name;
    }
}