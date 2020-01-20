<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 12:23 PM
 */

require_once 'db-connection/DBConnection.php';

$referenceNumber = $_POST['referenceNumber'];
$email = $_POST['email'];
$dateOfLend = $_POST['dateOfLend'];
$dateOfReturn = $_POST['dateOfReturn'];

try {
    $connection->begin_transaction();

    $getBookId = "SELECT * FROM Book WHERE reference_number='$referenceNumber'";
    $bookResult = $connection->query($getBookId);

    $bookID = "";

    if ($bookResult->num_rows > 0) {
        while ($bookRow = $bookResult->fetch_assoc()) {
            $bookID = $bookRow["book_id"];
        }
    }

    $getUserId = "SELECT * FROM User WHERE email='$email'";
    $userResult = $connection->query($getUserId);

    $userId = "";

    if ($userResult->num_rows > 0) {
        while ($userRow = $userResult->fetch_assoc()) {
            $userId = $userRow["user_id"];
        }
    }
    $bookSql = "UPDATE Book set Availability=false WHERE book_id='$bookID'";
    $issueSql = "INSERT INTO IssueBook (user_id,book_id,lend_date,return_date,returned) values ('$userId','$bookID','$dateOfLend','$dateOfReturn',false)";

    $connection->query($bookSql);
    $connection->query($issueSql);

    $connection->commit();
} catch (Exception $e) {

    $connection->rollback();
}
