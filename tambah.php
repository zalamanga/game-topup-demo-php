<?php
session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
requireAdmin();

if( isset($_POST["submit"])){


    if(tambah($_POST) >0 ){
        echo "
            <script>
                alert('data berhasil ditambah');
                document.location.href = 'admin.php'
            </script>
        ";
    }else {
        echo "
            <script>
                alert('data gagal ditambah');
                document.location.href = 'admin.php'
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
    <title>Tambah Data diamon</title>
    <link rel="stylesheet" href="tambah.css">

</head>

<body>
    <div class="container">
        <h1>Tambah Data Diamond</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="jumlahdm">Jumlah Diamond:</label>
                <input type="text" name="jumlahdm" id="jumlahdm" pattern="\d+" required>
            </div>

            <div class="form-group">
                <label for="hargadm">Harga Diamond:</label>
                <input type="text" name="hargadm" id="hargadm" pattern="\d+" required>
            </div>

            <div class="form-group">
                <button type="submit" name="submit">Tambah Data</button>
            </div>
        </form>
    </div>
</body>

</html>