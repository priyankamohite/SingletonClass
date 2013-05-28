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

    function select($select){

        if(empty($select) || $select==NULL){

            $select = "*";
        }

        return $select;

    }

    function from($from){

        return $from;

    }


    function fetchdata($dbh,$mode)
    {

        $queryStatement = "select ". MyDBClass::select("*"). " from ".MyDBClass::from("users").";";

        $sth = $dbh->prepare($queryStatement);
        $sth->execute();

        $results = $sth->fetchAll($mode);

        if(!empty($results)){

            foreach($results as $result)
            {
//                                echo $result['id']."    ".$result['organisation_id']."    ".$result['fname']."    ".$result['lname']."  ".$result['city']."<br/>";
                echo $result['fname']."<br/>";
            }

            print("\n");

        }else{
            echo "data not found";
            print("\n");
        }


    }

}

$obj=MyDBClass::getInstance();
$dbh= $obj->makeConnection();

$mode=PDO::FETCH_ASSOC;
$obj->fetchdata($dbh,$mode);

$obj->closeConnection();