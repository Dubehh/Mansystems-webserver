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
    private $handler;

    public function __construct(){
        try {
            $this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::UID, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo $exception->getMessage();
            exit;
        }
        $this->handler = new FluentPDO($this->connection);
    }

    public function log($message){
        echo '<MYSQL: '.$message.' >';
    }

    public function getHandler(){
        return $this->handler;
    }

    public function getConnection(){
        return $this->connection;
    }
} 