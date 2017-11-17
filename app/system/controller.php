<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 15-11-2017
 */

abstract class Controller {

    protected $auth;
    protected $valid;
    public function __construct(){
        $this->auth = new Auth();
        $this->valid = $this->auth->valid();
    }

    public abstract function index();
} 