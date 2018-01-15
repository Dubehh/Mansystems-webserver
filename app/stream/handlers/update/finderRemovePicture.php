<?php
/**
 * Project Mansystems
 * Author: Hugo
 * Date: 19-12-2017
 */

class FinderRemovePicture extends DataHandler {

    function __construct($data){
        parent::__construct($data);
        $method = new Method($data);
        $uid = $method->fetch("uid");
        $file = $method->fetch("file");

        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/finder/' . $uid . '/' . $file;

        if (file_exists($filePath))
            unlink($filePath);
    }
} 
