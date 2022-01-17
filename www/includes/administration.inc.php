<?php
$servername = "localhost";
$login = "root";
$password = "dtb456";
$dbname = "db1";
$table = "users";
$update = false;
$DBusername = '';
$DBemail = '';


$conn = new mysqli($servername, $login, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["submit"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $psw = $_POST["psw"];

    require_once 'functions.inc.php';

    if(isUsernameIncorrect($username) !== false) {
        header("location: ../administration.php?error=username");
        exit();
    }

    if(isUsernameShot($username) !== false) {
        header("location: ../administration.php?error=usernamelenght");
        exit();
    }
    if(isEmailIncorrect($email) !== false) {
        header("location: ../administration.php?error=email");
        exit();
    }

    $userExists = accountExists($conn, $username, $username);
    if($userExists !== false){
        $id = $userExists["id"];
        $pswHash = password_hash($psw, PASSWORD_DEFAULT);


        $insert = $conn->prepare("UPDATE users SET username=?, email=?, password=? WHERE id=?");
        $insert->bind_param("sssi", $username, $email, $pswHash, $id);
        $insert->execute();

//        $conn->query("UPDATE users SET username='$username', email='$email', password='$pswHash' WHERE id=$id");

        header("location: ../administration.php");
        exit();
    }

    createAccountAdministration($conn, $email, $username, $psw);

}
if(isset($_GET['delete']) && isset($_SESSION["id"])) {
    $id = $_GET['delete'];

    $insert = $conn->prepare("DELETE FROM users WHERE id=?");
    $insert->bind_param("i", $id);
    if($insert->execute()) {
        header("location: ../administration.php");
        exit();
    } else {
        echo "Error: " . $insert . "<br>" . $conn->error;
    }



//    $sql = "DELETE FROM users WHERE id=$id";
//    if ($conn->query($sql) === TRUE) {
//        header("location: ../administration.php");
//        exit();
//    } else {
//        echo "Error: " . $sql . "<br>" . $conn->error;
//    }
}
if(isset($_GET['edit']) && isset($_SESSION["id"])) {
    $id = $_GET['edit'];

    $insert = $conn->prepare("SELECT email, username FROM users WHERE id=?");
    $insert->bind_param("i", $id);
    $insert->execute();
    $insert->store_result();
    $insert->bind_result($tempMail, $tempUser);
    $insert->fetch();
    $DBusername = $tempUser;
    $DBemail = $tempMail;
    $update = true;


//    $result = $conn->query("SELECT * FROM users WHERE id=$id");
//        $row = $result->fetch_array();
//        $DBusername = $row['username'];
//        $DBemail = $row['email'];
//        $update = true;
}
