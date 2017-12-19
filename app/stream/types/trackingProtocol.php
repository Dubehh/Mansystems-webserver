<?php

/**
 * Project Mansystems
 * Author: Eelco
 * Date: 2-12-2017
 */

class TrackingProtocol extends Stream {

    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
    }

    public function onStreamRequestReceive() {
        $method  = new Method($this->data);
        $request = new TrackingRequest(App::instance()->getDataSource(), $method);
        $request->load();
        $request->update();
    }
}