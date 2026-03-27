<?php

class RefreshService
{
    public static $base = __DIR__ ;

    public static function LoadIndex()
    {
        header("Location: " . self::$base . "/../../index.php");
        exit();
    }

    public static function LoadBattle()
    {

    }
}

?>