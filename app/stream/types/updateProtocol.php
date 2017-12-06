<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 2-12-2017
 * Time: 16:33
 */
class UpdateProtocol extends Stream {

    private $method;
    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
    }

    public function onStreamRequestReceive() {
        $this->method = new Method($this->data);
        $request = new TrackingRequest(App::instance()->getDataSource(), $this->method);
        $request->load();
        $request->update();
    }
}