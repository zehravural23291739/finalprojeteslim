<?php
require_once 'database.php'; // Veritabanı bağlantısını dahil et

$sql = "SELECT id, name, email, age FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Listesi</title>
</head>
<body>
    <h1>Kullanıcılar</h1>
    <a href="add_user.php">Yeni Kullanıcı Ekle</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Adı</th>
            <th>E-posta</th>
            <th>Yaş</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['age'] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Hiç kullanıcı yok.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
