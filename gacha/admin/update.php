<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header("location: login.php");
    }
    require_once('../library/connect.php');
    $query = "SELECT * from user where id=".$_GET['id'];
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $gems = $_POST['gems'];
            $sql = "UPDATE user SET name='".$name."',gems=".$gems." where id=".$_GET['id'];
            $connection->query($sql);
            header("location: index.php");
    }
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
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .wrapper {
                width: 100%;
                max-width: 420px;
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

            .card-title {
                font-size: 1.1rem;
                font-weight: 600;
                text-align: center;
                margin-bottom: 24px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-label {
                display: block;
                margin-bottom: 6px;
                font-size: 0.9rem;
            }

            .form-control {
                width: 100%;
                padding: 8px 12px;
                border: 1px solid #dee2e6;
                border-radius: 6px;
                font-family: "Lexend", sans-serif;
                font-size: 0.95rem;
            }

            .form-control:focus {
                border-color: #7F77DD;
                box-shadow: 0 0 0 0.2rem rgba(127, 119, 221, 0.25);
                outline: none;
            }

            .btn-row {
                display: flex;
                gap: 8px;
                margin-top: 24px;
            }

            .btn-submit {
                flex: 1;
                padding: 10px;
                background-color: #c1dbe8;
                border: 1px solid #2e5aa7;
                border-radius: 6px;
                font-family: "Lexend", sans-serif;
                font-size: 0.95rem;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .btn-submit:hover {
                background-color: #7F77DD;
                border-color: #7F77DD;
                color: #fff;
            }

            .btn-home {
                flex: 1;
                padding: 10px;
                background-color: #fffbe6;
                border: 1px solid #ffa62b;
                border-radius: 6px;
                font-family: "Lexend", sans-serif;
                font-size: 0.95rem;
                text-decoration: none;
                text-align: center;
                color: #43302e;
                transition: background-color 0.2s;
            }

            .btn-home:hover {
                background-color: #ffa62b;
                color: #43302e;
            }
        </style>
        <title>Update <?php echo $row['name']?></title>
    </head>
    <body>
        <div class="wrapper">
            <h1 class="brand">HB Gacha</h1>

            <div class="card">
                <p class="card-title">Update User</p>

                <form method="POST">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input value="<?php echo $row['name']?>" class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="gems" class="form-label">Gems</label>
                        <input value="<?php echo $row['gems']?>" class="form-control" id="gems" placeholder="Gems" name="gems">
                    </div>

                    <div class="btn-row">
                        <button type="submit" class="btn-submit" name="submit">Submit</button>
                        <a href="index.php" class="btn-home">Home</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
