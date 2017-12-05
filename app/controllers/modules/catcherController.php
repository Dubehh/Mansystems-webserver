<?php

/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 27-11-2017
 * Time: 15:37
 */
class catcherController extends TrackingController{

    const ROWS_PER_PAGE = 25;

    const TRACKING_TABLE = "tracking_Catcher";

    function __construct() {
        parent::__construct();
    }

    /**
     * Returns the tracking view for this module
     * @param $player Player
     * @return View View
     */
    protected function tracking($player) {
        $view = new View("tracking", "module/catcher");
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


    public function index() {
        echo "<b>Lol</b>";
    }
}