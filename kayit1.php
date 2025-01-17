<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="son.css">
    <title>Kayıt Ol</title>
</head>
<body>
    <div class="container">
        <h1>Kayıt Ol</h1>
        <form action="" method="POST">
            <input type="text" name="ad" placeholder="Adınız" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="sifre" placeholder="Şifre" required>
            <button type="submit" name="kayit">Kayıt Ol</button>
        </form>
    </div>

    <?php
    if (isset($_POST['kayit'])) {
        $ad = $_POST['ad'];
        $email = $_POST['email'];
        $sifre = password_hash($_POST['sifre'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO kullanicilar (ad, email, sifre) VALUES (?, ?, ?)");
        if ($stmt->execute([$ad, $email, $sifre])) {
            echo "<p>Kayıt başarılı!</p>";
        } else {
            echo "<p>Bir hata oluştu!</p>";
        }
    }
    ?>
</body>
</html>
