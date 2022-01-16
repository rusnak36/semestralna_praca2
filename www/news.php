<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe579541a1.js" crossorigin="anonymous"></script>
    <link href="css/news.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<?php
$conn = new mysqli('localhost', 'root', 'dtb456', 'db1');
$sql = $conn->query("SELECT * FROM posts");
?>

    <div class="container">
        <?php while ($row = $sql->fetch_assoc()): ?>
        <div class="card bg-light">
            <div class="card-header"><?php echo $row['post_name'];?></div>
            <div class="card-body">
                <p class="card-text"><?php echo $row['post_description'];?></p>
            </div>
        </div>
        <br>
        <?php endwhile; ?>
    </div>
</body>
</html>
<?php
include_once 'footer.php';
?>