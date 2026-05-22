<?php
    session_start();
    require_once('library/connect.php');

    $error = '';

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);
        $sql = "SELECT * from user where email='".$email."' and password ='".$password."'";
        $result = $connection->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("location: index.php");
            exit();
        } else {
            $error = 'Email atau password salah. Silakan coba lagi.';
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HB Gacha — Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bagel+Fat+One&family=Lexend:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #7F77DD;
            --primary-dark: #534AB7;
            --primary-light: #EEEDFE;
            --accent: #1D9E75;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Lexend', sans-serif;
            font-weight: 400;
            background: #f0effe;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: -120px;
            right: -120px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #AFA9EC55 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, #9FE1CB44 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .login-card {
            background: #fff;
            border-radius: 24px;
            border: 1px solid #e3e1f7;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 40px rgba(127, 119, 221, 0.12);
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            font-family: 'Bagel Fat One', cursive;
            font-size: 2rem;
            color: var(--primary-dark);
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .brand-logo span {
            color: var(--accent);
        }

        .badge-gacha {
            background: var(--primary-light);
            color: var(--primary-dark);
            font-size: 11px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.4px;
        }

        .login-title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #26215C;
            margin-bottom: 0.25rem;
        }

        .login-subtitle {
            font-size: 0.875rem;
            color: #888780;
            font-weight: 300;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: #3C3489;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1.5px solid #e3e1f7;
            border-radius: 12px;
            padding: 0.65rem 1rem;
            font-family: 'Lexend', sans-serif;
            font-size: 0.9rem;
            font-weight: 300;
            color: #26215C;
            background: #faf9ff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(127, 119, 221, 0.15);
            background: #fff;
            color: #26215C;
        }

        .form-control::placeholder { color: #b4b2a9; font-weight: 300; }

        .input-group .form-control { border-radius: 12px 0 0 12px !important; }

        .btn-toggle-pass {
            border: 1.5px solid #e3e1f7;
            border-left: none;
            border-radius: 0 12px 12px 0;
            background: #faf9ff;
            color: #888780;
            padding: 0 14px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .btn-toggle-pass:hover { background: var(--primary-light); color: var(--primary-dark); }

        .show-pass-label {
            font-size: 0.8rem;
            color: #888780;
            font-weight: 300;
            cursor: pointer;
            user-select: none;
        }

        .show-pass-label:hover { color: var(--primary-dark); }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-login {
            background: var(--primary-dark);
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-family: 'Lexend', sans-serif;
            font-weight: 500;
            font-size: 0.95rem;
            color: #fff;
            width: 100%;
            letter-spacing: 0.3px;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-login:hover { background: var(--primary); color: #fff; }
        .btn-login:active { transform: scale(0.98); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d3d1c7;
            font-size: 0.8rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e8e6f4;
        }

        .btn-register {
            background: var(--primary-light);
            border: 1.5px solid #AFA9EC;
            border-radius: 12px;
            padding: 0.65rem;
            font-family: 'Lexend', sans-serif;
            font-weight: 500;
            font-size: 0.9rem;
            color: var(--primary-dark);
            width: 100%;
            text-decoration: none;
            display: block;
            text-align: center;
            transition: background 0.2s, border-color 0.2s;
        }

        .btn-register:hover {
            background: #CECBF6;
            border-color: var(--primary);
            color: var(--primary-dark);
        }

        .alert-error {
            background: #FCEBEB;
            border: 1px solid #F7C1C1;
            border-radius: 12px;
            color: #791F1F;
            font-size: 0.85rem;
            font-weight: 400;
            padding: 0.7rem 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-text {
            font-size: 0.75rem;
            color: #b4b2a9;
            text-align: center;
            margin-top: 1.5rem;
            font-weight: 300;
        }

        .footer-text a { color: var(--primary); text-decoration: none; }
        .footer-text a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-card">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="brand-logo">HB<span>G</span></div>
            <span class="badge-gacha">✦ Gacha Portal</span>
        </div>

        <h1 class="login-title">Selamat datang!</h1>
        <p class="login-subtitle mb-4">Masuk ke akun HB Gacha kamu</p>

        <?php if(!empty($error)): ?>
        <div class="alert-error mb-3">
            <i class="bi bi-exclamation-circle-fill"></i>
            <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form method="POST" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="nama@email.com"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    required
                    autocomplete="email"
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="btn-toggle-pass" id="togglePass" aria-label="Tampilkan/sembunyikan password">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex align-items-center mb-4">
                <input class="form-check-input me-2" type="checkbox" id="showPass">
                <label class="show-pass-label" for="showPass">Tampilkan password</label>
            </div>

            <button type="submit" name="submit" class="btn-login mb-3">
                Masuk <i class="bi bi-arrow-right ms-1"></i>
            </button>

            <div class="divider mb-3">atau</div>

            <a href="register.php" class="btn-register">
                <i class="bi bi-person-plus me-1"></i> Buat akun baru
            </a>
        </form>
    </div>

    <script src="library/script.js"></script>
</body>
</html>
