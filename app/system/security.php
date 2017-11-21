<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 21-11-2017
 */

class Security {

    /**
     * Encrypts the given input with a PHP defined hash
     * @param $input String the original value
     * @return bool|string the hashed vlaue
     */
    public static function encrypt($input){
        return password_hash($input, PASSWORD_DEFAULT);
    }
    /**
     * Checks whether the given input matches the hash
     * @param $input String the original input
     * @param $hash String the hash value
     * @return bool true if it is a match
     */
    public static function valid($input, $hash){
        return password_verify($input, $hash);
    }
    /**
     * Calculates and fetches a random token
     * @return string token
     */
    public static function getToken(){
        return md5(uniqid(rand(), true));
    }
} 