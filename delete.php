<?php
// Memasukkan file config.php untuk koneksi ke database
include 'config.php';

// Cek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Membuat pernyataan SQL untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM keuangan WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Menjalankan query dan mengarahkan pengguna kembali ke halaman utama jika berhasil
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
