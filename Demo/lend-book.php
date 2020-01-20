<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/10/2020
 * Time: 10:06 AM
 */

require_once "db-connection/DBConnection.php";
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

    .input-group-text{
        color: #0056b3;
    }

    .row{
        margin-left: 0;
        margin-right: 0;
        padding: 0.5%;
    }
    p {
        margin-top: 5px;
        margin-bottom: 0;
    }

    .my-custom-scrollbar {
        position: relative;
        height: 580px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .card-header {
        /*height: 6px;*/
        padding: 10px;
    }

    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        display: inline-block;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9;
    }

    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
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
                <a class="nav-link active" href="lend-book.php">Lend Book <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="book.php">Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php">Reader</a>
            </li>
        </ul>

    </div>
</nav>
<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">
                <p>Book Details</p>
                <form autocomplete="off" id="bookIssueBookForm">

                    <div class="form-row">
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Ref: Number</span>
                                </div>
                                <input type="text" class="form-control autocomplete"
                                       name="book_issue-reference_number"
                                       id="bookIssueReferenceNumber">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category</span>
                                </div>
                                <input type="text" class="form-control"
                                       name="book_issue-book-category"
                                       id="bookIssueBookCategory">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</span>
                                </div>
                                <input type="text" class="form-control" name="title"
                                       id="bookIssueBookTitle">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Author</span>
                                </div>
                                <input type="text" class="form-control"
                                       name="book-issue-author"
                                       id="bookIssueAuthor">
                            </div>
                        </div>
                    </div>

                    <!--                    <button type="reset" class="btn btn-warning"-->
                    <!--                            onclick="changeBookFieldsReadOnly(false)">Reset-->
                    <!--                    </button>-->
                </form>
                <p>Reader Details</p>
                <form autocomplete="off" id="bookIssueUserFrom">
                    <div class="form-row">
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Email</span>
                                </div>
                                <input type="text" class="form-control autocomplete"
                                       name="book_issue-user-email"
                                       id="bookIssueUserEmail">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Contact No:</span>
                                </div>
                                <input type="text" class="form-control autocomplete"
                                       name="book-issue-contact-number"
                                       id="bookIssueContactNumber">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Name</span>
                                </div>
                                <input type="text" class="form-control"
                                       name="book-issue-name"
                                       id="bookIssueUserName">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Address</span>
                                </div>
                                <input type="text" class="form-control"
                                       name="book-issue-postal-address"
                                       id="bookIssueUserPostalAddress">
                            </div>
                        </div>
                    </div>
                </form>
                <form id="bookIssueDateFrom">
                    <div class="form-row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Date of Lend</span>
                                </div>
                                <input class="form-control" type="text" name="date-of-lend"
                                       id="dateOfLend" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Date of Return</span>
                                </div>
                                <input class="form-control" type="text"
                                       name="date-of-return"
                                       id="dateOfReturn" readonly>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-warning" onclick="resetFields()" style="width: 100%">Reset
                        </button>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-danger" id="bookIssueAddButton" style="width: 100%" onclick="saveLend()">Lend
                            Book
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-bordered" id="bookTable">
                        <thead>
                        <tr>
                            <th>Book Ref.No</th>
                            <th>Email</th>
                            <th>Date of Lend</th>
                            <th>Date of return</th>
                        </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php

                        $sql = "SELECT Book.reference_number, User.email, IssueBook.lend_date, IssueBook.return_date 
FROM ((IssueBook INNER JOIN Book ON IssueBook.book_id = Book.book_id) INNER JOIN User ON IssueBook.user_id = User.user_id) 
WHERE IssueBook.returned=false; ";

                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                                $refNumber = $row["reference_number"];
                                $email = $row["email"];
                                $dateOfLend = $row["lend_date"];
                                $dateOfReturn = $row["return_date"];

                                ?>
                                <tr onclick="getData(this)">
                                    <td><?php echo $refNumber ?></td>
                                    <td><?php echo $email ?></td>
                                    <td><?php echo $dateOfLend ?></td>
                                    <td><?php echo $dateOfReturn ?></td>
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
<script src="js/issue-book.js"></script>
<script rel="script" src="js/bootstrap.min.js"></script>
<script rel="script" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

