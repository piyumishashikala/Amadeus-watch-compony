<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/17/2020
 * Time: 4:49 PM
 */

require_once 'db-connection/DBConnection.php';

$numberOfBooks = "";
$numberOfUsers = "";
$numberOfAuthors = "";
$numberOfLends = "";

$bookSql = "SELECT COUNT(*) FROM Book";
$userSql = "SELECT COUNT(*) FROM User";
$authorSql = "SELECT COUNT(DISTINCT author) FROM Book";
$lendSql = "SELECT COUNT(*) FROM IssueBook";

$books = $connection->query($bookSql);
if ($books->num_rows > 0) {
    // output data of each row
    while ($row = $books->fetch_assoc()) {
        $numberOfBooks=$row["COUNT(*)"];
    }
}

$users = $connection->query($userSql);
if ($users->num_rows > 0) {
    // output data of each row
    while ($row = $users->fetch_assoc()) {
        $numberOfUsers=$row["COUNT(*)"];
    }
}

$authors = $connection->query($authorSql);
if ($authors->num_rows > 0) {
    // output data of each row
    while ($row = $authors->fetch_assoc()) {
        $numberOfAuthors=$row["COUNT(DISTINCT author)"];
    }
}

$lends = $connection->query($lendSql);
if ($lends->num_rows > 0) {
    // output data of each row
    while ($row = $lends->fetch_assoc()) {
        $numberOfLends=$row["COUNT(*)"];
    }
}

$data = array("books" => $numberOfBooks,
    "users" => $numberOfUsers,
    "authors" => $numberOfAuthors,
    "lends" => $numberOfLends);

echo json_encode($data);
