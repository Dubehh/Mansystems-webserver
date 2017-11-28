<?php
/**
 * Project Mansystems
 * Author: Eelco & Hugo
 * Date: 23-11-2017
 */

class MillionaireResponse extends ResponseHandler {

    const TABLE_NAME = "module_millionaire";

    function __construct($data) {
        parent::__construct($data);
    }

    public function respond() {
        $response = array();
        for ($i = 3; $i > 0; $i--) {
            $response[$i] = [];
            $data = App::instance()->getDataSource()->getHandler()
                ->from(self::TABLE_NAME)
                ->where("Difficulty", $i)
                ->orderBy("rand()")
                ->limit(5);
            $questionID = 0;
            foreach($data->getIterator() as $row){
                $response[$i][$questionID++] = [
                    "question"=> $row['Question'],
                    "correct" => $row['CorrectAnswer'],
                    "wrong1" => $row['WrongAnswer1'],
                    "wrong2" => $row['WrongAnswer2'],
                    "wrong3" => $row['WrongAnswer3'],
                    "difficulty" => $row['Difficulty']
                ];
            }
        }

        $this->send($response);
    }
} 