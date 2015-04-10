<?php

class DBMapper {

    public static $database;

    public static function init($database) {
	self::$database = $database;
    }

}
