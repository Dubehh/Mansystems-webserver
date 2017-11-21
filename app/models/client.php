<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 17-11-2017
 */

class Client {

    private $id;
    private $token;
    private $stamp;

    public function __construct($id, $token, $stamp = -1){
        $this->id = $id;
        $this->token = $token;
        $this->stamp = $stamp;
    }

    /**
     * Returns the login token of the client
     * @return mixed
     */
    public function getToken(){
        return $this->token;
    }

    /**
     * Returns the last validated timestamp of the client
     * @return mixed
     */
    public function getStamp(){
        return $this->stamp;
    }

    /**
     * Returns the ID of the client
     * @return mixed
     */
    public function getID(){
        return $this->id;
    }

    /**
     * Serializes the client object to an array
     * @param $client Client the client you want to serialize
     * @return array serialized client
     */
    public static function serialize($client){
        return array(
            'id'    => $client->getID(),
            'token' => $client->getToken(),
            'stamp' => $client->getStamp()
        );
    }
    /**
     * Deserializes the given array to a client object
     * @param $array mixed Array
     * @return Client instance
     */
    public static function deserialize($array){
        return new Client(
            $array['id'],
            $array['token'],
            $array['stamp']
        );
    }


} 