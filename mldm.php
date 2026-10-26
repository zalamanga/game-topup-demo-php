<?php
require 'function.php';

// Mengambil data dari tabel diamonml
$diamonds = query("SELECT id, jumlahdm, hargadm FROM diamonml");

// Membuat array harga untuk PHP
$prices = [];
foreach ($diamonds as $diamond) {
    $prices[$diamond['jumlahdm']] = $diamond['hargadm'];
}

$total_price = '';
$selected_diamond = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_diamond = $_POST['diamond'];
    if (isset($prices[$selected_diamond])) {
        $total_price = $prices[$selected_diamond];
        
        // Memasukkan data ke dalam database jika formulir telah terisi
        if (!empty($_POST['game_id']) && !empty($_POST['name'])) {
            $data = [
                'jumlahdm' => $selected_diamond,
                'hargadm' => $total_price,
                'game' => 'MOBILE LEGENDS',
                'idusergame' => $_POST['game_id'],
                'name' => $_POST['name']
            ];
            $result = tambahTransaksi($data);
            // Periksa apakah data berhasil dimasukkan ke dalam database
            if ($result) {
                echo "<script>alert('Pembayaran berhasil!');</script>";
            } else {
                // Jika terjadi kesalahan, Anda dapat menangani secara diam-diam
                // Misalnya, alihkan pengguna ke halaman sebelumnya
                header("Location: mldm.php");
                exit; // Pastikan untuk keluar dari skrip setelah pengalihan header
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Legend</title>
    <link rel="stylesheet" type="text/css" href="order.css" />
    
    <script>
    function validateForm() {
        var diamond = document.getElementById('diamond').value;
        var game_id = document.getElementById('game_id').value;
        var name = document.getElementById('name').value;

        if (diamond === '' || game_id === '' || name === '') {
            alert('Harap lengkapi semua field sebelum melanjutkan pembayaran!');
            return false;
        }
        return true;
    }
    </script>
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
                        <li><a class="active" href="mldm.php">Mobile Legend</a></li>
                        <li><a href="ffdm.php">Free Fire</a></li>
                        <li><a href="pubgdm.php">PUBG</a></li>
                    </ul>
                </div>
                <div class="logout">
                    <a href="index.php">Back</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <article class="order">
            <div class="judul">
                <img src="img/logoml.png" alt="logo ml">
            </div>
            <div class="container">
                <form action="mldm.php" method="POST">
                    <div class="form-group">
                        <label for="diamond">Jumlah Diamond:</label>
                        <select id="diamond" name="diamond" onchange="this.form.submit()">
                            <option value="">Pilih Jumlah Diamond</option>
                            <?php
                            foreach ($diamonds as $diamond) {
                                $selected = ($selected_diamond == $diamond['jumlahdm']) ? 'selected' : '';
                                echo "<option value=\"{$diamond['jumlahdm']}\" $selected>{$diamond['jumlahdm']} Diamond</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Harga:</label>
                        <input type="text" id="total_price" name="total_price" placeholder="Total Harga"
                            value="<?php echo htmlspecialchars($total_price); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="game">Topup Game:</label>
                        <input type="text" id="game" name="game" placeholder="Topup Game" value="MOBILE LEGENDS"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="game_id">ID Username Game:</label>
                        <input type="text" id="game_id" name="game_id" placeholder="ID Username Game" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Pemesan:</label>
                        <input type="text" id="name" name="name" placeholder="Nama Pemesan" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn">Bayar</button>
                    </div>
                </form>
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