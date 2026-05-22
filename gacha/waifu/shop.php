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
            $sold = "DELETE FROM user_waifu WHERE user_id = ".$_SESSION['id']." AND waifu_id =".$character_id." LIMIT 1";
            $gain = "UPDATE user SET gems = gems + ".$reward." WHERE id=".$_SESSION['id'];
            $connection->query($sold);
            $connection->query($gain);
            $_SESSION['result'] = '
                <p>Sold successfully! </p>
                <p>You gained '.$reward.'💎</p>';
        }
        else{
            $lose = "UPDATE user SET gems = gems - 50 WHERE id=".$_SESSION['id'];
            $connection->query($lose);
            $_SESSION['result'] = '
                <p> Failed to sell item! </p>
                <p>You lost 50💎</p>';
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

        .wrapper {
            max-width: 860px;
            margin: 0 auto;
            padding: 32px 16px;
        }

        .brand {
            font-family: "Bagel Fat One", system-ui;
            color: #43302e;
            font-size: 35px;
            text-shadow: 0 0 20px #fff3e7;
            letter-spacing: 2px;
            margin-bottom: 4px;
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

        .result-box {
            padding: 12px 16px;
            border: 1px solid #ffa62b;
            border-radius: 12px;
            background: #fffbe6;
            margin-bottom: 16px;
            font-size: 0.9rem;
        }

        .result-box p { margin: 2px 0; }

        .card {
            border: 1px solid #ffa62b;
            border-radius: 20px;
            padding: 24px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        thead tr {
            background: #ffa62b;
            color: #43302e;
        }

        thead th {
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
        }

        tbody tr {
            border-bottom: 1px solid #f5e6c0;
        }

        tbody td {
            padding: 10px 14px;
            vertical-align: middle;
        }

        tr.rarity-common     { background: #eaf4fb; }
        tr.rarity-rare       { background: #ede8fb; }
        tr.rarity-legendary  { background: #fff8dc; }

        tr.rarity-common:hover    { background: #d0eaf7; }
        tr.rarity-rare:hover      { background: #d9d0f5; }
        tr.rarity-legendary:hover { background: #ffeea0; }

        img {
            border-radius: 8px;
        }

        .btn-sell {
            padding: 7px 18px;
            border-radius: 6px;
            font-family: "Lexend", sans-serif;
            font-size: 0.875rem;
            border: 1px solid #c0392b;
            background-color: #f5b7b1;
            color: #43302e;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-sell:hover {
            background-color: #e74c3c;
            border-color: #e74c3c;
            color: #fff;
        }
    </style>
    <title>Shop Husbu</title>
</head>
<body>
    <div class="wrapper">

        <?php 
            if (isset($_SESSION['result'])) {
                echo '<div class="result-box">'.$_SESSION['result'].'</div>';
                unset($_SESSION['result']);
            }
        ?>

        <h1 class="brand">HB Gacha - Waifu</h1>
        <p class="user-info"><?php echo $_SESSION['name']; ?></p>
        <p class="user-info">💎<?php echo $row2['gems'];?></p>

        <hr class="divider">

        <div class="nav-links">
            <a class="btn-nav" href="library.php">Library</a>
            <a class="btn-nav" href="gacha.php">Gacha</a>
            <a class="btn-nav" href="../index.php">Home</a>
        </div>

        <div class="card">
            <table>
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
                        $query = "SELECT * from waifu join user_waifu on waifu.id = user_waifu.waifu_id WHERE user_waifu.user_id = ".$_SESSION['id'];
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

                            echo '<tr class="rarity-'.strtolower($rarity).'">
                            <td>'.$row['name'].'</td>
                            <td>'.$rarity.'</td>
                            <td><img src="../waifuimages/'.$rarity.'/'.$row['image'].'" height=150 width=150></td>
                            <td>
                            <form method="POST">
                                <br>
                                <input type="hidden" name="character_id" value='.$row['id'].'>
                                <button type="submit" name="sell" class="btn-sell">Sell</button>
                            </form>
                            </td>
                        </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
