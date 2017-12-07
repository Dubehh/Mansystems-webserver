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
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="shortcut icon" href="https://www.mansystems.com/wp-content/uploads/2016/12/favicon.png">
    <?php
    //Load local CSS files
    ResourceLoader::loadCSS("reset");
    ResourceLoader::loadCSS("bootstrap");
    ResourceLoader::loadCSS("page");
    ?>
</head>
<body>
    <nav class="navbar-main navbar navbar-inverse navbar-fixed-top">
        <div class="navigation-header container-fluid">
            <div class="navbar-header">
                <a class="header-icon navbar-brand" href="<?php echo _URL.'dashboard'?>">
                    <?php ResourceLoader::loadIMG('manny_logo.png');?>
                </a>
            </div>
            <button type="button" class="navbar-toggle" id="toggleNav" data-toggle="collapse" data-target="#navMain">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <?php
                $auth = new Auth();
                if($auth->valid()){?>
                <ul id="main-nav" class="nav navbar-nav navbar-right">
                    <li><a class="nav-item" href="<?php echo _URL.'dashboard'?>">Dashboard</a></li>
                    <li><a class="nav-item" href="<?php echo _URL.'module'?>">Modules</a></li>
                    <li><a class="nav-item" href="<?php echo _URL.'account/logout'?>">Uitloggen</a></li>
                </ul>
                <?php }?>
            </div>
        </div>
    </nav>
    <div id="content-container" class="container">
        <?php App::instance()->load(); ?>
    </div>
    <?php
    //Load JS files
    ResourceLoader::loadJS("jquery");
    ResourceLoader::loadJS("main");
    ?>
</body>
</html>