<?php

$server = "localhost";
$database = "gridphoria";
$username = "gridphoria";
$password = "d3f@ultpass1.";

$mysqlConnection = mysql_connect($server, $username, $password);
if (!$mysqlConnection) {
    echo "Please try later.";
} else {
    mysql_select_db($database, $mysqlConnection);
}