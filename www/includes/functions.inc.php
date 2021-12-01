<?php
function emptyInput($email, $username, $psw, $pswRepeat) {
    return (empty($email) || empty($username) || empty($psw) || empty($pswRepeat));
}
function isUsernameIncorrect($username) {
    return (!preg_match("/^[a-zA-Z0-9]*$/", $username));
}

function isUsernameShot($username) {
    return !(strlen($username) > 7);
}

function isEmailIncorrect($email) {
    return (!filter_var($email, FILTER_VALIDATE_EMAIL));
}
function passwordNotMatch($psw, $pswRepeat) {
    return ($psw !== $pswRepeat);
}

function isPasswordIncorrect($psw){
    if ($psw < 8) {
        return true;
    }
    elseif(!preg_match("#[0-9]+#",$psw)) {
        return true;
    }
    elseif(!preg_match("#[A-Z]+#",$psw)) {
        return true;
    }
    elseif(!preg_match("#[a-z]+#",$psw)) {
        return true;
    }
    elseif(!preg_match('#[^\w]#', $psw)) {
        return true;
    }
    return false;
}

function accountExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
function createAccount($conn, $email, $username, $psw) {

    $pswHash = password_hash($psw, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$pswHash')";
    if ($conn->query($sql) === TRUE) {
        header("location: ../register.php?error=none");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function createAccountAdministration($conn, $email, $username, $psw) {

    $pswHash = password_hash($psw, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$pswHash')";
    if ($conn->query($sql) === TRUE) {
        header("location: ../administration.php?error=none");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function emptyInputLogin($username, $psw) {
    return (empty($username) || empty($psw));
}

function loginUser($conn, $username, $psw) {
    $userExists = accountExists($conn, $username, $username);

    if($userExists == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    $pswHashed = $userExists["password"];
    if(!password_verify($psw, $pswHashed)) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    if(password_verify($psw, $pswHashed)) {
        session_start();
        $_SESSION["id"] = $userExists["id"];
        $_SESSION["account_name"] = $userExists["username"];
        $_SESSION["email"] = $userExists["email"];
        header("location: ../contact.php");
        exit();
    }
}
