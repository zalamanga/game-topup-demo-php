<?php

session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
requireAdmin();

$diamon = query("SELECT * FROM diamonml");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="admin.css" />
    

</head>

<body>
    <header>
        <nav>
            <div class="container">
                <div class="logo">
                    <a href="admin.php"><span>ASIK</span>PEDIA</a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a class="active" href="admin.php">Mobile Legend</a></li>
                        <li><a href="ff.php">Free Fire</a></li>
                        <li><a href="pubg.php">PUBG</a></li>
                        <li><a href="transaksi.php">Transaksi</a></li>
                    </ul>
                </div>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <article class="tabledm">
            <div class="judul">
                <img src="img/logoml.png" alt="logo ml">
            </div>
            <div class="container">
                <div class="tambah">
                    <a href="tambah.php">
                        <h1>Tambah Data Diamond </h1><i class="fa-solid fa-plus" style="color: #74C0FC;"></i>
                    </a>
                </div>
                <div class="table">
                    <table>

                        <tr>

                            <th>no.</th>
                            <th>Jumlah Diamon</th>
                            <th>Harga Diamon</th>
                            <th>Aksi</th>

                        </tr>
                        <?php $i = 1; ?>
                        <?php  foreach( $diamon as $row): ?>
                        <tr>
                            <td><?= $i ;?> </td>
                            <td>
                                <img src="img/diamon.png" alt="Diamon" class="diamond-icon">
                                <?= escapeHtml($row["jumlahdm"]); ?>
                            </td>
                            <td>Rp. <?= escapeHtml($row["hargadm"]); ?></td>
                            <td class="aksi">
                                <a href="ubah.php?id= <?= escapeHtml($row["id"]); ?>">ubah</a> |
                                <a href="hapus.php?id= <?= escapeHtml($row["id"]); ?>" onclick="
                            return confirm ('yakin?')">hapus</a>
                            </td>
                        </tr>
                        <?php $i++ ; ?>
                        <?php endforeach ; ?>

                    </table>
                </div>
            </div>
        </article>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="admin.php"><span>ASIK</span>PEDIA</a>
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