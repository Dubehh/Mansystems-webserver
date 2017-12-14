<?php

/**
 * Project Mansystems
 * Author: Eelco & Hugo
 * Date: 2-12-2017
 */

class CatcherController extends TrackingController{

    const ROWS_PER_PAGE = 25;
    const TRACKING_TABLE = "tracking_Catcher";

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return new View(View::ERROR);
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
            ->offset(($pagination->getCurrent() - 1) * self::ROWS_PER_PAGE)
            ->orderBy('ID DESC');
        $view->attach('data', $data->fetchAll());
        $view->attach('results', $data->getIterator()->rowCount());
        $view->attach('page', $pagination);
        return $view;
    }


}