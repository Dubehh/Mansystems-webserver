<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 7-12-2017
 */

class DownloadProtocol extends Stream implements IStreamResponse{

    const UPLOAD_FOLDER = "uploads";

    private $fileName;

    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
    }

    public function onStreamRequestReceive() {
        $data = new Method($this->data);
        $folder = $_SERVER['DOCUMENT_ROOT'].'/'.self::UPLOAD_FOLDER.'/';
        $uuid = $data->fetch('UUID');
        $target = $data->fetch('targetFolder');
        $fileName = $data->fetch('name');
        $this->fileName = file_exists(($fileName = $folder.$target.'/'.$uuid.'/'.$fileName)) ? $fileName : null;
    }

    public function respond() {
        if($this->fileName==null)return;
        $extension = str_replace('jpg', 'jpeg', explode('.', $this->fileName)[1]);
        header("Content-Type: image/".$extension);
        header("Content-Length: " . filesize($this->fileName));
        readfile($this->fileName, true);
        exit;
    }
} 