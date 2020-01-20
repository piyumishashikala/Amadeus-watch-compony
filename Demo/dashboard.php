<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/17/2020
 * Time: 1:02 PM
 */
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
    <title>Library Management System</title>
    <style>
        .nav-item {
            margin-left: 100px;
        }

        @media (max-width: 990px) and (min-width: 320px) {
            .nav-item {
                margin-left: 0;
            }
        }

        .row {
            margin: 1% 0 0;
        }

        .inner-text {
            position: absolute;
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            background-color: rgba(0, 0, 0, 0.60);
        }

        .name-label{
            margin-top: 25%;
            font-size: 30px;
            color: white;
        }

        .amount-label{
            font-size: 40px;
            color: white;
        }

        .line{
            width: 100%;
            height: 1px;
            background-color: white;
        }
    </style>
</head>
<body onload="getTotal()">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="images/logo.png" width="120px">
    <a class="navbar-brand" href="#">Library Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="lend-book.php">Lend Book</a>
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
    <div class="col-sm-3">
        <div class="card">
            <img src="images/book.jpg" height="300px" alt="">
            <div class="card text-center inner-text">
                <p class="name-label">Books</p>
                <div class="line"></div>
                <p class="amount-label" id="totalBooks"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <img src="images/author.jpg" height="300px" alt="">
            <div class="card text-center inner-text">
                <p class="name-label">Authors</p>
                <div class="line"></div>
                <p class="amount-label" id="totalAuthors"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <img src="images/user.jpg" height="300px" alt="">
            <div class="card text-center inner-text">
                <p class="name-label">Readers</p>
                <div class="line"></div>
                <p class="amount-label" id="totalReaders"></p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <img src="images/lend.jpg" height="300px" alt="">
            <div class="card text-center inner-text">
                <p class="name-label">Book Lends</p>
                <div class="line"></div>
                <p class="amount-label" id="totalLends"></p>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/dashboard.js"></script>
<script rel="script" src="js/bootstrap.min.js"></script>
<script rel="script" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
