<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pastikan $search selalu didefinisikan
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM keuangan WHERE keterangan LIKE :search ORDER BY tanggal ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['search' => "%$search%"]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$data) {
    $data = [];
}

// Hitung total saldo
$totalSaldo = 0;
foreach ($data as $row) {
    $totalSaldo += $row['pemasukan'] - $row['pengeluaran'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            padding-bottom: 50px;
        }

        h2 {
            font-weight: bold;
            font-size: 2.5rem;
            color: #4b6cb7;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding-bottom: 10px;
        }

        h2::after {
            content: '';
            display: block;
            width: 50%;
            height: 4px;
            margin: 0 auto;
            background-color: #dc3545;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .action-buttons .btn {
            font-size: 1rem;
            padding: 10px 20px;
        }

        .action-buttons .btn-primary {
            background-color: #4b6cb7;
            border-color: #4b6cb7;
        }

        .action-buttons .btn-primary:hover {
            background-color: #3a5495;
        }

        .action-buttons .btn-secondary {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .action-buttons .btn-secondary:hover {
            background-color: #c82333;
        }

        .total-saldo {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>DATA KEUANGAN MASYARAKAT BLOK RANCAGANGGANG</h2>

        <!-- Tombol Tambah Transaksi, Admin, dan Keluar -->
        <div class="action-buttons">
            <a href="create.php" class="btn btn-primary">Tambah Transaksi</a>
            <a href="pegawai.php" class="btn btn-secondary">Admin</a>
            <a href="logout.php" class="btn btn-secondary">Keluar</a>
        </div>

        <form class="mb-3 d-flex" method="GET" action="">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari Keterangan..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary me-2">Cari</button>
            <button type="button" class="btn btn-secondary" onclick="printPage()">Print</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php $saldo = 0; ?>
                    <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td><?= number_format($row['pemasukan'], 0, ',', '.') ?></td>
                        <td><?= number_format($row['pengeluaran'], 0, ',', '.') ?></td>
                        <?php $saldo += $row['pemasukan'] - $row['pengeluaran']; ?>
                        <td><?= number_format($saldo, 0, ',', '.') ?></td>
                        <td>
                            <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Tidak ada data transaksi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Total Saldo -->
        <div class="total-saldo">
            <p>Total Saldo Saat Ini: <?= number_format($totalSaldo, 0, ',', '.') ?></p>
        </div>
    </div>
</body>
</html>
