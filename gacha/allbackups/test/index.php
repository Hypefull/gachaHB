<?php
    session_start();
    require_once('library/connect.php');
    if(!isset($_SESSION['name'])){
        header("location: login.php");
    }

    if(isset($_POST['signout'])){
        session_destroy();
        header("location: login.php");
    }
    $query2 = "SELECT * from user where id=".$_SESSION['id'];
    $result2 = $connection->query($query2);
    $row2 = $result2->fetch_assoc();
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <title>Welcome <?php echo $_SESSION['name'] ?></title>
    </head>
    <body>
        <div style= "text-align: center">
            <h1><?php echo $_SESSION['name'] ?> </h1>
            <h2>Gems : <?php echo $row2['gems'];?></h2>
            <a class="btn btn-primary" href="login.php" id="signout" name="signout">Signout</a>
            <br> <br>
            <a class="btn btn-primary "href="husbu/gacha.php">Gacha Husbu</a>
            <br> <br>
            <a class="btn btn-primary "href="waifu/gacha.php">Gacha Waifu</a>
        </div>
    </body>
</html>