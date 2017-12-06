<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 2-12-2017
 * Time: 16:33
 */

abstract class ResponseHandler {

    const RESPONSE_REFERENCE = "responseHandler";

    protected $data;
    public function __construct($data){
        $this->data = $data;
    }

    public abstract function respond();

    /**
     * Sends an encoded response to the client
     * @param $array Mixed response
     */
    protected function send($array){
        echo json_encode($array);
    }
}

class FetchProtocol extends Stream implements IStreamResponse {

    /**
     * @var ResponseHandler
     */
    private $handler;
    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
        $this->handler = null;
    }

    public function onStreamRequestReceive() {
        $method = new Method($this->data);
        $handlerType = $method->fetch(ResponseHandler::RESPONSE_REFERENCE, true, null);
        if($handlerType != null){
            $folder = _STREAM_FOLDER.'/handlers/';
            $file = $handlerType.'Response';
            if(file_exists($folder.$file.'.php')){
                require_once $folder.$file.'.php';
                $obj = ucfirst($file);
                $this->handler = new $obj($method->getArray());
            }
        }
    }

    public function respond() {
        if($this->handler!=null)
            $this->handler->respond();
    }
}