<?php
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
require dirname(__DIR__) . '/function.php';
$username = strtolower(trim(getenv('ADMIN_USERNAME') ?: ''));
$password = getenv('ADMIN_PASSWORD') ?: '';
if (!preg_match('/^[a-z0-9_]{3,32}$/', $username) || strlen($password) < 10 || strlen($password) > 72) {
    fwrite(STDERR, "Isi ADMIN_USERNAME dan ADMIN_PASSWORD (10 sampai 72 byte) untuk admin demo.\n");
    exit(1);
}
$hash = password_hash($password, PASSWORD_DEFAULT);
executeStatement("INSERT INTO user (username,password,role) VALUES (?,?,'admin') ON DUPLICATE KEY UPDATE password=VALUES(password),role='admin'", 'ss', [$username,$hash]);
echo "Admin demo tersimpan.\n";
