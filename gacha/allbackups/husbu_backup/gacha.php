<?php
    session_start();
    require_once('../library/connect.php');
    $query2 = "SELECT * from user where id=".$_SESSION['id'];
    $result2 = $connection->query($query2);
    $row2 = $result2->fetch_assoc();

    if(!isset($_SESSION['name'])){
        header("location: ../login.php");
    }

    if(isset($_POST['submit'])){
        if($row2['gems'] >= 50){
            $deduct = "UPDATE user SET gems = gems - 50 WHERE id=".$_SESSION['id'];
            $connection->query($deduct);
            $getornot = random_int(1, 5);
            if ($getornot == 1){
                $_SESSION['result'] = '<p> you are a loser noobs </p>';
            }
            else{
                $rarity = random_int(1, 100);
                if ($rarity == 100){
                    $id = random_int(27, 30);
                    $type = "Legendary";
                }
                elseif ($rarity < 81){
                    $id = random_int(1, 14);
                    $type = "Common";
                }
                else {
                    $id = random_int(15, 26);
                    $type = "Rare";
                }
                $query = "SELECT * from characters where id=".$id;
                $result = $connection->query($query);
                $row = $result->fetch_assoc();
                $insert = "INSERT IGNORE into user_characters (user_id, character_id) VALUES (".$_SESSION['id'].", ".$id.")";
                $connection->query($insert);
                if ($connection->affected_rows == 0){
                    $_SESSION['result'] = '<p> Duplicated '.$type.' </p> <br>
                        <img src="../husbuimages/'.$type.'/'.$row['image'].'" width=150 height=150> <br>
                        <p> '.$row['name'].' converted into 50 gems </p>';
                    $refund = "UPDATE user SET gems = gems + 50 WHERE id=".$_SESSION['id'];
                    $connection->query($refund);
                }
                else{
                    $_SESSION['result'] = '<p> You just got a '.$type.' </p> <br>
                            <img src="../husbuimages/'.$type.'/'.$row['image'].'" width=150 height=150> <br>
                            <p> '.$row['name'].'</p>';
                }
                
                
            }
            header("location: ".$_SERVER['PHP_SELF']);
            exit;
        }
        else{
           $_SESSION['result'] = '<p> Not enough gems loser </p>';
           header("location: ".$_SERVER['PHP_SELF']);
           exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bagel+Fat+One&family=Cabin+Sketch:wght@400;700&family=Darumadrop+One&family=Lexend:wght@100..900&family=Londrina+Shadow&family=Palette+Mosaic&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            background: #fff1b5;
            font-family: "Lexend", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            color: #43302e;
            overflow-x: hidden;
        }
        </style>
    <title>Gacha Husbu</title>
</head>
<body>
    <div class="container">
        <h1>Gacha Husbu</h1>
        <p>Name : <?php echo $_SESSION['name']; ?></p>
        <p>Gems : <?php echo $row2['gems'];?></p>
        <a class="btn btn-primary "href="library.php">Library</a>
        <a class="btn btn-secondary "href="shop.php">Shop</a>
        <a class="btn btn-primary "href="../index.php">Home</a>
        <br>
        <hr>
        <form method="POST">
            <div>
                <input type="hidden" name="confirm" value="1">
            </div>
            <button type="submit" name="submit">Gacha - 50 Gems</button>
        </form>
        <br>
        <?php 
            if (isset($_SESSION['result'])) {
                echo $_SESSION['result'];
                unset($_SESSION['result']);
            }
        ?>
    </div>
</body>
</html>