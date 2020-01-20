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
</head>
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 460px;
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

    .nav-item {
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
            <li class="nav-item active">
                <a class="nav-link" href="book.php">Book <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php">Reader</a>
            </li>
        </ul>

    </div>
</nav>

<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="search">Search Books</label>
                        <input class="form-control form-control-sm" type="text" name="search"
                               id="search">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="bookCategorySearch">Book Category</label>
                        <select class="form-control form-control-sm" id="bookCategorySearch"
                                onchange="getBooksForCategory(this.value)">
                            <option>All</option>
                            <?php

                            $sql = "SELECT * FROM BookCategory";

                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option><?php echo $row["category_name"] ?></option>
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="authorSearch">Author</label>
                        <select class="form-control form-control-sm" id="authorSearch"
                                onchange="getBooksForAuthor(this.value)">
                            <option>All</option>
                            <?php

                            $sql = "SELECT DISTINCT author FROM book ORDER BY author";

                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option><?php echo $row["author"] ?></option>
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Book Details</p>
            </div>
            <div class="card-body">
                <form id="bookForm">
                    <div class="form-group">
                        <label for="referenceNumber">Reference Number</label>
                        <input type="text" class="form-control form-control-sm" name="reference_number"
                               id="referenceNumber">
                    </div>
                    <div class="form-group">
                        <label for="bookCategory">Book Category</label>
                        <select class="form-control" id="bookCategory" name="bookCategory">
                            <?php

                            $sql = "SELECT * FROM BookCategory";

                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option><?php echo $row["category_name"] ?></option>
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Book Title</label>
                        <input type="text" class="form-control form-control-sm" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control form-control-sm" name="author" id="author">
                    </div>
                    <button type="button" class="btn btn-primary" id="save">Save</button>
                    <button type="button" class="btn btn-warning" id="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-bordered" id="bookTable">
                        <thead>
                        <tr>
                            <th>Reference number</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php

                        $sql = "SELECT * FROM Book ORDER By added_date DESC";

                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <?php if ($row["Availability"] === '1') { ?>
                                    <tr onclick="getData(this)">
                                <?php } else {
                                    ?>
                                    <tr style="color: red" onclick="getData(this)">
                                    <?php
                                } ?>
                                <td><?php echo $row["reference_number"] ?></td>
                                <td><?php echo $row["category_name"] ?></td>
                                <td><?php echo $row["title"] ?></td>
                                <td><?php echo $row["author"] ?></td>
                                <td><?php echo $row["added_date"] ?></td>
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
<script src="js/book.js"></script>
<script rel="script" src="js/bootstrap.min.js"></script>
<script rel="script" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
