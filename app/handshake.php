<?php

//Set defaults
define("_ROOT", $_SERVER['DOCUMENT_ROOT']);
define("_REQUEST_TYPE", $_SERVER['REQUEST_METHOD']);
define("_STREAM_FOLDER", _ROOT."/app/stream");
error_reporting(E_ERROR | E_PARSE);

//Check whether the request is a POST
if(_REQUEST_TYPE!=='POST')return;
//Register autoloader
require_once _ROOT.'/app/loader.php';

$resolver = new StreamResolver($_POST);
$resolver->resolve();



