<?php
if(isset($_POST["submit"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $psw = $_POST["psw"];
    $pswRepeat = $_POST["psw-repeat"];
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


    if (emptyInput($email, $username, $psw, $pswRepeat) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    if(isUsernameIncorrect($username) !== false) {
        header("location: ../register.php?error=username");
        exit();
    }

    if(isUsernameShot($username) !== false) {
        header("location: ../register.php?error=usernamelenght");
        exit();
    }

    if(isEmailIncorrect($email) !== false) {
        header("location: ../register.php?error=email");
        exit();
    }

    if(passwordNotMatch($psw, $pswRepeat) !== false) {
        header("location: ../register.php?error=pswnotmatch");
        exit();
    }

    if(isPasswordIncorrect($psw) !== false) {
        header("location: ../register.php?error=incorrectpassword");
        exit();
    }

    if (accountExists($conn, $username, $username) !== false) {
        header("location: ../register.php?error=accountexists");
        exit();
    }

    createAccount($conn, $email, $username, $psw);

} else {
    header("location: ../register.php");
    exit();
}