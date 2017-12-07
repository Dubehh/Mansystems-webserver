<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 30-11-2017
 * Time: 18:04
 */
abstract class TrackingController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function track($id){
        if(Validate::notNull($id)){
            $player = App::instance()->getPlayerManager()->fetch('ID', $id);
            if(Validate::notNull($player))
                return $this->tracking($player);
        }
        return $this->index();
    }

    protected abstract function tracking($player);
}