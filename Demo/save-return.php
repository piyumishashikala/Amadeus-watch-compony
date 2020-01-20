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

    $getBookId = "SELECT book_id FROM Book WHERE reference_number='$referenceNumber'";
    $bookResult = $connection->query($getBookId);

    $bookID = "";

    if ($bookResult->num_rows > 0) {
        while ($row = $bookResult->fetch_assoc()) {
            $bookID = $row["book_id"];
        }
    }

    $getUserId = "SELECT user_id FROM User WHERE email='$email'";
    $userResult = $connection->query($getUserId);

    $userId = "";

    if ($userResult->num_rows > 0) {
        while ($row = $userResult->fetch_assoc()) {
            $userId = $row["user_id"];
        }
    }


    $getLend = "SELECT * FROM IssueBook WHERE user_id='$userId' AND book_id='$bookID' AND lend_date='$dateOfLend'";
    $issueResult = $connection->query($getLend);

    $issueId = "";

    if ($issueResult->num_rows > 0) {
        while ($row = $issueResult->fetch_assoc()) {
            $issueId = $row["issue_id"];
        }
    }

    $date=date("l jS \of F Y");

    $bookSql = "UPDATE Book set Availability=true WHERE book_id='$bookID'";
    $returnSql = "UPDATE IssueBook SET returned=true, returned_date='$date' WHERE issue_id=$issueId";

    $connection->query($bookSql);
    $connection->query($returnSql);

    $connection->commit();

} catch (Exception $e) {

    $connection->rollback();
}


