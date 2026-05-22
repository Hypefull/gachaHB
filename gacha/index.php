<?php
    session_start();
    require_once('library/connect.php');
    if(!isset($_SESSION['name'])){
        header("location: login.php");
    }

    if(isset($_POST['signout'])){
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        session_destroy();
        header("location: login.php");
    }
    $query2 = "SELECT * from user where id=".$_SESSION['id'];
    $result2 = $connection->query($query2);
    $row2 = $result2->fetch_assoc();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HB Gacha</title>
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

        .navbar {
            background: #2e5aa7 !important;
            border-bottom: 1px solid #ffa62b;
            backdrop-filter: blur(12px);
            position: relative;
            top: 0;
            z-index: 99;
        }
        .navbar-brand {
            font-family: "Bagel Fat One", system-ui;
            color: #43302e;
            font-size: 35px;
            text-shadow: 0 0 20px #fff3e7;
            letter-spacing: 2px;
        }
        .nav-link { color: #ffa62b !important; font-weight: 600; transition: color 0.2s; }
        .nav-link:hover { color: #43302e !important; }
        .btn-nav-gacha {
            background: #c1dbe8;
            border: none;
            color: #2e5aa7;
            font-weight: 700;
            border-radius: 20px;
            padding: 6px 20px;
            font-size: 0.85rem;
            letter-spacing: 1px;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .profil {
            color: #43302e;
            position: fixed;
            top: 0;
            right: -500px; 
            width: 300px;
            height: 100%;
            background: #ffa62b;
            padding: 20px;
            transition: 0.5s;
            z-index: 100;
        }
        .profil.active {
            right: 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        .section-badge {
            display: inline-block;
            background: #c1dbe8;
            border: 1px solid #2e5aa7;
            color: #43302e;
            font-size: 0.7rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            padding: 4px 16px;
            border-radius: 20px;
            margin-bottom: 12px;
        }
        .section-title {
            font-family: "Darumadrop One", sans-serif;
            font-weight: 400;
            background: #43302e;
            color: #f7f4d5;
        }
        .section-divider {
            width: 300px; height: 2px;
            background: linear-gradient(90deg, transparent, #43302e, transparent);
            margin: 16px auto 0;
        }

        .char-section { position: relative; z-index: 1; padding: 80px 0; }
        .char-card {
            background-color: #43302e;
            align-content: center;
            text-align: center;
            font-size: 2rem;
            position: relative;
            border-radius: 16px;
            border-color: #ffa62b;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            height: 200px;
            color: #f7f4d5;
        }
        .char-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        }
        .char-card a{
            color: inherit;
            text-decoration: none;
        }
        .gacha-section { position: relative; z-index: 1; padding: 80px 0; }
        .gacha-card {
            background-color: #43302e;
            align-content: center;
            text-align: center;
            font-size: 2rem;
            position: relative;
            border-radius: 16px;
            border-color: #ffa62b;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            height: 200px;
            color: #f7f4d5;
        }
        .gacha-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        }
        .gacha-card a{
            color: inherit;
            text-decoration: none;
        }
        footer {
            background: #2e5aa7;
            border-top: 1px solid #ffa62b;
            position: relative;
            z-index: 1;
        }
        .footer-brand {
            font-family: "Bagel Fat One", system-ui;
            color: #43302e;
            font-size: 50px;
            text-shadow: 0 0 20px #fff3e7;
            letter-spacing: 2px;
        }
        .footer-tagline { color: #c1dbe8; font-size: 0.8rem; }
        .footer-link { color: #ffa62b; font-size: 0.82rem; text-decoration: none; transition: color 0.15s; }
        .footer-link:hover { color: #43302e; }
        .footer-bottom { font-size: 0.75rem; color: #2e5aa7; }

    </style>
    </head>
    <body>
        <!-- NAVIGATION BAR -->
        <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">HB<span>Gacha</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto ms-4 gap-2">
                <li class="nav-item"><a class="nav-link" href="#" onclick="openprofil()">Profile</a>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#karakter">Character</a></li>
                <li class="nav-item"><a class="nav-link" href="#gacha">Gacha</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <button class="btn-nav-gacha" onclick="document.getElementById('gacha').scrollIntoView({behavior:'smooth'})"> TARIK SEKARANG</button>
            </div>
            </div>
        </div>
        </nav>

        <!--Profil-->
        <div class="profil" id="profileBox">
            <h2 style="text-align: center;">My Profile</h2>
            <div style="height: 2px; background: linear-gradient(to right, transparent, #43302e, transparent); margin: 20px 0;"></div>
            <p style="font-size:30px;color:#fff3e7;">Welcome,  <?php echo $row2['name'];?></p>
            <p style="font-size:1.5 rem;color:#fff3e7;">💎 <span id="navGems"><?php echo $row2['gems'];?></span></p>
            <a href="login.php" id="signout" name="signout" style="cursor: pointer; color: #43302e; text-decoration: none;">Signout</a> <br> <br>
            <a onclick="closeprofil()" style="cursor: pointer; color: #43302e;">Close</a>
        </div>
        
        <!--About-->
        <section class="about-section" id="about">
        <div class="container">
            <br>
            <div class="section-header fade-in">
            <div class="section-badge">About</div>
            <h2 class="section-title">About This Cool Website</h2>
            <div class="section-divider"></div>
            <br>
            <p style="font-size: 30px">"Welcome to our gacha world, where you can collect over 60 unique characters including 30 waifus and 30 husbandos, each with their own style and rarity. Roll your luck, build your dream collection, and discover your favorite characters through exciting pulls and rewards. Whether you're here for cute, cool, elegant, or chaotic vibes, there’s always someone waiting for you in the next summon." -ChatGPT</p>
            <img src="rainbows.jpg" width=500 height=400>
            <p>Yang penting enjoy dan emang ada yang baca ini?</p>
        </div>
        </section>
        
        <!--Karakter-->
        <section class="char-section" id="karakter">
        <div class="container">
            <div class="section-header fade-in">
            <div class="section-badge">Characters</div>
            <h2 class="section-title">Koleksi Husbu dan Waifu :3 !!</h2>
            <div class="section-divider"></div>
        </div>
        <div class="char-card">
            <a href="husbu/library.php">Husbu Lists :3</a>
        </div>
        <br>
        <br>
        <br>
        <div class="char-card">
            <a href="waifu/library.php">Waifu Lists :3</a>
        </div>
        </section>

        <!--Gacha-->
        <section class="gacha-section" id="gacha">
        <div class="container">
            <div class="section-header fade-in">
            <div class="section-badge">Gacha</div>
            <h2 class="section-title">The [BIG SHOT] !!</h2>
            <div class="section-divider"></div>
        </div>
        <div class="gacha-card">
            <a href="husbu/gacha.php">Husbu</a>
        </div>
        <br>
        <br>
        <br>
        <div class="gacha-card">
            <a href="waifu/gacha.php">Waifu</a>
        </div>
        </section>

        <!--Footer-->
        <footer class="py-5">
        <div class="container">
            <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="footer-brand">HB Gacha</div>
            </div>
            <div class="col-6 col-md-2">
                <div style="font-size:0.7rem;letter-spacing:3px;color:#ffa62b;text-transform:uppercase;margin-bottom:12px;">Permainan</div>
                <div class="d-flex flex-column gap-2">
                <a href="#about" class="footer-link">About</a>
                <a href="#karakter" class="footer-link">Character</a>
                <a href="#gacha" class="footer-link">Gacha</a>
                </div>
            </div>
            <div class="col-md-4">
                <div style="font-size:0.7rem;letter-spacing:3px;color:#ffa62b;text-transform:uppercase;margin-bottom:12px;">Dapatkan Update</div>
                <p style="font-size:0.78rem;color:#ffa62b;margin-bottom:12px;">Daftar untuk mendapat notifikasi scam eksklusif.</p>
                <div class="d-flex gap-2">
                <input type="email" class="form-control" placeholder="Email kamu..." style="background:#f7f4d5;border:1px solid #ffa62b;color:#e2d9f3;font-size:0.82rem;border-radius:8px;" />
                <button class="btn" style="background:#f7f4d5;color:#43302e;font-weight:700;font-size:0.8rem;white-space:nowrap;border-radius:8px;">Daftar</button>
                </div>
            </div>
            </div>
            <hr style="border-color:#f7f4d5;">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 footer-bottom">
            <span>© 2026 HBGachaTeam. Hak cipta dilindungi.</span>
            <span>Dibuat untuk bersenang-senang · Bukan untuk perjudian nyata</span>
            </div>
        </div>
        </footer>

        <!--Script-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script>
        function openprofil() {
            document.getElementById("profileBox")
            .classList.add("active");
        }

        function closeprofil() {
            document.getElementById("profileBox")
            .classList.remove("active");
        }
        </script>
    </body>
    </html>