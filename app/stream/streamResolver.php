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

    public function resolve(){
        $method = new Method($this->post);
        $type = $method->fetch(self::STREAM_DEFINITION_KEY, true, null);
        if($type != null){
            $type = ucfirst($type).'Protocol';
            /** @var $stream Stream*/
            $stream = new $type($this, $method->getArray());
            $stream->onStreamRequestReceive();
            /** @var $stream IStreamResponse*/
            if($stream instanceof IStreamResponse)
                $stream->respond();
        }
    }
} 