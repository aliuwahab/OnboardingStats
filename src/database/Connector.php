<?php


class Connector
{

    public static function make()
    {
        try {
            return new PDO('mysql:dbname=test;host=localhost');
        } catch (Exception $exception) {
            var_dump($exception->getMessage()); exit();
        }
    }
}