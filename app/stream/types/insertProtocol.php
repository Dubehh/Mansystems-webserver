<?php
/**
 * Project Mansystems
 * Author: Hugo
 * Date: 7-12-2017
 */

class InsertProtocol extends Stream {

    function __construct($resolver, $data) {
        parent::__construct($resolver, $data);
    }

    public function onStreamRequestReceive() {
        $method = new Method($this->data);
        $targetTable = $method->fetch("targetTable", true);
        $uid = $method->fetch("uid", true);

        if($targetTable != null){
            $handler = App::instance()->getDataSource()->getHandler();

            $playerID = $handler
                ->from(PlayerManager::TABLE)
                ->select("ID")
                ->where("UUID", $uid)
                ->fetch('ID');

            $method->set("PlayerID", $playerID);

            $handler->insertInto($targetTable)->values($method->getArray())->execute();
        }
    }
}