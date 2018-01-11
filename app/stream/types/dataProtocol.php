<?php

/**
 * Project Mansystems
 * Author: Eelco
 * Date: 2-12-2017
 */


abstract class DataHandler {

    const RESPONSE_REFERENCE = "handler";
    const RESPONSE_TYPE = "handlerType";

    protected $data;
    public function __construct($data){
        $this->data = $data;
    }

    /**
     * Sends an encoded response to the client
     * @param $array Mixed response
     */
    protected function send($array){
        echo json_encode($array);
    }
}

class DataProtocol extends Stream implements IStreamResponse {

    /**
     * @var DataHandler
     */
    private $handler;
    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
        $this->handler = null;
    }

    public function onStreamRequestReceive() {
        $method = new Method($this->data);
        $handler = $method->fetch(DataHandler::RESPONSE_REFERENCE, true);
        $type = $method->fetch(DataHandler::RESPONSE_TYPE, true);
        if($handler != null && $type != null){
            $folder = _STREAM_FOLDER.'/handlers/'.strtolower($type).'/';
            if(file_exists($file = $folder.$handler.'.php')){
                /** @noinspection PhpIncludeInspection */
                require_once $file;
                $obj = ucfirst($handler);
                $this->handler = new $obj($method->getArray());
            }
        }
    }

    public function respond() {
        if($this->handler==null)return;
        /** @var $handler IStreamResponse*/
        if($this->handler instanceof IStreamResponse)
            $this->handler->respond();
    }
}