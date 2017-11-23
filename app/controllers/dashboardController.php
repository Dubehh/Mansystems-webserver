<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 15-11-2017
 */

class DashboardController extends Controller{

    public function __construct(){
        parent::__construct();
        if(!$this->valid)
            App::instance()->redirect('account', 'login');
    }

    public function index() {
        $view = new View('index');
        $query = App::instance()->getDataSource()->getHandler()->from(PlayerManager::TABLE);
        $view->attach('data', $query->getIterator());
        return $view;
    }

    public function player_delete($id){
        if(isset($id) && $id != null)
            App::instance()->getPlayerManager()->remove($id);
        return $this->index();
    }

}