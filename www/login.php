<?php
include_once 'header.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/fe579541a1.js" crossorigin="anonymous"></script>
        <link href="css/login.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="main">
        <ul>
            <li>
                <div class="container">
                    <form action="includes/login.inc.php" method="post">
                        <ul id="menu">
                            <li class="tabulka">
                                <?php
                                if (isset($_GET["error"])) {?>
                                <div style="background-color: white; display: grid; justify-content: center;">
                                    <?php
                                    if ($_GET["error"] == "emptyinput") {
                                            echo "<p style='color:red;'>Formular nesmie obsahovat prazdne polia!</p>";
                                    } elseif ($_GET["error"] == "wronglogin") {
                                            echo "<p style='color:red;'>Zadal si zle meno alebo heslo!</p>";
                                    }
                                ?>
                                </div>
                                <?php
                                }
                                ?>
                                <ul id="login_section">
                                    <li><a>Enter username</a></li>
                                    <li><input class="array" type="text" name="username" placeholder="Username" required></li>
                                    <li><a>Enter password</a></li>
                                    <li><input class="array" type="password" name="psw" placeholder="Password" required></li>
                                </ul>
                            </li>

                            <li class="tabulka">
                                <div id="button">
                                    <button type="submit" name="submit">Login</button>
                                </div>
                            </li>
                        </ul>


                    </form>
                        <ul id="option_section">
                            <li class="tabulka2"><a href="register.php" class="btn">Sign up</a></li>
                            <li class="tabulka2"><a href="#" class="btn">Forgot password?</a></li>
                        </ul>

                </div>
            </li>
        </ul>
    </div>
    </body>
    </html>
<?php
include_once 'footer.php';
?>