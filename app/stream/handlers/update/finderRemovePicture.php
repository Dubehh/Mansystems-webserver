<?php
/**
 * Project Mansystems
 * Author: Hugo
 * Date: 19-12-2017
 */

class finderRemovePicture extends DataHandler {

    function __construct($data) {
        $method = new Method($data);
        $uid = $method->fetch("uid");
        $file = $method->fetch("file");

        $filePath = dirname($_SERVER['DOCUMENT_ROOT']) . '/uploads/finder/' . $uid . '/' . $file;

        if (file_exists($filePath))
            unlink($filePath);
    }
} 