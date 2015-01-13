<?php
namespace ApigilityClientTest\Utils;

class FileLoader
{

    public static function loadFile($extension = 'json')
    {
        $files = glob(__DIR__.'/../Fixtures/*.'.$extension);

        $file = $files[rand(0 , sizeof($files) - 1)];

        return $file;
    }

}
