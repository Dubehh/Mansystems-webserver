<?php
/**
 * Project Mansystems
 * Author: Hugo
 * Date: 19-12-2017
 */

class FinderProfileUpdate extends DataHandler {

    function __construct($data) {
        $method = new Method($data);
        $targetTable = "module_finder";
        $name = $method->fetch("name", true);
        $uid = $method->fetch("uid", true);
        $player = App::instance()->getPlayerManager()->create($name, $uid);

        if ($targetTable != null) {
            $handler = App::instance()->getDataSource()->getHandler();
            $playerID = $player->getID();

            $action = strtolower($method->fetch("action", true));
            if ($action == "insert") {
                $method->set("PlayerID", $playerID);
                $handler->insertInto($targetTable)->values($method->getArray())->execute();
            } else if ($action == "update")
                $handler->update($targetTable)->set($method->getArray())->where("PlayerID", $playerID)->execute();
            else {
                // Delete
            }
        }
    }
} 