<?php

class MyDBClass{

    private static $instance;

    private function __construct(){

    }

    public static function getInstance(){
        if(!self::$instance){

            self::$instance = new MyDBClass();
        }

        return self::$instance;
    }

    function makeConnection()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'webonise6186';

        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=test", $username, $password);
                        echo 'Connected to database<br />';
            return $dbh;
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function closeConnection()
    {
        $dbh=null;
                echo "Connection closed<br />";
    }
}


$obj=MyDBClass::getInstance();
$dbh= $obj->makeConnection();

$obj->closeConnection();