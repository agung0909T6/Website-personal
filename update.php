<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM keuangan WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $pemasukan = $_POST['pemasukan'];
    $pengeluaran = $_POST['pengeluaran'];

    // Menghitung mutasi dan saldo
    $mutasi = $pemasukan - $pengeluaran;
    $saldo = $mutasi;

    $sql = "UPDATE keuangan SET tanggal = ?, keterangan = ?, pemasukan = ?, pengeluaran = ?, mutasi = ?, saldo = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tanggal, $keterangan, $pemasukan, $pengeluaran, $mutasi, $saldo, $id]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Transaksi</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $row['tanggal'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $row['keterangan'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="pemasukan" class="form-label">Pemasukan</label>
                <input type="number" class="form-control" id="pemasukan" name="pemasukan" value="<?= $row['pemasukan'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="pengeluaran" class="form-label">Pengeluaran</label>
                <input type="number" class="form-control" id="pengeluaran" name="pengeluaran" value="<?= $row['pengeluaran'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
