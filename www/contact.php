<?php
    include_once 'header.php';
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
    <link href="css/contact.css" rel="stylesheet" type="text/css">
</head>

<?php
    $conn = new mysqli('localhost', 'root', 'dtb456', 'db1');
    $sql = $conn->query("SELECT * FROM contacts");
?>
<body>
<div class="main">
    <ul id="hhh">
        <li id="left_grid">
            <div class="border_left"></div>
        </li>
        <li id="page_grid">
            <div class="page">
                <ul>

                    <?php while ($row = $sql->fetch_assoc()): ?>
                    <li>
                        <div class="contact">
                            <ul class="test">
                                <li>
                                    <div class="user">Contact</div>
                                </li>
                                <li>
                                    <div class="user_info">
                                        <div class="information">
                                            <ul>
                                                <li>
                                                    <div class="name">name: <?php echo $row['name'];?>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="number">number: <?php echo $row['number'];?></div>
                                                </li>
                                                <li>
                                                    <div class="mail">mail: <?php echo $row['mail'];?></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </li>
        <li id="right_grid">
            <div class="border_right"></div>
        </li>
    </ul>
</div>

<?php
include_once 'footer.php';
?>