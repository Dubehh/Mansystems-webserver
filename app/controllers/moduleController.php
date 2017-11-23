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


} 