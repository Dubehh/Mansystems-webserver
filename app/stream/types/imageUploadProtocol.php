<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 2-12-2017
 * Time: 16:34
 */
class ImageUploadProtocol extends Stream{

    private $handler;
    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
        $this->handler = null;
    }

    public function onStreamRequestReceive() {
        $method = new Method($_FILES);
        if(!$method->isEmpty()){
            print_r($method->getArray());
        }else{
            echo 'empty array';
        }
    }


}