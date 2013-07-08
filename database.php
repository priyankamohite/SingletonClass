<?php
$hostname = 'localhost';
$username = 'root';
$password = 'webonise6186';
$dbname = 'test';

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
echo 'Connected to database<br />';

mysql_select_db("test");

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);


while ($rows = mysql_fetch_row($result)) {

  foreach($rows as $row){
    print_r($row);
/*
      $result_one = mysql_query("SHOW COLUMNS FROM $row");
      if (mysql_num_rows($result_one) > 0) {
          while ($row_one = mysql_fetch_assoc($result_one)) {
              print_r($row_one);
          }
      }*/

//
      $query_one = "DESCRIBE $row";
      $results_one = mysql_query($query_one);
//
      print_r( $results_one );

      while($row_one = mysql_fetch_array($results_one)) {
          echo '<pre>';
          print_r($row_one);
          echo '<br />';
      }


  }
    echo "<br />";
}

$dbh = null;
echo '<br/><br/>Connection closed';

//http://www.php.net/manual/en/function.mysql-list-tables.php