<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

//Set defaults
session_start();
define("_APP", $_SERVER['DOCUMENT_ROOT'].'/app/');
define("_URL", "http://" . $_SERVER['SERVER_NAME'].'/');
define("_CONTROLLERS", _APP.'controllers/');
define("_VIEWS", _APP.'views/');
define("_CSS", "css");
define("_JS", "js");
define("_IMG", "img");
define("_AUTOLOAD_FOLDERS", array(
    "models",
    "system",
    "system/fluent",
    "stream"
));
//Register autoloader
spl_autoload_register(function($class){
    $iterator = new ArrayIterator(_AUTOLOAD_FOLDERS);
    foreach($iterator as $directory){
        $file = _APP.$directory.'/'.(lcfirst($class));
        if(!is_dir($file) && file_exists($file.'.php'))
            require_once $file.'.php';
    }
});
