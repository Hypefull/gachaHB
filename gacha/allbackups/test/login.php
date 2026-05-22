<!-- <?php
    session_start();
    require_once('library/connect.php');

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $sql = "SELECT * from user where email='".$email."' and password ='".$password."'";
        $result = $connection->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("location: index.php");
        }
        else {
            echo '<p style: text-align="center">Login Gagal</p>';
        }
    }

?>

<html>
    <head>
        <title>Login</title>
        <script src="library/script.js"></script>
    </head>
    <body>
        <h1>Login Account</h1>
        <a href="register.php"><h1>Register</h1></a>
        <form method="POST">
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
                <button type="submit" id="submit" name="submit">Login</button>
            </div>
        
        </form>

    </body>
</html> -->

<?php
    session_start();
    require_once('library/connect.php');

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);
        $sql = "SELECT * from user where email='".$email."' and password ='".$password."'";
        $result = $connection->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("location: index.php");
        }
        else {
            echo '<p style: text-align="center">Login Gagal</p>';
        }
    }

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HB Gacha Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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

        #halamanLogin {
            min-height: 100vh;
            background: #fff1b5;
            display: flex;
            align-content: center;
            justify-content: center;
        }
        .login-box {
            background: white;
            border: 2px solid #ffa62b;
            border-radius: 16px;
            padding: 40px 32px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }
        .login-judul {
            font-family: "Bagel Fat One", system-ui;
            font-size: 40px;
            color: #43302e;
            text-align: center;
            margin-bottom: 4px;
        }
        .login-judul span { color: #2e5aa7; }
        .login-subjudul {
            text-align: center;
            font-size: 0.8rem;
            color: #8a6a5a;
            margin-bottom: 24px;
        }

        .button-submit {
            background: #fff1b5;
            border: none;
            color: #43302e;
            font-weight: 700;
            border-radius: 20px;
            padding: 6px 20px;
            font-size: 0.85rem;
            letter-spacing: 1px;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        
    </style>
    </head>
    <body>
        <div id="halamanLogin">
            <h1>Login Account</h1>
            <a href="register.php"><h1>Register</h1></a>
            <form method="POST">
                <div class="login-box">
                    <div class="login-judul">HB<span>Gacha</span></div>
                    <div class="login-subjudul">✦ Masuk untuk mulai bermain ✦</div>
                    <hr style="border-color: #ffa62b;">

                    <div class="login-section">
                        <div>
                            <label class="email-form" for="email">Email</label>
                            <input type="email" id="email" placeholder="Email" name="email" required>
                        </div>

                        <div>
                            <label class="password-form" for="password">Password</label>
                            <input type="password" id="password" placeholder="Password" name="password" required>
                            <br>
                            <input type="checkbox" onclick="showPassword()">Show Password
                        </div>
                        <div>
                            <button class="button-submit" type="submit" id="submit" name="submit">Login</button>
                        </div>
                    </div>
            </div>
        </form>

    </body>
</html>