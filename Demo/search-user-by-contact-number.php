<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 9:51 PM
 */

require_once "db-connection/DBConnection.php";

$contactNo = $_POST['contactNo'];


//$sql = "SELECT * FROM Book WHERE reference_number LIKE '%$text%' ORDER By added_date DESC";
$sql = "SELECT * FROM User WHERE contact_number = '$contactNo';";

$result = $connection->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
