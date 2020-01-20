<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/17/2020
 * Time: 11:36 AM
 */

require_once 'db-connection/DBConnection.php';

try {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $librarianSQL = "SELECT * FROM librarian where username='$username'";

    $result = $connection->query($librarianSQL);

    $currentUsername = "";
    $currentPassword = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $currentUsername = $row["username"];
            $currentPassword = $row["password"];
        }

        if ($password == $currentPassword) {
            echo "Granted";
        } else {
            echo "Incorrect Password";
        }
    } else {
        echo "Incorrect Username";
    }
}catch (Exception $e){
    echo $e->getMessage();
}