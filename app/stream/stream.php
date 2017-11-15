<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

interface IStreamResponse {
    public function respond();
}

abstract class Stream{

    protected $resolver;
    protected $data;

    public function __construct($resolver, $data){
        $this->resolver = $resolver;
        $this->data = $data;
    }

    public abstract function onStreamRequestReceive();
}