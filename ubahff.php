<?php
session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
requireAdmin();

$id = (int) ($_GET['id'] ?? 0);

$dm = query("SELECT * FROM diamonff WHERE id = $id")[0];


if( isset($_POST["submit"])){


    if( ubahff ($_POST) >  0 ){
        echo "
            <script>
                alert('data berhasil diubah');
                document.location.href = 'ff.php'
            </script>
        ";
    }else {
        echo "
            <script>
                alert('data gagal diubah');
                document.location.href = 'ff.php'
            </script>
    ";
    };
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah Data diamond</title>
    <link rel="stylesheet" href="ubah.css">

</head>

<body>
    <div class="container">
        <h1>Ubah Data Diamond</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= escapeHtml($dm['id']); ?>">

            <div class="form-group">
                <label for="jumlahdm">Jumlah Diamond:</label>
                <input type="text" name="jumlahdm" id="jumlahdm" pattern="\d+" value="<?= escapeHtml($dm['jumlahdm']); ?>" required>
            </div>

            <div class="form-group">
                <label for="hargadm">Harga Diamond:</label>
                <input type="text" name="hargadm" id="hargadm" pattern="\d+" value="<?= escapeHtml($dm['hargadm']); ?>" required>
            </div>

            <div class="form-group">
                <button type="submit" name="submit">Ubah Data</button>
            </div>
        </form>
    </div>
</body>

</html>