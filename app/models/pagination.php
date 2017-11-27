<?php

/**
 * Created by PhpStorm.
 * User: Eelco
 * Date: 27-11-2017
 * Time: 16:58
 */
class Pagination {

    const REFERENCE_POINTER = "page";

    private $hasPrevious;
    private
        $previous,
        $current,
        $next;

    private $url;
    public function __construct(){
        $this->url = $_GET['url'];
        $val = isset($_GET[self::REFERENCE_POINTER]) ? $_GET[self::REFERENCE_POINTER] : 1;
        $this->current = ($int = intval($val)) >= 1 ? $int : 1;
        $this->next = $this->current+1;
        $this->previous = $this->current-1;
        $this->hasPrevious = $this->current > 1;
    }

    public function hasPrevious(){
        return $this->hasPrevious;
    }

    public function getCurrent(){
        return $this->current;
    }

    public function getNext(){
        return $this->next;
    }

    public function getPrevious(){
        return $this->previous;
    }

    public function getURLTowards($number){
        $prefix = "http://" . $_SERVER['SERVER_NAME'];
        return $prefix.'/'.$this->url.'?'.self::REFERENCE_POINTER.'='.$number;
    }
}