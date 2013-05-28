<?php

class MyDBClass {

    private static $instance;

    private function __construct() {

    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new MyDBClass();
        }
        return self::$instance;
    }

    function makeConnection() {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'webonise6186';

        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=test", $username, $password);
//            echo 'Connected to database<br />';
            return $dbh;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function closeConnection() {
        $dbh = null;
//        echo "Connection closed<br />";
    }

    function select($select) {

        if (empty($select) || $select == NULL) {

            $select = "*";
        }
        return $select;
    }

    function from($from) {
        return $from;
    }

    function where($conditions){

        $wherecondition =NULL;

        foreach($conditions as $key=>$condition){

            $wherecondition =  $wherecondition." ".$key ."='".$condition."' AND ";
        }

        return substr($wherecondition, 0, -4);
    }



    function fetchdata($dbh) {

        $conditions= array('fname'=>'fname9','city'=>'City3');

        $queryStatement = "select " . MyDBClass::select("*") . " from " . MyDBClass::from("users") ." where ".MyDBClass::where($conditions). ";";

//        echo $queryStatement;

        $sth = $dbh->prepare($queryStatement);
        $sth->execute();

        $results = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {

            foreach ($results as $result) {

                if(isset($result['organisation_id'])){echo $result['organisation_id']." ";}
                if(isset($result['fname'])){echo  $result['fname']."    ";}
                if(isset($result['lname'])){echo $result['lname']." ";}
                if(isset($result['city'])){echo $result['city']."   ";}
                echo "<br />";
            }

        } else {
            echo "data not found";
        }
    }

}

$obj = MyDBClass::getInstance();
$dbh = $obj->makeConnection();

$obj->fetchdata($dbh);

$obj->closeConnection();