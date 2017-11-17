<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 15-11-2017
 */

class HomeController extends Controller{

    public function __construct(){
        parent::__construct();
        if(!$this->valid)
            App::instance()->redirect('account', 'login');
    }

    public function index() {
        return new View();
    }

}