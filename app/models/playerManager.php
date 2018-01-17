<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

class PlayerManager {

    const TABLE = "online_players";
    private $handler;

    /**
     * Constructs a new player collection
     * @param $source Database
     */
    public function __construct($source){
        $this->handler = $source->getHandler();
    }

    /**
     * Fetches the player with the given UUID if it exists
     * @param $key mixed Database key
     * @param $identifier mixed value that relates to the given key
     * @return null|Player Player if it exists, null if it doesnt
     */
    public function fetch($key, $identifier){
        $query = $this->handler->from(self::TABLE)->where($key, $identifier);
        if($query->count()>0)
            return new Player(
                $query->fetch('ID'),
                $query->fetch('UUID'),
                $query->fetch('Name')
            );
        return null;
    }

    /**
     * Removes the player with the given ID
     * @param $id int ID
     */
    public function remove($id){
        $this->handler->deleteFrom(self::TABLE)
            ->where('ID', $id)
            ->execute();
    }

    /**
     * Creates a new player or finds an existing one
     * @param $name String Name of the player
     * @param $uuid String UUID of the player
     * @return null|Player The player that has the given UUID
     * @throws Exception throws when an SQL error occurs
     */
    public function create($name, $uuid){
        $name = trim($name);
        if(($player = $this->fetch('UUID', $uuid)) == null){
            $id = $this->handler->insertInto(self::TABLE)->values(array(
               "Name" => empty($name) ? 'Unknown' : $name,
                "UUID" => $uuid,
                "Registered" => date('y-m-d H:i:s')
            ))->execute();
            return new Player( $id,$uuid,$name);
        }else
            return $player;
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