<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 10/7/13
 * Time: 3:56 PM
 * To change this template use File | Settings | File Templates.
 */

include("newdb.php");

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "webonise6186";
$mysql_database = "test";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
    or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");



$organisation_id='9lessons';
$fname='Srinivas Tamada';
$lname = 'as';
$city='lnlik';

$sql=mysqli_query($connect,
    "CALL insert('$username','$name')");

$sql = mysql_query($conn);