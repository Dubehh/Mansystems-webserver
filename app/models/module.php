<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 30-11-2017
 * Time: 17:56
 */
class Module{

    private $name;
    private $controller;
    private $color;

    private static $id = -1;
    private static $colors = array(
        "#ffffff",
        "#e0f0ff",
        "#c9e5ff",
        "#badcfc"
    );

    public static function resetColors(){ self::$id=-1;}
    public function __construct($name, $controller){
        self::$id = self::$id + 1 >= count(self::$colors) ? 0 : ++self::$id;
        $this->name = $name;
        $this->controller = $controller;
        $this->color = self::$colors[self::$id];
    }

    public function getName(){
        return $this->name;
    }

    public function getController(){
        return $this->controller;
    }

    public function getColor(){
        return $this->color;
    }
}
