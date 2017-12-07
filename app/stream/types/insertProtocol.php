<?php
/**
 * Created by PhpStorm.
 * User: hugok
 * Date: 7-12-2017
 * Time: 10:42
 */

class InsertProtocol extends Stream {

    private $method;
    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
    }

    public function onStreamRequestReceive() {
        $method = new Method($this->data);
        $targetTable = $method->fetch("targetTable", true);


        if($targetTable != null){
            $handler = App::instance()->getDataSource()->getHandler();
            $handler->insertInto($targetTable)->values($method->getArray())->execute();
        }
    }
}