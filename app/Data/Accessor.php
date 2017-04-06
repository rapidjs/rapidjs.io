<?php

namespace App\Data;

class Accessor {

    public static function dir() {
        return base_path('data');
    }

    public static function fileName ($name) {
        return self::dir() . '/' . $name . '.php';
    }

    public static function get ($key) {

        $data = [];

        if (!$key) {
            return null;
        }

        if (file_exists(self::fileName($key))) {
            $data = require(self::fileName($key)); //collect(json_decode(file(self::fileName($key))))->toArray();
        }

        return $data;
    }
}
