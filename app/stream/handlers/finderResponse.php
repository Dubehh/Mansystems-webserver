<?php
/**
 * Project Mansystems
 * Author: Eelco & Hugo
 * Date: 23-11-2017
 */

class FinderResponse extends ResponseHandler {

    const TABLE_NAME = "module_finder";

    function __construct($data) {
        parent::__construct($data);
    }

    public function respond() {
        $response = array();
        $data = App::instance()->getDataSource()->getHandler()
            ->from(self::TABLE_NAME);

        $index = 0;
        foreach ($data->getIterator() as $row) {

            $response[$index] = [
                "name" => $row['Name'],
                "description" => $row['Description'],
            ];
            $index++;
        }
        $this->send($response);
    }
} 