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
            echo '<div class="alert alert-danger" role="alert">Login Gagal</div>';
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-YzRFWzHlBNW8OLbMAhU3MQDZ1UNVpOlFwPFfaFQjSTp5NqShEfvBJRlNNFl5w4O" crossorigin="anonymous"></script>
        <script src="library/script.js"></script>
        <style>
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

            .login-wrapper {
                width: 100%;
                max-width: 400px;
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

            .show-password {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-top: 8px;
                font-size: 0.875rem;
            }

            .btn-login {
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #c1dbe8;
                border: 1px solid #2e5aa7;
                border-radius: 6px;
                font-family: "Lexend", sans-serif;
                font-size: 0.95rem;
                cursor: pointer;
                margin-top: 24px;
                transition: background-color 0.2s;
            }

            .btn-login:hover {
                background-color: #7F77DD;
                border-color: #7F77DD;
                color: #fff;
            }

            .register-link {
                text-align: center;
                margin-top: 16px;
                font-size: 0.875rem;
            }

            .register-link a {
                color: #534AB7;
                text-decoration: none;
            }

            .register-link a:hover {
                text-decoration: underline;
            }

            .alert-danger {
                color: #842029;
                background-color: #f8d7da;
                border: 1px solid #f5c2c7;
                border-radius: 6px;
                padding: 10px 14px;
                margin-bottom: 16px;
                font-size: 0.9rem;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="login-wrapper">
            <h1 class="brand">HB Gacha</h1>

            <div class="card">
                <p class="card-title">Login Account</p>

                <form method="POST">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                        <div class="show-password">
                            <input type="checkbox" id="showPasswordCheck" onclick="showPassword()">
                            <label for="showPasswordCheck">Show Password</label>
                        </div>
                    </div>

                    <button type="submit" id="submit" name="submit" class="btn-login">Login</button>
                </form>

                <div class="register-link">
                    <a href="register.php">Don't have an account? Register here</a>
                </div>
            </div>
        </div>
    </body>
</html>
