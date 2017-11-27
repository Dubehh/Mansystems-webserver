<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 27-11-2017
 * Time: 15:37
 */
class MillionaireController extends Controller{

    const ROWS_PER_PAGE = 25;

    public static $difficulties = array(
        3 => "Makkelijk",
        2 => "Gemiddeld",
        1 => "Moeilijk"
    );

    const TABLE = "module_millionaire";
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
        return new View("add", "module/millionaire");
    }

    public function edit($id){
        $view = new View("edit", "module/millionaire");
        return $view;
    }
}