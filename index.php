<?php

class MyDBClass {

    private static $instance;
    private $dbh;
    private $select;
    private $from;
    private $where;
    private $limit;
    private $orderBy;
    private $groupBy;
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
            $this->select = "select ";

            foreach ($selectParameters as $selectParameter) {
                $this->select = $this->select . $selectParameter . " ,";
            }
            $this->select = substr($this->select, 0, -1);
        }
        return $this;
    }

    function from($tableNames) {

        if (!empty($tableNames)) {
            $this->from = "from ";

            foreach ($tableNames as $tableName) {
                $this->from = $this->from . $tableName . " ,";
            }
            $this->from = substr($this->from, 0, -1);
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

    function orderBy($fieldName, $order) {

        if (!empty($order) && !empty($fieldName)) {
            $this->orderBy = "ORDER BY " . $fieldName . " " . $order;
        }
        return $this;
    }

    function limit($noOfRows) {

        if (!empty($noOfRows)) {
            $this->limit = "LIMIT " . $noOfRows;
        }
        return $this;
    }

    function join($conditions){

        if (!empty($conditions)) {
             $this->where = "where ";
            foreach ($conditions as $key => $condition) {
                $this->where = $this->where. $key . "=" . $condition;
            }

        }
        return $this;

    }

    function groupBy($groupByField) {

        if (isset($groupByField)) {
            $this->groupBy = "GROUP BY " . $groupByField;
        }
        return $this;
    }


    function get() {
        $this->query = $this->select . " " . $this->from . " " . $this->where . " " . $this->orderBy . " " . $this->limit . " " . $this->groupBy . ";";
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

                foreach ($result as $key => $data) {

                    if (isset($data)) {
                        echo $key . "->" . $data . "      ";
                    }
                }
                echo "<br />";
                echo "<br />";
            }

        } else {
            echo "data not found";
        }
        return $this;
    }

    function save($tableName, $setParameters, $conditions = null) {

        if ($conditions != null) {

            $this->query = "UPDATE " . $tableName . " SET ";

            foreach ($setParameters as $key => $setParameter) {
                $this->query = $this->query . $key . " ='" . $setParameter . "',";
            }

            $this->query = substr($this->query, 0, -1) . " WHERE ";

            foreach ($conditions as $key => $condition) {
                $this->query = $this->query . $key . " ='" . $condition . "' AND ";
            }

            $this->query = substr($this->query, 0, -4) . " ;";

        } else {
            $this->query = "INSERT INTO " . $tableName . " (";

            foreach ($setParameters as $key => $setParameter) {
                $this->query = $this->query . $key . ",";
            }

            $this->query = substr($this->query, 0, -1) . ") VALUES ('";

            foreach ($setParameters as $setParameter) {
                $this->query = $this->query . $setParameter . "','";
            }

            $this->query = substr($this->query, 0, -2) . ");";
        }

        $sth = $this->dbh->prepare($this->query);
        $sth->execute();

        return $this;
    }

    function delete($tableName, $conditions = null) {

        if (isset($tableName) && isset($conditions)) {

            $this->query = "DELETE FROM " . $tableName . " WHERE ";

            foreach ($conditions as $key => $condition) {
                $this->query = $this->query . $key . " ='" . $condition . "' AND ";
            }

            $this->query = substr($this->query, 0, -4) . " ;";
        }

        $sth = $this->dbh->prepare($this->query);
        $sth->execute();

        return $this;
    }

}

$obj = MyDBClass::getInstance();

/*$obj->makeConnection()
    ->select("")
    ->from(array("users"))
    ->where("")
    ->orderBy("fname", "DESC")
    ->limit(10)
    ->get()
    ->fetchData()
    ->closeConnection();*/


/*$obj->makeConnection()
    ->save("users", array('organisation_id' => '111', 'fname' => 'Priya', 'lname' => 'Mohite', 'city' => 'Islampur'), array('fname' => 'Priyanka', 'lname' => 'Mohite'))
    ->closeConnection();*/

/*$obj->makeConnection()
    ->delete("users",array('fname' => 'fname500', 'lname' => 'lname500'))
    ->closeConnection();*/


//test cases

//List all organizations
/*$obj->makeConnection()
    ->select("")
    ->from(array('organizations'))
    ->get()
    ->fetchData()
    ->closeConnection();*/


//List 10 organization whose id is greater than 10
/*$obj->makeConnection()
    ->select("")
    ->from(array("organizations"))
    ->where(array('id >'=>11))
    ->limit(10)
    ->get()
    ->fetchData()
    ->closeConnection();*/


//List Organization whose id is greater than 10 and less than equal to 50
/*$obj->makeConnection()
    ->select("")
    ->from(array("organizations"))
    ->where(array('id >'=>11,'id <'=>50))
    ->get()
    ->fetchData()
    ->closeConnection();*/

//LIst all organization who has bee created after 2013-02-10 00:00:00
/*$obj->makeConnection()
    ->select("*")
    ->from(array("organizations"))
    ->where(array('created_on >'=>'2013-02-10 00:00:00'))
    ->get()
    ->fetchData()
    ->closeConnection();*/

//List all orders who has id between 10 to 50 and its orders should be descending by name
/*$obj->makeConnection()
    ->select("")
    ->from(array("organizations"))
    ->where(array('id >'=>10,'id <'=>50))
    ->orderBy("name", "DESC")
    ->get()
    ->fetchData()
    ->closeConnection();*/


//display informations about organization whose id is 70
/*$obj->makeConnection()
    ->select("")
    ->from(array("organizations"))
    ->where(array('id'=>'70'))
    ->get()
    ->fetchData()
    ->closeConnection();*/


//display informations about organization whose name is "Org Name 30"
/*$obj->makeConnection()
    ->select("")
    ->from(array("organizations"))
    ->where(array('name'=>'Org Name 30'))
    ->get()
    ->fetchData()
    ->closeConnection();*/


//display all the users of organization_id 30
/*$obj->makeConnection()
    ->select("")
    ->from(array("users"))
    ->where(array("organisation_id"=>30))
    ->get()
    ->fetchData()
    ->closeConnection();*/

//return a count of users per organization with organization name
/*$obj->makeConnection()
    ->select(array("organizations.name", "COUNT(users.id)"))
    ->from(array("organizations", "users"))
    ->join(array("users.organisation_id" => "organizations.id"))
    ->groupBy("organizations.name")
    ->get()
    ->fetchData()
    ->closeConnection();*/


//update users table fname = 'abc' and lname = 'xyz' of user whose id is 20
/*$obj->makeConnection()
    ->save("users", array('fname' => 'abc', 'lname' => 'xyz'), array('id' => 20))
    ->closeConnection();*/


//delete all users who lives in city "City7"
/*$obj->makeConnection()
    ->delete("users",array('city' => 'city5'))
    ->closeConnection();*/







