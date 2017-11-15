<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

//Set defaults
define("_APP", $_SERVER['DOCUMENT_ROOT'].'/app/');
define("_AUTOLOAD_FOLDERS", array(
    "core",
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
