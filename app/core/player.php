<?php
/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 8-11-2017
 * Time: 15:20
 */

class Player{

    private $name, $uid, $id;

    public function __construct($id, $name, $uuid){
        $this->name = $name;
        $this->uid = $uuid;
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function getUUID(){
        return $this->uid;
    }

    public function getID(){
        return $this->id;
    }
}