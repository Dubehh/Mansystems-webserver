<?php

/**
 * Project Mansystems
 * Author: Eelco
 * Date: 27-11-2017
 */

class MillionaireController extends TrackingController{

    const ROWS_PER_PAGE = 25;

    public static $difficulties = array(
        3 => "Makkelijk",
        2 => "Gemiddeld",
        1 => "Moeilijk"
    );

    const TABLE = "module_millionaire";
    const TRACKING_TABLE = "tracking_millionaire";

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $view = new View("index", "module/millionaire");
        $pagination = new Pagination();
        $data = App::instance()->getDataSource()->getHandler()
            ->from(self::TABLE)
            ->limit(self::ROWS_PER_PAGE)
            ->offset(($pagination->getCurrent()-1) * self::ROWS_PER_PAGE)
            ->orderBy('ID');
        $result = $data->getIterator();
        $view->attach('results', $result->rowCount());
        $view->attach('data', $result);
        $view->attach('page', $pagination);
        return $view;
    }

    public function add(){
        $method = new Method($_POST);
        if(!$method->isEmpty()){
            $handler = App::instance()->getDataSource()->getHandler();
            $handler->insertInto(self::TABLE)->values($method->getArray())->execute();
            App::instance()->redirect('module/millionaire');
        }
        return new View("add", "module/millionaire");
    }

    public function delete($id){
        if(isset($id) && $id!=null){
            App::instance()->getDataSource()->getHandler()
                ->deleteFrom(self::TABLE)
                ->where('ID', $id)
                ->execute();
        }
        App::instance()->redirect('module/millionaire');
    }

    public function edit($id){
        if(isset($id) && $id !=null){
            $method = new Method($_POST);
            if(!$method->isEmpty()){
                App::instance()->getDataSource()->getHandler()
                    ->update(self::TABLE)
                    ->set($method->getArray())
                    ->where('ID', $id)
                    ->execute();
                App::instance()->redirect('module/millionaire');
            }else{
                $view = new View("edit", "module/millionaire");
                $handler = App::instance()->instance()->getDataSource()->getHandler()
                    ->from(self::TABLE)
                    ->where('ID', $id);
                if($handler->count() > 0) {
                    $view->attach('difficulty', $handler->fetch('Difficulty'));
                    $view->attach('data', $handler->fetchAll()[0]);
                }
                return $view;
            }
        }
        return null;
    }

    /**
     * Returns the tracking view for this module
     * @param $player Player
     * @return View View
     */
    protected function tracking($player) {
        $view = new View("tracking", "module/millionaire");
        $pagination = new Pagination();
        $view->attach('player', $player);
        $data = App::instance()->getDataSource()->getHandler()
           ->from(self::TRACKING_TABLE)
           ->where('PlayerID', $player->getID())
           ->limit(self::ROWS_PER_PAGE)
           ->offset(($pagination->getCurrent()-1) * self::ROWS_PER_PAGE)
           ->orderBy('ID DESC');
        $view->attach('data', $data->fetchAll());
        $view->attach('results', $data->getIterator()->rowCount());
        $view->attach('page', $pagination);
        return $view;
    }


}