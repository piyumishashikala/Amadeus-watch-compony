<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 12:23 PM
 */

require_once 'db-connection/DBConnection.php';

$referenceNumber = $_POST["reference_number"];
$title = $_POST["title"];
$author = $_POST["author"];
$bookCategory = $_POST["bookCategory"];

//$get = "SELECT * from Book WHERE reference_number='$referenceNumber'";
//$result = $connection->query($get);
//
//$bookId = "";
//if ($result->num_rows > 0) {
//    while ($row = $result->fetch_assoc()) {
//        $bookId = "$row[book_id]";
//    }
//}

$sql = "update book set title='$title', category_name='$bookCategory', author='$author' where reference_number='$referenceNumber'";

$connection->query($sql);


