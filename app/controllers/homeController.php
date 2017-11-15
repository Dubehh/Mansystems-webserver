<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 15-11-2017
 */

class HomeController implements Controller{

    public function index() {
        return new View();
    }

    public function start(){
        $view = new View();
        $view->attach('table_data', array("x" => "y", "z" => "a"));
        return $view;
    }


} 