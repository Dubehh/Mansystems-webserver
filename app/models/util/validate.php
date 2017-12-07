<?php
/**
 * Project Mansystems
 * Author: Eelco
 * Date: 6-12-2017
 */

final class Validate {

    public static function notNull($obj){
        return isset($obj) && $obj != null;
    }
} 