<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

class Request extends Stream {

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