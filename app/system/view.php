<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 15-11-2017
 */

class View {

    const ERROR = "404";

    private $name;
    private $controller;
    public function __construct($name = '', $controller = ''){
        if($name === self::ERROR) {
            $this->name = self::ERROR;
            $this->controller = null;
        }else{
            $this->name = empty($name) ? App::instance()->getView() : $name;
            $this->controller = empty($controller) ? App::instance()->getController() : $controller;
        }
    }

    /**
     * Dynamically appends fields to the view.
     * These fields can be used inside the view.
     * @param $key string The name of the field
     * @param $value mixed The value of the field
     */
    public function attach($key, $value){
        $this->$key = $value;
    }

    /**
     * Renders the view
     */
    public function render(){
        require_once _VIEWS.($this->controller != null ? $this->controller.'/' : '').$this->name.'.php';
    }
}