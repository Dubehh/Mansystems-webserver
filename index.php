<?php

//Set defaults
define("_ROOT", $_SERVER['DOCUMENT_ROOT'].'/app/');
define("_APP_MODEL", "app.php");
define("_LOADER_MODEL", "loader.php");

//Require core files
/** @noinspection PhpIncludeInspection */
require_once _ROOT.'/core/'._APP_MODEL;
/** @noinspection PhpIncludeInspection */
require_once _ROOT._LOADER_MODEL;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php App::instance()->load(); ?>
</body>
</html>