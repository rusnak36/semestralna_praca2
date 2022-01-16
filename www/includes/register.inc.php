<?php

if(isset($_POST["submit"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $psw = $_POST["psw"];
    $pswRepeat = $_POST["pswRepeat"];
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
        //header("location: ../register.php?error=emptyinput");
        exit("Neboli vyplnene vsetky udaje!");
    }


    if(isUsernameIncorrect($username) !== false) {
        //header("location: ../register.php?error=username");
        exit("Meno musi obsahovat velke, male pismena a cisla!");
    }

    if(isUsernameShot($username) !== false) {
        //header("location: ../register.php?error=usernamelenght");
        exit("Toto meno je prilis kratke!");
    }

    if(isEmailIncorrect($email) !== false) {
        //header("location: ../register.php?error=email");
        exit("Tento mail nieje platny!");
    }

    if(passwordNotMatch($psw, $pswRepeat) !== false) {
        //header("location: ../register.php?error=pswnotmatch");
        exit("Hesla sa nezhoduju!");
    }

    if(isPasswordIncorrect($psw) !== false) {
        //header("location: ../register.php?error=incorrectpassword");
        exit("Heslo musi mat min 8 pismen a obsahovat cisla a znaky");
    }

    if (accountExists($conn, $username, $username) !== false) {
        //header("location: ../register.php?error=accountexists");
        exit("Tento ucet uz exituje!");
    }

    createAccount($conn, $email, $username, $psw);

} else {
    header("location: ../register.php");
    exit();
}