<?php
    session_start();
    require_once('../library/connect.php');
    if(!isset($_SESSION['name'])){
        header("location: ../login.php");
    }

    $query2 = "SELECT * from user where id=".$_SESSION['id'];
    $result2 = $connection->query($query2);
    $row2 = $result2->fetch_assoc();

    if(isset($_POST['sell'])){
        $character_id = $_POST['character_id'];
        $acceptornot = random_int(1,2);
        if ($character_id <= 14){
            $reward = 100;
        }
        elseif ($character_id >= 27){
            $reward = 1000;
        }
        else {
            $reward = 200;
        }

        if ($acceptornot == 1){
            $sold = "DELETE FROM user_characters WHERE user_id = ".$_SESSION['id']." AND character_id =".$character_id." LIMIT 1";
            $gain = "UPDATE user SET gems = gems + ".$reward." WHERE id=".$_SESSION['id'];
            $connection->query($sold);
            $connection->query($gain);
            $_SESSION['result'] = '
                <p>Sold successfully! </p>
                <p>You gained '.$reward.' gems.</p>';
        }
        else{
            $lose = "UPDATE user SET gems = gems - 50 WHERE id=".$_SESSION['id'];
            $connection->query($lose);
            $_SESSION['result'] = '
                <p> Failed to sell </p>
                <p>You lost 50 gems.</p>';
        }

    header("location: ".$_SERVER['PHP_SELF']);
    exit;

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
    <title>Shop Husbu</title>
</head>
<body>
    <div class="container">
        <?php 
        if (isset($_SESSION['result'])) {
            echo $_SESSION['result'];
            unset($_SESSION['result']);
        }
    ?>
        <h1>Shop Husbu</h1>
        <p>Name : <?php echo $_SESSION['name']; ?></p>
        <p>Gems : <?php echo $row2['gems'];?></p>
        <a class="btn btn-primary "href="library.php">Library</a>
        <a class="btn btn-secondary "href="gacha.php">Gacha</a>
        <a class="btn btn-primary "href="../index.php">Home</a>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Rarity</th>
                    <th>Image</th>
                    <th>Sell</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * from characters join user_characters on characters.id = user_characters.character_id WHERE user_characters.user_id = ".$_SESSION['id'];
                    $result = $connection->query($query);
                    while($row = $result->fetch_assoc()){
                        if ($row['id'] <= 14){
                            $rarity = "Common";
                        }
                        elseif ($row['id'] >= 27){
                            $rarity = "Legendary";
                        }
                        else {
                            $rarity = "Rare";
                        }

                        echo '<tr>
                        <td>'.$row['name'].'</td>
                        <td>'.$rarity.'</td>
                        <td><img src="../husbuimages/'.$rarity.'/'.$row['image'].'" height=150 width=150></td>
                        <td>
                        <form method="POST">
                            <br>
                            <input type="hidden" name="character_id" value='.$row['id'].'>
                            <button type="submit" name="sell" class="btn btn-danger">Sell</button>
                        </form>
                        </td>
                    </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>