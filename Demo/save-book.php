<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 12:23 PM
 */

require_once 'db-connection/DBConnection.php';

$referenceNumber=$_POST["reference_number"];
$bookCategory=$_POST["bookCategory"];
$title=$_POST["title"];
$author=$_POST["author"];

$sql = "INSERT INTO Book (reference_number,category_name,title,author,Availability) values ('$referenceNumber','$bookCategory','$title','$author',true )";

$connection->query($sql);


