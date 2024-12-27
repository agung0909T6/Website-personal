<?php
// Cek apakah session sudah dimulai, jika belum baru mulai session
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Memulai sesi pengguna
}

$host = 'localhost';  // Sesuaikan dengan host database Anda
$dbname = 'keuangan_db'; // Nama database
$username = 'root';   // Sesuaikan dengan username database Anda
$password = '';       // Sesuaikan dengan password database Anda

try {
    // Membuat koneksi ke database menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Mengatur mode error menjadi exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Menangani error jika koneksi gagal
    echo "Koneksi gagal: " . $e->getMessage();
    exit();
}
?>
