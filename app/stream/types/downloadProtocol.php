<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 7-12-2017
 */

class DownloadProtocol extends Stream{

    const UPLOAD_FOLDER = "uploads";

    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
    }

    public function onStreamRequestReceive() {
        $data = new Method($this->data);
        $folder = dirname($_SERVER['DOCUMENT_ROOT']).'/'.self::UPLOAD_FOLDER.'/';
        $uuid = $data->fetch('UUID');
        $target = $data->fetch('targetFolder');
        $fileName = $data->fetch('name');
        if(file_exists(($fileName = $folder.$target.'/'.$uuid.'/'.$fileName))){
            $extension = str_replace('jpg', 'jpeg', explode('.', $fileName)[1]);
            header("Content-Type: image/".$extension);
            header("Content-Length: " . filesize($fileName));
            readfile($fileName, true);
            exit;
        }
    }
} 