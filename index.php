<?php

class MyDBClass {


    private static $instance;
    private $dbh;
    private $select;
    private $from;
    private $where;
    private $limit;
    private $orderBy;
    private $query;


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
            $this->dbh = new PDO("mysql:host=$hostname;dbname=test", $username, $password);
            echo 'Connected to database<br />';

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this;

    }

    function closeConnection() {
        $this->dbh = null;
        echo "Connection closed<br />";
    }

    function select($selectParameters) {

        if (empty($selectParameters) || $selectParameters == NULL) {
            $this->select = "select *";
        } else {
            $this->select = "select " . $selectParameters;
        }

        return $this;
    }

    function from($tableName) {

        if (!empty($tableName)) {

            $this->from = "from " . $tableName;

        } else {
            echo "please give table name";
            die();
        }

        return $this;
    }

    function where($conditions) {

        $wherecondition = NULL;

        if (!empty($conditions)) {

            foreach ($conditions as $key => $condition) {

                $wherecondition = $wherecondition . " " . $key . "='" . $condition . "' AND ";
            }

            $this->where = "where " . substr($wherecondition, 0, -4);
        }

        return $this;
    }

    function orderBy($fieldName,$order) {

        if(!empty($order) && !empty($fieldName)){
            $this->orderBy = "ORDER BY ".$fieldName." ".$order;
        }
        return $this;
    }

    function limit($noOfRows){

        if(!empty($noOfRows)){
            $this->limit= "LIMIT ".$noOfRows;
        }

        return $this;
    }


    function get() {

        $this->query = $this->select . " " . $this->from . " " . $this->where ." ".$this->orderBy." ".$this->limit. ";";
        //        SELECT * FROM users ORDER BY fname DESC LIMIT 10;
        return $this;

    }

    function query() {

        return $this;

    }

    function fetchData() {

        $sth = $this->dbh->prepare($this->query);
        $sth->execute();

        $results = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {

            foreach ($results as $result) {

                if (isset($result['organisation_id'])) {
                    echo $result['organisation_id'] . " ";
                }
                if (isset($result['fname'])) {
                    echo  $result['fname'] . "    ";
                }
                if (isset($result['lname'])) {
                    echo $result['lname'] . " ";
                }
                if (isset($result['city'])) {
                    echo $result['city'] . "   ";
                }
                echo "<br />";
            }

        } else {
            echo "data not found";
        }

        return $this;
    }

    function save() {

    }

    function delete() {

    }

}

$obj = MyDBClass::getInstance();


$obj->makeConnection()
    ->select("*")
    ->from("users")
    ->where("")
    ->orderBy("fname","DESC")
    ->limit(10)
    ->get()
    ->fetchData()
    ->closeConnection();








