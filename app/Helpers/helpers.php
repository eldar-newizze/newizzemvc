<?php
if (!function_exists('env')) {
    function env($param)
    {
        if (isset($_ENV[$param])) {
            return $_ENV[$param];
        }
    }
}

if (!function_exists('basePath')) {
    function basePath($file = '')
    {
        return __DIR__.'../../'.$file;
    }
}

if (!function_exists('publicPath')) {
    function publicPath($file = '')
    {
        return basePath().'public/'.$file;
    }
}
