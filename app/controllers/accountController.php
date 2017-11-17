<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 17-11-2017
 */

class AccountController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index() {
        if($this->valid)
            App::instance()->redirect('home', 'index');
        return $this->login();
    }

    public function logout(){
        if($this->valid)
            $this->auth->destroy();
        App::instance()->redirect('account', 'login');
    }

    public function login(){
        return new View();
    }

} 