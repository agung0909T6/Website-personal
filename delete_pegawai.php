<?php
// Memasukkan file config.php yang berisi koneksi dan session_start
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah id pegawai diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data pegawai berdasarkan id
    $sql = "DELETE FROM pegawai WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Redirect ke halaman pegawai setelah penghapusan
    header("Location: pegawai.php");
    exit();
} else {
    // Jika id tidak ada, alihkan ke halaman pegawai
    header("Location: pegawai.php");
    exit();
}
