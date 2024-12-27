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

    // Ambil data pegawai berdasarkan id
    $sql = "SELECT * FROM pegawai WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $pegawai = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika data pegawai tidak ditemukan, alihkan ke halaman pegawai
    if (!$pegawai) {
        header("Location: pegawai.php");
        exit();
    }
} else {
    // Jika id tidak ada, alihkan ke halaman pegawai
    header("Location: pegawai.php");
    exit();
}

// Proses saat form disubmit untuk update data pegawai
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang di-submit dari form
    $nama = $_POST['nama'];
    $divisi = $_POST['divisi'];
    $alamat = $_POST['alamat'];

    // Update data pegawai ke database
    $sql = "UPDATE pegawai SET nama = ?, divisi = ?, alamat = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nama, $divisi, $alamat, $id]);

    // Redirect ke halaman pegawai setelah update
    header("Location: pegawai.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Pegawai</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $pegawai['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="divisi" class="form-label">Divisi</label>
                <input type="text" class="form-control" name="divisi" value="<?= $pegawai['divisi'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?= $pegawai['alamat'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
