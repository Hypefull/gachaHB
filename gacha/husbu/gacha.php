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
                $_SESSION['result'] = '<p> You are a loser noob! </p>';
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
           $_SESSION['result'] = '<p> Not enough 💎 loser </p>';
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper {
            width: 100%;
            max-width: 480px;
            padding: 16px;
        }

        .brand {
            font-family: "Bagel Fat One", system-ui;
            color: #43302e;
            font-size: 35px;
            text-shadow: 0 0 20px #fff3e7;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ffa62b;
            border-radius: 20px;
            padding: 32px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .user-info {
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .divider {
            border: none;
            border-top: 1px solid #ffa62b;
            margin: 16px 0;
        }

        .nav-links {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .btn-nav {
            padding: 7px 18px;
            border-radius: 6px;
            font-family: "Lexend", sans-serif;
            font-size: 0.875rem;
            text-decoration: none;
            border: 1px solid #2e5aa7;
            background-color: #c1dbe8;
            color: #43302e;
            transition: background-color 0.2s;
        }

        .btn-nav:hover {
            background-color: #7F77DD;
            border-color: #7F77DD;
            color: #fff;
        }

        .btn-gacha {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #ffa62b;
            border: 1px solid #e08000;
            border-radius: 6px;
            font-family: "Bagel Fat One", system-ui;
            font-size: 1.1rem;
            letter-spacing: 1px;
            color: #43302e;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-gacha:hover {
            background-color: #e08000;
            color: #fff;
        }

        .result-box {
            text-align: center;
            margin-top: 20px;
            padding: 16px;
            border: 1px solid #ffa62b;
            border-radius: 12px;
            background: #fffbe6;
        }

        .result-box p {
            margin: 4px 0;
        }

        .result-box img {
            border-radius: 8px;
            margin: 8px 0;
        }
    </style>
    <title>Gacha Husbu</title>
</head>
<body>
    <div class="wrapper">
        <h1 class="brand">HB Gacha - Husbu</h1>
        <div class="card">
            <p class="user-info"><?php echo $_SESSION['name']; ?></p>
            <p class="user-info">💎<?php echo $row2['gems'];?></p>

            <hr class="divider">

            <div class="nav-links">
                <a class="btn-nav" href="library.php">Library</a>
                <a class="btn-nav" href="shop.php">Shop</a>
                <a class="btn-nav" href="../index.php">Home</a>
            </div>

            <form method="POST">
                <div>
                    <input type="hidden" name="confirm" value="1">
                </div>
                <button type="submit" name="submit" class="btn-gacha">Gacha 50💎</button>
            </form>

            <?php 
                if (isset($_SESSION['result'])) {
                    echo '<div class="result-box">'.$_SESSION['result'].'</div>';
                    unset($_SESSION['result']);
                }
            ?>
        </div>
    </div>
</body>
</html>
