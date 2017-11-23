<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 23-11-2017
 */

abstract class ResponseHandler {

    const RESPONSE_REFERENCE = "responseHandler";

    protected $data;
    public function __construct($data){
        $this->data = $data;
    }

    public abstract function respond();

    protected function send($array){
        echo json_encode($array);
    }
} 