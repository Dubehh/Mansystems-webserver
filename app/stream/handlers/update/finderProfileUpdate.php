<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 19-12-2017
 */

class FinderProfileInsert extends DataHandler{

    function __construct($data) {
        $method = new Method($data);
        $targetTable = $method->fetch("targetTable", true);
        $uid = $method->fetch("uid", true);

        if($targetTable != null){
            $handler = App::instance()->getDataSource()->getHandler();
            $playerID = $handler
                ->from(PlayerManager::TABLE)
                ->select("ID")
                ->where("UUID", $uid)
                ->fetch('ID');

            $handler->update($targetTable)->set($method->getArray())->where("PlayerID", $playerID)->execute();
        }
    }
} 