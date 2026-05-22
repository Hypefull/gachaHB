<?php
    session_start();
    require_once('../library/connect.php');
    if(!isset($_SESSION['name'])){
        header("location: ../login.php");
    }
    $query2 = "SELECT * from user where id=".$_SESSION['id'];
    $result2 = $connection->query($query2);
    $row2 = $result2->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waifu Library</title>
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

        tr.rarity-common { background: #eaf4fb; }
        tr.rarity-rare    { background: #ede8fb; }
        tr.rarity-legendary { background: #fff8dc; }

        tr.rarity-common:hover    { background: #d0eaf7; }
        tr.rarity-rare:hover      { background: #d9d0f5; }
        tr.rarity-legendary:hover { background: #ffeea0; }

        .status-owned  { color: #1a6e30; font-weight: 500; }
        .status-locked { color: #999;    font-weight: 400; }

        img {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="brand">HB Gacha - Waifu</h1>
        <p class="user-info"><?php echo $_SESSION['name']; ?></p>
        <p class="user-info">💎<?php echo $row2['gems'];?></p>

        <hr class="divider">

        <div class="nav-links">
            <a class="btn-nav" href="gacha.php">Gacha</a>
            <a class="btn-nav" href="shop.php">Shop</a>
            <a class="btn-nav" href="../index.php">Home</a>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rarity</th>
                        <th>Status</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT * from waifu";
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
                            $owned_query = "SELECT * FROM user_waifu WHERE user_id = ".$_SESSION['id']." AND waifu_id = ".$row['id'];
                            $check = $connection->query($owned_query);
                            if ($check->num_rows > 0){
                                $status = "Owned";
                                $color = 'style="filter: grayscale(0%)"';
                            }
                            else{
                                $status = "Locked";
                                $color = 'style="filter: grayscale(100%)"';
                            }
                            echo '<tr class="rarity-'.strtolower($rarity).'">
                            <td>'.$row['name'].'</td>
                            <td>'.$rarity.'</td>
                            <td class="status-'.strtolower($status).'">'.$status.'</td>
                            <td><img src="../waifuimages/'.$rarity.'/'.$row['image'].'" height=150 width=150 '.$color.'></td>
                        </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
