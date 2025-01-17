<?php
// Veritabanı bağlantısı ayarları
$servername = "localhost";
$username = "root"; // Veritabanı kullanıcı adınız
$password = ""; // Veritabanı şifreniz
$dbname = "zehra_kitchen";

// Veritabanı bağlantısı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Form gönderildiğinde rezervasyonu kaydet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_soyad = $conn->real_escape_string(trim($_POST['name']));
    $telefon = $conn->real_escape_string(trim($_POST['phone']));
    $tarih = $conn->real_escape_string(trim($_POST['date']));
    $saat = $conn->real_escape_string(trim($_POST['time']));
    $kisi_sayisi = (int) $_POST['guests'];
    $notlar = $conn->real_escape_string(trim($_POST['notes']));

    if (!empty($ad_soyad) && !empty($telefon) && !empty($tarih) && !empty($saat) && $kisi_sayisi > 0) {
        $sql = "INSERT INTO rezervasyonlar (ad_soyad, telefon, tarih, saat, kisi_sayisi, notlar)
                VALUES ('$ad_soyad', '$telefon', '$tarih', '$saat', $kisi_sayisi, '$notlar')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Rezervasyon başarıyla alındı!</p>";
        } else {
            echo "<p style='color: red;'>Bir hata oluştu: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Lütfen tüm gerekli alanları doldurun.</p>";
    }
}


$sql = "SELECT ad_soyad, telefon, tarih, saat, kisi_sayisi, notlar FROM rezervasyonlar ORDER BY tarih, saat";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyon</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-section { max-width: 600px; margin: 0 auto; }
        .form-section input, .form-section textarea, .form-section button {
            width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;
        }
        .reservation-list { max-width: 600px; margin: 20px auto; }
        .reservation { border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 5px; }
        .reservation h4 { margin: 0 0 5px; }
        .reservation p { margin: 0; }
    </style>
</head>
<body>
    <div class="form-section">
        <h2>Masa Rezervasyonu Yap</h2>
        <form method="post" action="rezervasyon.php">
            <input type="text" name="name" placeholder="Ad Soyad" required>
            <input type="tel" name="phone" placeholder="Telefon Numarası" required>
            <input type="date" name="date" required>
            <input type="time" name="time" required>
            <input type="number" name="guests" placeholder="Kişi Sayısı" min="1" required>
            <textarea name="notes" placeholder="Notlar (isteğe bağlı)" rows="4"></textarea>
            <button type="submit">Rezervasyonu Gönder</button>
        </form>
    </div>

    <div class="reservation-list">
        <h2>Rezervasyonlar</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='reservation'>";
                echo "<h4>" . htmlspecialchars($row['ad_soyad']) . " - " . htmlspecialchars($row['telefon']) . "</h4>";
                echo "<p><strong>Tarih:</strong> " . $row['tarih'] . " <strong>Saat:</strong> " . $row['saat'] . "</p>";
                echo "<p><strong>Kişi Sayısı:</strong> " . $row['kisi_sayisi'] . "</p>";
                if (!empty($row['notlar'])) {
                    echo "<p><strong>Notlar:</strong> " . htmlspecialchars($row['notlar']) . "</p>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>Henüz rezervasyon yapılmamış.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
