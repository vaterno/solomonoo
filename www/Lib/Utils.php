<?php

namespace Lib;

class Utils
{
    public static function env($env, $default = null)
    {
        static $lines = null;

        if (empty($lines)) {
            $lines = file(ROOT . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }

        foreach ($lines as $line) {
            list($key, $value) = explode('=', $line, 2);

            if ($key === $env) {
                return $value;
            }
        }

        return $default;
    }
}
