<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bagel+Fat+One&family=Cabin+Sketch:wght@400;700&family=Darumadrop+One&family=Lexend:wght@100..900&family=Londrina+Shadow&family=Palette+Mosaic&display=swap" rel="stylesheet">
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
            text-align: center;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 24px;
        }

        .checkmark {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .btn-login {
            display: inline-block;
            padding: 10px 32px;
            background-color: #c1dbe8;
            border: 1px solid #2e5aa7;
            border-radius: 6px;
            font-family: "Lexend", sans-serif;
            font-size: 0.95rem;
            cursor: pointer;
            margin-top: 24px;
            text-decoration: none;
            color: #43302e;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: #7F77DD;
            border-color: #7F77DD;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <h1 class="brand">Admin</h1>

        <div class="card">
            <div class="checkmark">✓</div>
            <p class="card-title">Register Success</p>
            <a href="login.php" class="btn-login">Login</a>
        </div>
    </div>
</body>
</html>
