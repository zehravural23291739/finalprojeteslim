<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="son.css">
    <title>Giriş Yap</title>
</head>
<body>
    <div class="container">
        <h1>Giris Yap</h1>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="sifre" placeholder="Şifre" required>
            <button type="submit" name="giris">Giris Yap</button>
        </form>
    </div>

    <?php
    if (isset($_POST['giris'])) {
        $email = $_POST['email'];
        $sifre = $_POST['sifre'];

        $stmt = $pdo->prepare("SELECT * FROM kullanicilar WHERE email = ?");
        $stmt->execute([$email]);
        $kullanici = $stmt->fetch();

        if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
            echo "<p>Giriş başarılı! Hoş geldiniz, {$kullanici['ad']}.</p>";
        } else {
            echo "<p>Email veya şifre hatalı!</p>";
        }
    }
    ?>
</body>
</html>
