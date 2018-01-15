<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 21-11-2017
 */

class Method {

    private $array;
    public function __construct($array){
        $this->array = $array;
    }

    public function getArray(){
        return $this->array;
    }

    public function fetch($key, $remove = false, $default = null){
        $val = $this->has($key) ? $this->array[$key] : $default;
        if($remove && $val != $default){
            unset($this->array[$key]);
            array_values($this->array);
        }
        return $val;
    }

    public function set($key, $val){
        $this->array[$key] = $val;
    }

    public function has($key){
        return isset($this->array[$key]);
    }

    public function isEmpty(){
        return empty($this->array);
    }

    public function format(){
        $array = array();
        foreach($this->getArray() as $key=>$val){
            $array[$key] = is_string($val) ?
                htmlentities(htmlspecialchars($val)) : $val;
        }
        $this->array = $array;
    }
} 