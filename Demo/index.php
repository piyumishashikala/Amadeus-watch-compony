<?php
/**
 * Created by IntelliJ IDEA.
 * User: Diluni Malsha Peiris
 * Date: 1/8/2020
 * Time: 11:23 AM
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
    <title>Login</title>
</head>
<style>
    body {
        background-image: url("images/loginBackgorund.jpeg");
    }

    #content {
        width: 50%;
        height: 50%;
        position: absolute;
        top: 25%;
        left: 25%;
        background-color: white;
    }

    .row {
        margin: 0;
        height: 100%;
    }

    #imageDiv {
        padding: 0;
    }

    @media (max-width: 768px) and (min-width: 320px) {
        #content {
            background-color: rgba(255, 255, 255, 0);
            border: 0;
        }
    }

    @media (max-width: 425px) and (min-width: 320px) {
        #content {
            width: 80%;
            left: 10%;
            background-color: rgba(255, 255, 255, 0);
            border: 0;
        }
    }
</style>
<body>
<div class="card mb-3 text-center" id="content">
    <div class="row no-gutters">
        <div class="col-lg-6">
            <img src="images/loginImage.jpg" height="100%" width="100%">
        </div>
        <div class="col-lg-6">
            <div class="card-body">
                <h4>Library Management System</h4>
                <br>
                <form>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-sm" name="username"
                               id="username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-sm" name="password"
                               id="password">
                    </div>
                    <button id="loginButton" class="btn btn-dark" type="button">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/check-login.js"></script>
<script rel="script" src="js/bootstrap.min.js"></script>
<script rel="script" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

