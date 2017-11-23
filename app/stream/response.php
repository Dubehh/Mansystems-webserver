<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

class Response extends Stream implements IStreamResponse {
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