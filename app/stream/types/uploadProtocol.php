<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 2-12-2017
 * Time: 16:34
 */
class UploadProtocol extends Stream{

    const UPLOAD_FOLDER = "uploads";

    private $handler;
    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
        $this->handler = null;
    }

    public function onStreamRequestReceive() {
        $fileData = new Method($_FILES);
        $data = new Method($_POST);
        if(!$fileData->isEmpty() && !$data->isEmpty() && ($folder = $data->fetch('targetFolder', true))!=null){
            $file = $fileData->fetch('file');
            $folder = dirname($_SERVER['DOCUMENT_ROOT']).'/'.self::UPLOAD_FOLDER.'/';
            $folder = $this->forceCreate($folder);
            $folder = $this->forceCreate($folder.$data->fetch('UUID').'/');
            $name = substr(Security::getToken(), 0, 15).'.'.explode('.', $file['name'])[1];
            move_uploaded_file($file['tmp_name'], $folder.$name);
            echo $name;
        }else{
            echo 'empty array';
        }
    }

    private function forceCreate($folder){
        if(!file_exists($folder))
            mkdir($folder, 0777, true);
        return $folder;
    }


}