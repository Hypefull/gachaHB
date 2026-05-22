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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <title>Welcome <?php echo $_SESSION['admin'] ?></title>
    </head>
    <body>
        <div class="container">
            <h1>Admin Page</h1>
            <a class="btn btn-primary" href="login.php" id="signout" name="signout">Signout</a>
            <table class="table table-striped">
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
                            <td><a class="btn btn-secondary no-print" href="./update.php?id='.$row['id'].'">Update</a>
                            <form method="POST">
                                <br>
                                <input type="text" name="id" value='.$row['id'].' hidden>
                                <button type="submit" name="delete" class="btn btn-danger no-print">Delete</button>
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