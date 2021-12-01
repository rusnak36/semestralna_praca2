<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe579541a1.js" crossorigin="anonymous"></script>
    <link href="header.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="header">
    <ul>
        <li id="logo_grid">
            <a href="home.php"><img src="images/logo.png" id="logo" alt="logo"></a>
        </li>
        <li id="navbar">
            <div class="nav">
                <ul id="nav_grid">
                    <li><a href="home.html">HOME</a></li>
                    <li><a href="contact.php">CONTACT</a></li>

                    <?php
                        if(isset($_SESSION["id"])) {
                            echo "<li><a href='administration.php'>ADMINISTRATION</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>LOGOUT</a></li>";

                        } else {
                            echo "<li><a href='login.php'>LOGIN</a></li>";
                            echo "<li><a href='register.php'>REGISTER</a></li>";
                        }
                    ?>

                </ul>
            </div>
        </li>
    </ul>
</div>
