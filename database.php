<?php

$dbname = 'test';

mysql_select_db($dbname);

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);


while ($rows = mysql_fetch_row($result)) {

  foreach($rows as $row){
    print_r($row);

      $query_one = "DESCRIBE $row";
      $results_one = mysql_query($query_one);

      while($row_one = mysql_fetch_array($results_one)) {
          echo '<pre>';
          print_r($row_one);
          echo '<br />';
      }
  }
    echo "<br />";
}

//http://www.php.net/manual/en/function.mysql-list-tables.php