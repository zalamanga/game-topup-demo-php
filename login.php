<?php
session_start();
require 'function.php';
if (isset($_POST['login'])) {
    $username = strtolower(trim($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';
    $row = executeStatement('SELECT id,username,password,role FROM user WHERE username=?', 's', [$username])->get_result()->fetch_assoc();
    if ($row && password_verify($password, $row['password'])) {
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = (int) $row['id'];
        $_SESSION['role'] = $row['role'];
        header('Location: ' . ($row['role'] === 'admin' ? 'admin.php' : 'index.php'));
        exit;
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="login.css" />

</head>

<body>

    <main>
        <article class="login" id="login">
            <div class="container">
                <div class="title">
                    <h1>Login</h1>
                </div>

                <div class="form">
                    <?php if(isset($error)) : ?>
                    <p style="color: red; font-style:italic;">Username/Password Salah</p>
                    <?php endif ; ?>

                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="username">Username :</label>
                                <input type="text" name="username" id="username" required>
                            </li>
                            <li>
                                <label for="password">Password :</label>
                                <input type="password" name="password" id="password" required>
                            </li>
                            <li>
                                <button type="submit" name="login">Login</button>
                            </li>
                        </ul>
                    </form>
                    <a href="registrasi.php">Belum punya akun?</a>
                </div>
            </div>
        </article>
    </main>
</body>

</html>