<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 2-12-2017
 * Time: 15:34
 */
class CatcherController extends TrackingController{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return new View(View::ERROR);
    }

    protected function tracking($id) {
        return new View("tracking", "module/catcher");
    }


}