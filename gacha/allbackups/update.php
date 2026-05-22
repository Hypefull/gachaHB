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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <title>Update <?php echo $row['name']?></title>
    </head>
    <body>
        <div class="container">
            <h1>Update Karyawan Form</h1>
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input value="<?php echo $row['name']?>" class="form-control" id="name" placeholder="Name" name="name">
                </div>

                <div class="form-group">
                    <label for="gems">Gems</label>
                    <input value="<?php echo $row['gems']?>" class="form-control" id="gems" placeholder="Gems" name="gems">
                </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="index.php" class="btn btn-primary">Home</a>
    </div>
    </body>
</html>