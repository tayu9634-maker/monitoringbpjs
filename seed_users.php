<?php
require_once __DIR__ . '/config/database.php';

// Data admin yang ingin disisipkan
$adminUsername = 'admin';
$adminEmail = 'admin@example.com';
$adminPlainPassword = 'Admin123!';

// Hash password
$passwordHash = password_hash($adminPlainPassword, PASSWORD_DEFAULT);

// Cek apakah user sudah ada (berdasarkan username atau email)
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param('ss', $adminUsername, $adminEmail);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Admin sudah ada. Tidak ada yang diubah.\n";
    $stmt->close();
    exit;
}
$stmt->close();

// Insert admin
$insert = $conn->prepare("INSERT INTO users (username, email, password, confirm_password) VALUES (?, ?, ?, ?)");
$insert->bind_param('ssss', $adminUsername, $adminEmail, $passwordHash, $passwordHash);

if ($insert->execute()) {
    echo "Admin berhasil ditambahkan.\n";
    echo "Username: $adminUsername\n";
    echo "Password: $adminPlainPassword\n";
} else {
    echo "Gagal menambahkan admin: " . $conn->error . "\n";
}

$insert->close();
$conn->close();

?>
