<?php
session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
requireAdmin();

$id = (int) ($_GET['id'] ?? 0);

if (function_exists('hapus')) {
    echo "Fungsi hapus ada";
} else {
    echo "Fungsi hapus tidak ada";
}

if(hapusff($id) > 0 ) {
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = 'ff.php'
        </script>
    ";
} else {
    echo "
    <script>
        alert('data gagal dihapus');
        document.location.href = 'ff.php'
    </script>
";
}

?>