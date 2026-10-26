<?php

session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="index.css" />

</head>

<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo">
                    <a href="index.php"><span>ASIK</span>PEDIA</a>
                </div>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <article class="home">
            <div class="container">
                <div class="home-desc">
                    <h1>WELCOME TO <span>ASIK</span>PEDIA</h1>
                    <P>Demo pencatatan pesanan game untuk latihan PHP dan MySQL.</P>
                </div>
            </div>
        </article>

        <article class="menu">
            <div class="container">
                <div class="menu-list">
                    <h1>GAME LIST</h1>
                    <ul>
                        <li>
                            <a href="mldm.php">
                                <img src="img/mobilelegends.webp" alt="Mobile Legends">
                                <span>MOBILE LEGENDS</span>
                            </a>
                        </li>
                        <li>
                            <a href="ffdm.php">
                                <img src="img/freefire.webp" alt="Free Fire">
                                <span>FREE FIRE</span>
                            </a>
                        </li>
                        <li>
                            <a href="pubgdm.php">
                                <img src="img/pabji.jpeg" alt="PUBG">
                                <span>PUBG MOBILE</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </article>

    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="index.php"><span>ASIK</span>PEDIA</a>
                </div>
                <div class="footer-info">
                    <p>&copy; 2024 ASIKPEDIA. All rights reserved.</p>
                    <p>Designed by YourName</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>