<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    
    <div>
        <?php if(isset($_SESSION['userid']) && isset($_SESSION['useruser'])) { ?>
            <h1>SEI ENTRATO!</h1>
            <a href="./includes/logout-include.php">logout</a>
        <?php } else { ?>
            <h1>No</h1>
        <?php } ?>
    </div>

</body>
</html>