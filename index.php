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

        //        echo  $this->where;
        //        die();
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


    function get() {

        $this->query = $this->select . " " . $this->from . " " . $this->where . " " . $this->orderBy . " " . $this->limit . ";";
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

    function join() {
        /*SELECT users . fname,organizations . id
         FROM users
         INNER JOIN organizations
         ON users . organisation_id = organizations . id
         AND organizations . id = 30;*/
    }

}

$obj = MyDBClass::getInstance();

/*$obj->makeConnection()
    ->select("*")
    ->from("users")
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
    ->select("*")
    ->from('organizations')
    ->get()
    ->fetchData()
    ->closeConnection();*/


//List 10 organization whose id is greater than 10
/*$obj->makeConnection()
    ->select("*")
    ->from("organizations")
    ->where(array('id >'=>11))
    ->limit(10)
    ->get()
    ->fetchData()
    ->closeConnection();*/


//List Organization whose id is greater than 10 and less than equal to 50
/*$obj->makeConnection()
    ->select("*")
    ->from("organizations")
    ->where(array('id >'=>11,'id <'=>50))
    ->get()
    ->fetchData()
    ->closeConnection();*/

//LIst all organization who has bee created after 2013-02-10 00:00:00
/*$obj->makeConnection()
    ->select("*")
    ->from("organizations")
    ->where(array('created_on >'=>'2013-02-10 00:00:00'))
    ->get()
    ->fetchData()
    ->closeConnection();*/

//List all orders who has id between 10 to 50 and its orders should be descending by name
/*$obj->makeConnection()
    ->select("*")
    ->from("organizations")
    ->where(array('id >'=>10,'id <'=>50))
    ->orderBy("name", "DESC")
    ->get()
    ->fetchData()
    ->closeConnection();*/


//display informations about organization whose id is 70
/*$obj->makeConnection()
    ->select("*")
    ->from("organizations")
    ->where(array('id'=>'70'))
    ->get()
    ->fetchData()
    ->closeConnection();*/


//display informations about organization whose name is "Org Name 30"
/*$obj->makeConnection()
    ->select("*")
    ->from("organizations")
    ->where(array('name'=>'Org Name 30'))
    ->get()
    ->fetchData()
    ->closeConnection();*/


//display all the users of organization_id 30
//return a count of users per organization with organization name


//update users table fname = 'abc' and lname = 'xyz' of user whose id is 20
/*$obj->makeConnection()
    ->save("users", array('fname' => 'abc', 'lname' => 'xyz'), array('id' => 20))
    ->closeConnection();*/


//delete all users who lives in city "City7"
/*$obj->makeConnection()
    ->delete("users",array('city' => 'city5'))
    ->closeConnection();*/







