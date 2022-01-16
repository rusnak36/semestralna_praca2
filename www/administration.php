<?php
include_once 'header.php';
if (!isset($_SESSION["id"])) {
    header("location: login.php");
}
include_once 'includes/administration.inc.php'
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe579541a1.js" crossorigin="anonymous"></script>
    <link href="css/administration.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$conn = new mysqli("localhost", "root", "dtb456", "db1");
$result = $conn->query("SELECT * FROM users");

?>

<div class="vypis">
    <ul>
        <li class="row"><a>Email</a></li>
        <li class="row"><a>Username</a></li>
        <li class="row"><a>Password</a></li>
        <li class="row"><a>Action</a></li>
        <?php while ($row = $result->fetch_assoc()): ?>
        <li class="row"><a><?php echo $row["email"]?></a></li>
        <li class="row"><a><?php echo $row["username"]?></a></li>
        <li class="row"><a>(hidden)</a></li>
        <li class="row">
            <ul id="actionGrid">
                <li><a href="administration.php?edit=<?php echo $row['id']; ?>">Edit</a></li>
                <li><a href="administration.php?delete=<?php echo $row['id']; ?>">Delete</a></li>
            </ul>
        </li>
        <?php endwhile; ?>
    </ul>
</div>

<?php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<div id="main">
    <form action="includes/administration.inc.php" method="post">
        <ul id="register_grid">
            <li><p>Enter e-mail</p></li>
            <li><input type="text" value="<?php echo $DBemail?>" placeholder="E-mail" name="email" id="email" required></li>
            <li><p>Enter username</p></li>
            <li><input type="text" value="<?php echo $DBusername?>" placeholder="Username" name="username" required></li>
            <li><p>Enter password</p></li>
            <li><input type="password" placeholder="Password" name="psw" id="psw" required></li>
        </ul>
        <div id="button_section"><button type="submit" name="submit">Update</button></div>
    </form>
</div>

</body>
</html>
<?php
include_once 'footer.php';
?>
