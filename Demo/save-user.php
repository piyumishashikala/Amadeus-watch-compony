<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 12:23 PM
 */

require_once 'db-connection/DBConnection.php';

$email=$_POST["email"];
$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];
$postalAddress=$_POST["postalAddress"];
$contactNumber=$_POST["contactNumber"];

$sql = "INSERT INTO User (email,first_name,last_name,address,contact_number) values ('$email','$firstName','$lastName','$postalAddress','$contactNumber')";

$connection->query($sql);


