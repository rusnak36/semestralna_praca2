<?php
    include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe579541a1.js" crossorigin="anonymous"></script>
    <link href="register.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="register_box">
        <h1>Register</h1>
        <div style="background-color: white; display: grid; justify-content: center;">
            <?php
            if(isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p style='color:red;'>Formular nesmie obsahovat prazdne polia!</p>";
                } elseif ($_GET["error"] == "username") {
                    echo "<p style='color:red;'>Zadal meno v zlom formate!</p>";
                } elseif ($_GET["error"] == "usernamelenght") {
                    echo "<p style='color:red;'>Zadal si kratke meno!</p>";
                } elseif ($_GET["error"] == "email") {
                    echo "<p style='color:red;'>Zadal si neplany email!</p>";
                } elseif ($_GET["error"] == "pswnotmatch") {
                    echo "<p style='color:red;'>Hesla sa nezhoduju!</p>";
                } elseif ($_GET["error"] == "incorrectpassword") {
                    echo "<p style='color:red;'>Zadal si heslo v zlom formate!</p>";
                } elseif ($_GET["error"] == "accountexists") {
                    echo "<p style='color:red;'>Ucet s tymto menom uz exituje!</p>";
                } elseif ($_GET["error"] == "none") {
                    echo "<p style='color:green;'>Ucet bol uspesne vytvoreny!</p>";
                }
            }
            ?>
        </div>
        <form action="includes/register.inc.php" method="post">
            <ul id="register_grid">
                <li><p>Enter e-mail</p></li>
                <li><input type="text" placeholder="E-mail" name="email" id="email" required></li>
                <li><p>Enter username</p></li>
                <li><input type="text" placeholder="Username" name="username" required></li>
                <li><p>Enter password</p></li>
                <li><input type="password" placeholder="Password" name="psw" id="psw" required></li>
                <li><p>Repeat password</p></li>
                <li><input type="password" placeholder="Repeat password" name="psw-repeat" id="psw-repeat" required></li>
            </ul>
            <button type="submit" name="submit">Register</button>
        </form>

        <div>
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        </div>
        <div class="container_signin">
            <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
    </div>
</div>
</body>
</html>
<?php
    include_once 'footer.php';
?>
