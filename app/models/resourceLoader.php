<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 15-11-2017
 */

/**
 * Class ResourceLoader Utility
 */
class ResourceLoader {

    /**
     * Fetches a relative path of the given folder and filename
     * @param $folder string the name of the folder
     * @param $filename string the name of the file
     * @return string The relative path
     */
    private static function getRelativePath($folder, $filename){
        $append = './';
        for($i = 1; $i < count(App::instance()->getURL()); $i++)
            $append.='../';
        return $append.'resources/'.$folder.'/'.$filename;
    }

    public static function loadCSS($filename){
        $path = self::getRelativePath(_CSS, $filename);
        $markup = "<link href='$path.css' rel='stylesheet' type='text/css'/>";
        echo $markup;
    }

    public static function loadJS($filename){
        $path = self::getRelativePath(_JS, $filename);
        $markup = "<script src='$path.js'></script>";
        echo $markup;
    }

    public static function loadIMG($filename, $attr = ''){
        $path = self::getRelativePath(_IMG, $filename);
        $markup = "<img src='$path' $attr/>";
        echo $markup;
    }

} 