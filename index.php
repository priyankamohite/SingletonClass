<?php

class MyClass
{
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

    function fetchdata($dbh,$mode)
    {

        $sth = $dbh->prepare("select * from users");
        $sth->execute();

        $results = $sth->fetchAll($mode);

        if(!empty($results)){

             foreach($results as $result)
            {
                echo $result['id']."    ".$result['organisation_id']."    ".$result['fname']."    ".$result['lname']."  ".$result['city']."<br/>";
            }

            print("\n");

        }else{
            echo "data not found";
            print("\n");
        }


    }

}

$obj=new MyClass();
$dbh= $obj->makeConnection();

$mode=PDO::FETCH_ASSOC;
$obj->fetchdata($dbh,$mode);

$obj->closeConnection();




?>
