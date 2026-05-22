<?php
    require_once('library/connect.php');

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $sql = "INSERT into user (name, email, password) VALUES ('".$name."','".$email."','".$password."')";
        $connection->query($sql);
        header("location: registerSuccess.php");
    }
?>

<html>
    <head>
        <title>Register</title>
        <script src="library/script.js"></script>
    </head>
    <body>
        <h1>Register Account</h1>
        <a href="login.php"><h1>Login</h1></a>
        <form method="POST">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="Name" name="name" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Email" name="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" name="password" required>
                <br>
                <input type="checkbox" onclick="showPassword()">Show Password
            </div>
            <div>
                <button type="submit" id="submit" name="submit">Create</button>
            </div>
        
        </form>

    </body>
</html>