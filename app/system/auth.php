<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 17-11-2017
 */

class Auth {

    const SESSION_KEY = "client";
    const DB_TABLE = "online_accounts";
    const TIME_OUT = 1800;

    /**
     * Validates the current session
     * @return bool is valid
     */
    public function valid(){
        if(isset($_SESSION[self::SESSION_KEY])){
            $client = Client::deserialize($_SESSION[self::SESSION_KEY]);
            if((time() - $client->getStamp()) > self::TIME_OUT) return false;
            else{
                $query = App::instance()->getDataSource()->getHandler()
                   ->from(self::DB_TABLE)
                   ->where('ID = ? AND Token = ?', $client->getID(), $client->getToken());
                if($query->count() > 0){
                    $this->invalidate($client);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Destroys the client
     */
    public function destroy(){
        App::instance()->setClient(null);
        unset($_SESSION[self::SESSION_KEY]);
    }

    /**
     * Invalidates the current session
     * @param $client Client
     */
    public function invalidate($client){
        $validated = new Client($client->getID(), $client->getToken(), time());
        App::instance()->setClient($validated);
        $_SESSION[self::SESSION_KEY] = Client::serialize($validated);
    }

}

