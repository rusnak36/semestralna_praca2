<?php

if(isset($_POST["submit"])) {

    $username = $_POST["username"];
    $psw = $_POST["psw"];
    $servername = "localhost";
    $login = "root";
    $password = "dtb456";
    $dbname = "db1";
    $table = "users";
    $conn = new mysqli($servername, $login, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $psw) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $psw);

} else {
    header("location: ../login.php");
    exit();
}