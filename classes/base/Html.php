<?php

namespace classes\base;

class Html {
    public static function encode ($string) {
        return strip_tags(htmlspecialchars($string));
    }
}