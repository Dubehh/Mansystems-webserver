<?php

//Set defaults
define("_ROOT", $_SERVER['DOCUMENT_ROOT'].'/app/');
define("_APP_MODEL", "app.php");
define("_LOADER_MODEL", "loader.php");

//Require models files
/** @noinspection PhpIncludeInspection */
require_once _ROOT.'system/'._APP_MODEL;
/** @noinspection PhpIncludeInspection */
require_once _ROOT._LOADER_MODEL;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manny</title>
    <?php
    //Load CSS files
    ResourceLoader::loadCSS("reset");
    ResourceLoader::loadCSS("bootstrap");
    ResourceLoader::loadCSS("page");
    ?>
</head>
<body>
    <?php App::instance()->load(); ?>
</body>
</html>