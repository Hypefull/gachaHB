<?php
    session_start();
    require_once('../library/connect.php');
    if(!isset($_SESSION['admin'])){
        header("location: login.php");
    }
    if(isset($_POST['signout'])){
        session_destroy();
        header("location: login.php");
    }
    if(isset($_POST['delete'])){
        $sql = "DELETE from user where id=".$_POST['id'];
        $sqlsql = "DELETE from user_characters where user_id=".$_POST['id'];
        $sqlsql2 = "DELETE from user_waifu where user_id=".$_POST['id'];
        $connection->query($sqlsql);
        $connection->query($sqlsql2);
        $connection->query($sql);
    }
    $query2 = "SELECT * from admin where id=".$_SESSION['id'];
    $result2 = $connection->query($query2);
    $row2 = $result2->fetch_assoc();
?>
<html>
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
                max-width: 760px;
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

            .divider {
                border: none;
                border-top: 1px solid #ffa62b;
                margin: 16px 0;
            }

            .btn-signout {
                padding: 7px 18px;
                border-radius: 6px;
                font-family: "Lexend", sans-serif;
                font-size: 0.875rem;
                text-decoration: none;
                border: 1px solid #c0392b;
                background-color: #f5b7b1;
                color: #43302e;
                transition: background-color 0.2s;
            }

            .btn-signout:hover {
                background-color: #e74c3c;
                border-color: #e74c3c;
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

            tbody tr:nth-child(even) { background: #fffbe6; }
            tbody tr:hover { background: #fff1b5; }

            tbody td {
                padding: 10px 14px;
                vertical-align: middle;
            }

            .btn-update {
                padding: 6px 14px;
                border-radius: 6px;
                font-family: "Lexend", sans-serif;
                font-size: 0.8rem;
                text-decoration: none;
                border: 1px solid #2e5aa7;
                background-color: #c1dbe8;
                color: #43302e;
                transition: background-color 0.2s;
            }

            .btn-update:hover {
                background-color: #7F77DD;
                border-color: #7F77DD;
                color: #fff;
            }

            .btn-delete {
                padding: 6px 14px;
                border-radius: 6px;
                font-family: "Lexend", sans-serif;
                font-size: 0.8rem;
                border: 1px solid #c0392b;
                background-color: #f5b7b1;
                color: #43302e;
                cursor: pointer;
                transition: background-color 0.2s;
                margin-top: 6px;
            }

            .btn-delete:hover {
                background-color: #e74c3c;
                border-color: #e74c3c;
                color: #fff;
            }
        </style>
        <title>Welcome <?php echo $_SESSION['admin'] ?></title>
    </head>
    <body>
        <div class="wrapper">
            <h1 class="brand">HB Gacha</h1>
            <p style="font-size:0.9rem; margin-bottom:4px;">Admin : <?php echo $_SESSION['admin']; ?></p>

            <hr class="divider">

            <div style="margin-bottom:16px;">
                <a class="btn-signout" href="login.php" id="signout" name="signout">Sign Out</a>
            </div>

            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gems</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * from user";
                            $result = $connection->query($query);
                            while($row = $result->fetch_assoc()){
                                echo '<tr>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['gems'].'</td>
                                <td>
                                    <a class="btn-update" href="./update.php?id='.$row['id'].'">Update</a>
                                    <form method="POST">
                                        <input type="text" name="id" value='.$row['id'].' hidden>
                                        <button type="submit" name="delete" class="btn-delete">Delete</button>
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
