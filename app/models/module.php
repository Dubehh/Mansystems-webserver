<?php
/**
 * Project ManSystems
 * Author: Eelco
 * Date: 8-11-2017
 */

class Module {

    const PLAYER_NAME = "player_name";
    const PLAYER_UID  = "player_uuid";
    const QUERY_ID  = "creation_query";
    const TABLE_ID  = "table_name";

    private $post;
    private $player, $query, $table, $uid;
    /** @var Database source */
    private $source;

    public function __construct($source, $post){
        $this->post = $post;
        $this->source = $source;
        $this->player = $this->fetch(self::PLAYER_NAME);
        $this->uid    = $this->fetch(self::PLAYER_UID);
        $this->table  = $this->fetch(self::TABLE_ID);
        $this->query  = $this->fetch(self::QUERY_ID);
    }

    /**
     * Returns the value of the given key if it exists
     * @param $arg String key value
     * @return Object value if it exists, NULL if it doesn't
     */
    private function get($arg){
        return isset($this->post[$arg]) ? $this->post[$arg] : null;
    }

    /**
     * Fetches the value that corresponds with the given key and
     * then proceeds to remove it from the array
     * @param $key String the name of the key
     * @return Object The value that corresponds with the key
     */
    private function fetch($key){
        $val = $this->get($key);
        if($val!=null) {
            unset($this->post[$key]);
            array_values($this->post);
        }
        return $val;
    }

    public function load(){
        if($this->query != null){
            $query = 'CREATE TABLE IF NOT EXISTS tracking_'.$this->table.' (';
            $query.= '`ID` int(11) NOT NULL AUTO_INCREMENT, ';
            $query.= $this->query;
            $query.=', PRIMARY KEY (`ID`))';
            if(!$query = $this->source->getConnection()->query($query))
                $this->source->log($this->source->getConnection()->error);
        }
    }

    public function update(){
        foreach($this->post as $key => $content){
            $this->source->log($key);
            foreach($content as $value)
                $this->source->log('  '.$value);
        }
    }
} 