<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 15-11-2017
 */

class App {

    private static $instance = null;

    private $url;
    private $controller, $view, $args;

    private function __construct(){
        $this->url = explode('/', $_GET['url']);
        $this->controller = empty($this->url[0]) ? 'home' : $this->url[0];
        $this->view = str_replace('-','_', isset($this->url[1]) ? $this->url[1] : 'index');
        $this->args = $this->getArgs();
    }

    public static function instance(){
        if(self::$instance==null)
            self::$instance = new App();
        return self::$instance;
    }

    /**
     * Loads the controller and view based on the given URL
     * Returns a 404 page if a controller is not found
     */
    public function load(){
        if(file_exists($ref = _CONTROLLERS.($file=$this->controller.'Controller.php'))){
            /** @noinspection PhpIncludeInspection */
            require_once $ref;
            $obj = substr($file, 0, -4);
            $controller = new $obj;
            $func = $this->view = method_exists($controller, $this->view) ? $this->view : 'index';
            $view = $controller->$func($this->args);
            /** @noinspection PhpUndefinedMethodInspection */
            $view->render();
        }else{
            echo '404';
        }
    }

    /**
     * @return string The current controller name
     */
    public function getController(){
        return $this->controller;
    }
    /**
     * @return mixed The current view name
     */
    public function getView(){
        return $this->view;
    }

    public function getURL(){
        return $this->url;
    }

    /**
     * Fetches the leftover arguments passed in the URL aside from the controller and the view
     * If there are multiple arguments supplised an array is returned, a single value is returned otherwise
     * @return array|mixed|null The argument(s)
     */
    private function getArgs() {
        $rtn = array();
        for ($i = 2; $i < count($this->url) && !empty($this->url[$i]); $i++)
            array_push($rtn, $this->url[$i]);
        if (($count = count($rtn)) > 0)
            return $count > 1 ? $rtn : $rtn[0];
        return null;
    }
}