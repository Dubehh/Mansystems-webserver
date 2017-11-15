<?php
/**
 * Project ManSystems
 * Author: Eelco
 * Date: 8-11-2017
 */

class Database {

    const UID  = "root",
          PASS = "",
          HOST = "localhost",
          DATABASE = "Manny";

    private $connection;

    public function __construct(){
        $this->connection = new mysqli(
           self::HOST,
           self::UID,
           self::PASS);
        if($this->connection->connect_error) die("Connect failed!");
        else $this->build();
    }

    private function build(){
        $query = "CREATE DATABASE IF NOT EXISTS ".self::DATABASE;
        $result = $this->connection->query($query);
        if(!$result)
            throw new Exception("Database couldn't be created!");
        else $this->connection->select_db(self::DATABASE);
    }

    public function log($message){
        echo '<MYSQL: '.$message.' >';
    }

    public function getConnection(){
        return $this->connection;
    }
} 