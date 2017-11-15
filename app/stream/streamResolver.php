<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 14-11-2017
 */

class StreamResolver {

    const STREAM_DEFINITION_KEY = "streamType";

    private $post;
    public function __construct($post){
        $this->post = $post;
    }

    public function fetch($key, $delete = true){
        $rtn = array_key_exists($key, $this->post) ? $this->post[$key] : null;
        if($delete && $rtn != null){
            unset($this->post[$key]);
            array_values($this->post);
        }
        return $rtn;
    }

    public function resolve(){
        $type = $this->fetch(self::STREAM_DEFINITION_KEY);
        if($type != null){
            /** @var $stream Stream*/
            $stream = new $type($this, $this->post);
            $stream->onStreamRequestReceive();
            /** @var $stream IStreamResponse*/
            if($stream instanceof IStreamResponse)
                $stream->respond();
        }
    }
} 