<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 11:37 AM
 */


$serverName = "localhost";
$username = "root";
$password = "1234";

$connection = mysqli_connect($serverName, $username, $password);

if (!$connection) {
    die("Connection failed : " . mysqli_connect_error());
}

$connection->query("USE lms");

return $connection;