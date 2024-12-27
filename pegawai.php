<?php
// Memasukkan file konfigurasi database
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Query untuk mengambil data pegawai
$sql = "SELECT * FROM pegawai ORDER BY id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pegawai = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Jika tidak ada data, set variabel $pegawai menjadi array kosong
if (!$pegawai) {
    $pegawai = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .btn-exit {
            background-color: #dc3545;
            color: white;
        }
        .btn-exit:hover {
            background-color: #c82333;
        }
        @media print {
            body {
                font-size: 12pt;
            }
            .btn, .btn-custom, .btn-exit {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Data Pegawai</h2>
        <a href="create_pegawai.php" class="btn btn-primary mb-3">Tambah Pegawai</a>
        <div class="d-flex mb-3">
            <button class="btn btn-info me-2" onclick="window.print()">Print</button>
            <a href="index.php" class="btn btn-exit">Keluar</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pegawai)): ?>
                    <?php foreach ($pegawai as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['divisi']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td>
                            <a href="update_pegawai.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_pegawai.php?id=<?= $row['id'] ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Tidak ada data pegawai.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
