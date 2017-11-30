<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 23-11-2017
 */

class ModuleController extends Controller{

    private $moduleList;

    function __construct() {
        parent::__construct();
        if(!$this->valid)
            App::instance()->redirect('account', 'login');
        $this->moduleList = [
           "millionaire" => "Manny Millionaire",
           "catcher"     => "Office Catcher"
        ];
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
                /** @var TrackingController $ctrlObj */
                $ctrlObj = new $ctrlName;
                $method = method_exists($ctrlObj, $display) ? $display : 'index';
                $reflection = new ReflectionMethod($ctrlObj, $method);
                if($reflection->isPublic())
                    return $ctrlObj->$method($app->getArgs(3));
                else return $ctrlObj->index();
            }
        }
        return $this->index_default(false);
    }

    public function track($id){
        if(isset($id) && $id != null){
            $view = $this->index_default(true);
            $player = App::instance()->getPlayerManager()->fetch('ID', $id);
            if($player != null){
                $view->attach('player', $player);
                return $view;
            }
        }
        return $this->index_default();
    }

    private function index_default($trackingRequest = false){
        Module::resetColors();
        $view = new View("index");
        $data = array();
        foreach($this->moduleList as $ctrl => $name)
            array_push($data, new Module($name, $ctrl));
        $view->attach('modules', $data);
        $view->attach('isTrackingView', $trackingRequest);
        return $view;
    }
}
