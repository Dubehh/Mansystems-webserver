<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 23-11-2017
 */

class Module{
    private $name;
    private $controller;
    private $color;

    private static $id = -1;
    private static $colors = array(
        "#ffffff",
        "#e0f0ff",
        "#c9e5ff",
        "#badcfc"
    );

    public function __construct($name, $controller){
        self::$id = self::$id + 1 >= count(self::$colors) ? 0 : ++self::$id;
        $this->name = $name;
        $this->controller = $controller;
        $this->color = self::$colors[self::$id];
    }

    public function getName(){
        return $this->name;
    }

    public function getController(){
        return $this->controller;
    }

    public function getColor(){
        return $this->color;
    }
}


class ModuleController extends Controller{

    const MODULE_LIST = [
        "millionaire" => "Manny Millionaire",
        "catcher"     => "Office Catcher"
    ];

    function __construct() {
        parent::__construct();
        if(!$this->valid)
            App::instance()->redirect('account', 'login');
    }

    public function index() {
        $app = App::instance();
        $url = $app->getURL();
        if(isset($url[1]) && $url[1] != $app->getView()){
            $controller = $url[1];
            if(file_exists($ctrl = _CONTROLLERS.'modules/'.$controller.'Controller.php')){
                /** @noinspection PhpIncludeInspection */
                require_once $ctrl;
                $ctrlName = ucfirst($controller).'Controller';
                $display = isset($url[2]) ? $url[2] : 'index';
                $ctrlObj = new $ctrlName;
                $method = method_exists($ctrlObj, $display) ? $display : 'index';
                $reflection = new ReflectionMethod($ctrlObj, $method);
                if($reflection->isPublic())
                    return $ctrlObj->$method($app->getArgs(3));
            }
        }
        return $this->index_default();
    }

    private function index_default(){
        $view = new View("index");
        $data = array();
        foreach(self::MODULE_LIST as $ctrl => $name)
            array_push($data, new Module($name, $ctrl));
        $view->attach('modules', $data);
        return $view;
    }
}
