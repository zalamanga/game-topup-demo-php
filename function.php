<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = mysqli_connect(getenv('DB_HOST') ?: '127.0.0.1', getenv('DB_USER') ?: 'demo_user', getenv('DB_PASSWORD') ?: '', getenv('DB_NAME') ?: 'game_topup_demo');
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    http_response_code(503);
    exit('Database demo belum tersedia. Periksa konfigurasi lokal.');
}

function executeStatement(string $sql, string $types = '', array $values = []): mysqli_stmt {
    global $conn;
    $statement = $conn->prepare($sql);
    if ($types !== '') $statement->bind_param($types, ...$values);
    $statement->execute();
    return $statement;
}

function query($sql): array {
    global $conn;
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

function requireAdmin(): void {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (empty($_SESSION['login']) || ($_SESSION['role'] ?? '') !== 'admin') {
        http_response_code(403);
        exit('Halaman ini hanya untuk admin demo.');
    }
}

function registrasi($data) {
    $username = strtolower(trim($data['username'] ?? ''));
    $password = $data['password'] ?? '';
    if (!preg_match('/^[a-z0-9_]{3,32}$/', $username) || strlen($password) < 10 || strlen($password) > 72 || $password !== ($data['password2'] ?? '')) return false;
    $exists = executeStatement('SELECT id FROM user WHERE username=?', 's', [$username])->get_result()->fetch_assoc();
    if ($exists) return false;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    executeStatement('INSERT INTO user (username,password,role) VALUES (?, ?, ?)', 'sss', [$username, $hash, 'user']);
    header('Location: login.php');
    exit;
}

function changePackage(string $table, array $data, bool $update): int {
    if (!in_array($table, ['diamonff','diamonml','diamonpubg'], true)) return 0;
    $quantity = filter_var($data['jumlahdm'] ?? null, FILTER_VALIDATE_INT);
    $price = filter_var($data['hargadm'] ?? null, FILTER_VALIDATE_FLOAT);
    if ($quantity === false || $quantity <= 0 || $price === false || $price < 0) return 0;
    if ($update) {
        $id = (int) ($data['id'] ?? 0);
        return executeStatement("UPDATE $table SET jumlahdm=?,hargadm=? WHERE id=?", 'idi', [$quantity,$price,$id])->affected_rows;
    }
    return executeStatement("INSERT INTO $table (jumlahdm,hargadm) VALUES (?,?)", 'id', [$quantity,$price])->affected_rows;
}
function deletePackage(string $table, $id): int {
    if (!in_array($table, ['diamonff','diamonml','diamonpubg'], true)) return 0;
    return executeStatement("DELETE FROM $table WHERE id=?", 'i', [(int) $id])->affected_rows;
}
function tambahff($data) { return changePackage('diamonff', $data, false); }
function ubahff($data) { return changePackage('diamonff', $data, true); }
function hapusff($id) { return deletePackage('diamonff', $id); }
function tambahpubg($data) { return changePackage('diamonpubg', $data, false); }
function ubahpubg($data) { return changePackage('diamonpubg', $data, true); }
function hapuspubg($id) { return deletePackage('diamonpubg', $id); }
function tambah($data) { return changePackage('diamonml', $data, false); }
function ubah($data) { return changePackage('diamonml', $data, true); }
function hapus($id) { return deletePackage('diamonml', $id); }

function tambahTransaksi($data) {
    $game = trim($data['game'] ?? '');
    $lower = strtolower($game);
    $table = str_contains($lower, 'free') ? 'diamonff' : (str_contains($lower, 'pubg') ? 'diamonpubg' : (str_contains($lower, 'mobile') ? 'diamonml' : null));
    $quantity = (int) ($data['jumlahdm'] ?? 0);
    $name = trim($data['name'] ?? '');
    $gameID = trim($data['idusergame'] ?? '');
    if (!$table || $quantity <= 0 || $name === '' || strlen($name) > 100 || $gameID === '' || strlen($gameID) > 100) return 0;
    $package = executeStatement("SELECT hargadm FROM $table WHERE jumlahdm=? ORDER BY id LIMIT 1", 'i', [$quantity])->get_result()->fetch_assoc();
    if (!$package) return 0;
    return executeStatement('INSERT INTO transaksi (jumlahdm,hargadm,game,idusergame,name) VALUES (?,?,?,?,?)', 'idsss', [$quantity,(float)$package['hargadm'],$game,$gameID,$name])->affected_rows;
}

function escapeHtml($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
