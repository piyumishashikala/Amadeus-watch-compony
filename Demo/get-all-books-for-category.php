<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 9:51 PM
 */

require_once "db-connection/DBConnection.php";

$category = $_POST['category'];

if ($category == "All") {

    $sql = "SELECT * FROM Book ORDER By added_date DESC;";

    $result = $connection->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);

} else if ($category == "CURRENT") {

    $sql = "SELECT * FROM Book WHERE Availability=TRUE ORDER By added_date DESC;";

    $result = $connection->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);

} else {

    $sql = "SELECT * FROM Book WHERE category_name='$category' ORDER By added_date DESC;";

    $result = $connection->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);

}
