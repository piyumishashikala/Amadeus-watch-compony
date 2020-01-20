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

//$get = "SELECT * from Book WHERE reference_number='$referenceNumber'";
//$result = $connection->query($get);
//
//$bookId = "";
//if ($result->num_rows > 0) {
//    while ($row = $result->fetch_assoc()) {
//        $bookId = "$row[book_id]";
//    }
//}

$sql = "update user set first_name ='$firstName', last_name ='$lastName',address ='$postalAddress',contact_number ='$contactNumber' where email='$email'";

$connection->query($sql);


