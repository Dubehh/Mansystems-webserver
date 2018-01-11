<?php
/**
 * Project Mansystems
 * Author: Eelco & Hugo
 * Date: 23-11-2017
 */

class FinderProfiles extends DataHandler implements IStreamResponse{

    const TABLE_NAME = "module_finder";

    function __construct($data) {
        parent::__construct($data);
    }

    public function respond() {
        $response = array();
        $playerTable = PlayerManager::TABLE;
        $data = App::instance()->getDataSource()->getHandler()
            ->from(self::TABLE_NAME)
            ->innerJoin("$playerTable ON " . FinderProfiles::TABLE_NAME . ".playerid = $playerTable.id")
            ->select("$playerTable.uuid");

        $folder = $_SERVER['DOCUMENT_ROOT'].'/upload/finder/';
        $index = 0;
        foreach ($data->getIterator() as $row) {
            $response[$index] = $row;
            $path = $folder.$row['uuid'].'/';
            $response[$index]['pictures'] = array_diff(scandir($path), array('.', '..'));
            $index++;
        }
        $this->send($response);
    }
} 