<?php

namespace App;


class Console
{
    public static function writeLine(string $message): void
    {
        echo "\n $message \n";
    }
}