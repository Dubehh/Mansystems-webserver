<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

class Response extends Stream implements IStreamResponse {

    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
    }

    public function onStreamRequestReceive() {

    }

    public function respond() {
        echo json_encode(array(
            "a" => ["b" => 1, "c" => 2],
            "b" => 2
        ));
    }

}