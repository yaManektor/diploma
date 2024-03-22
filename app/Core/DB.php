<?php

class DB
{
    private static $_db = null;
    
    public static function getInstance()
    {
        if (self::$_db == null)
            self::$_db = new PDO('mysql:host=localhost;dbname=dyplom_proj', 'root', '');

        return self::$_db;
    }
}