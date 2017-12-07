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
        $handler = App::instance()->getDataSource()->getHandler();
        $view->attach('player_data', $handler->from(PlayerManager::TABLE)->getIterator());
        $view->attach('account_data', $handler->from(Auth::DB_TABLE)->getIterator());
        return $view;
    }

    public function player_delete($id){
        if(Validate::notNull($id))
            App::instance()->getPlayerManager()->remove($id);
        return $this->index();
    }

    public function user_verify($id){
        if(Validate::notNull($id))
            App::instance()->getDataSource()->getHandler()
                ->update(Auth::DB_TABLE)
                ->set('Validated', 1)
                ->where('ID', $id)
                ->execute();
        App::instance()->redirect('dashboard');
    }

    public function user_delete($id){
        if(Validate::notNull($id)) {
            $deleteSelf = App::instance()->getClient()->getID() == $id;
            App::instance()->getDataSource()->getHandler()
               ->deleteFrom(Auth::DB_TABLE)
               ->where('ID', $id)
               ->execute();
            if($deleteSelf) {
                $this->auth->destroy();
                App::instance()->redirect('account', 'login');
            }
        }
        return $this->index();
    }

}