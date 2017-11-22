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
          DATABASE = "Mansystems";

    private $connection;
    private $handler;

    public function __construct(){
        try {
            $this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::UID, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            $this->log($exception->getMessage());
            exit;
        }
        $this->handler = new FluentPDO($this->connection);
    }

    public function log($message){
        echo '<MYSQL: '.$message.' >';
    }

    /**
     * Returns the PDO library for building queries
     * @return FluentPDO Querybuilder
     */
    public function getHandler(){
        return $this->handler;
    }

    /**
     * Returns the raw connection
     * @return PDO
     */
    public function getConnection(){
        return $this->connection;
    }
} 