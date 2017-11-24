<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 23-11-2017
 */

class ModuleController extends Controller{

    function __construct() {
        parent::__construct();
        if(!$this->valid)
            App::instance()->redirect('account', 'login');
    }

    public function index() {
        return new View();
    }

    public function manage_millionaire(){
        //get current questions
        return new View("millionaire_mod");
    }


} 