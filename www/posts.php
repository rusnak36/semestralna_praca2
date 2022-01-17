<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/posts.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    $conn = new mysqli('localhost', 'root', 'dtb456', 'db1');
    $sql = $conn->query("SELECT * FROM items");
?>

    <div class="container">
        <?php while ($row = $sql->fetch_assoc()): ?>
            <div class="card">
                <div class="card-header text-center">
                    Ponuka
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name'];?></h5>
                    <p class="card-text"><?php echo $row['description'];?></p>
                </div>
                <div class="card-footer text-muted">
                    Cena: <?php echo $row['prize'];?>
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