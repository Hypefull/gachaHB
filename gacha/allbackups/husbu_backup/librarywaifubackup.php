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
</head>
<body>
    <div class="container">
        <h1>Waifu Library</h1>
        <p>Name : <?php echo $_SESSION['name']; ?></p>
        <p>Gems : <?php echo $row2['gems'];?></p>
        <a class="btn btn-primary "href="gacha.php">Gacha</a>
        <a class="btn btn-secondary "href="shop.php">Shop</a>
        <a class="btn btn-primary "href="../index.php">Home</a>
        <hr>
        <table class="table table-striped">
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

                        echo '<tr>
                        <td>'.$row['name'].'</td>
                        <td>'.$rarity.'</td>
                        <td>'.$status.'</td>
                        <td><img src="../waifuimages/'.$rarity.'/'.$row['image'].'" height=150 width=150 '.$color.'></td>
                    </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>