<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 12:14 PM
 */

require_once 'db-connection/DBConnection.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <title>Book</title>
</head>q
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 580px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .row {
        margin: 0;
        padding: 0.5%;
    }

    .card-header {
        /*height: 6px;*/
        padding: 10px;
    }

    .nav-item{
        margin-left: 100px;
    }

    @media (max-width: 990px) and (min-width: 320px) {
        .nav-item {
            margin-left: 0;
        }
    }
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="images/logo.png" width="120px">
    <a class="navbar-brand" href="#">Library Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="lend-book.php">Lend Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="book.php">Book</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="user.php">Reader <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Search Readers</p>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="userSearch">Type to search</label>
                        <input class="form-control form-control-sm" type="text" name="userSearch"
                               id="userSearch">
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <p class="card-title">Reader Details</p>
            </div>
            <div class="card-body">
                <form id="userFrom">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" class="form-control form-control-sm" name="email" id="email">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control form-control-sm" name="firstName" id="firstName">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control form-control-sm" name="lastName" id="lastName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postalAddress">Postal Address</label>
                        <input type="text" class="form-control form-control-sm" name="postalAddress" id="postalAddress">
                    </div>
                    <div class="form-group">
                        <label for="contactNumber">Contact Number</label>
                        <input type="text" class="form-control form-control-sm" name="contactNumber" id="contactNumber">
                    </div>
                    <button type="button" class="btn btn-primary" id="userSave">Save</button>
                    <button type="button" class="btn btn-warning" id="userReset">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-bordered" id="userTable">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Postal Address</th>
                            <th>Contact Number</th>
                            <th>Registered date</th>
                        </tr>
                        </thead>
                        <tbody id="userTableBody">
                        <?php

                        $sql = "SELECT * FROM User ORDER By reg_date DESC";

                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr onclick="getData(this)">
                                    <td><?php echo $row["email"] ?></td>
                                    <td><?php echo $row["first_name"] ?></td>
                                    <td><?php echo $row["last_name"] ?></td>
                                    <td><?php echo $row["address"] ?></td>
                                    <td><?php echo $row["contact_number"] ?></td>
                                    <td><?php echo $row["reg_date"] ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/user.js"></script>
<script rel="script" src="js/bootstrap.min.js"></script>
<script rel="script" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
