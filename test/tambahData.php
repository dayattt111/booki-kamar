<?php
session_start();

// Inisialisasi array untuk menyimpan data
if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = [];
}

// Proses form ketika data dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tambah'])) {
        $nama = $_POST['nama'] ?? '';
        $umur = $_POST['umur'] ?? '';
        
        // Tambahkan data ke array sesi
        $_SESSION['data'][] = [
            'nama' => htmlspecialchars($nama),
            'umur' => htmlspecialchars($umur)
        ];
    } elseif (isset($_POST['hapus_satu'])) {
        // Hapus data berdasarkan indeks
        $index = $_POST['index'] ?? -1;
        if ($index >= 0 && $index < count($_SESSION['data'])) {
            unset($_SESSION['data'][$index]);
            $_SESSION['data'] = array_values($_SESSION['data']); // Re-index array
        }
    } elseif (isset($_POST['hapus_semua'])) {
        // Hapus semua data
        $_SESSION['data'] = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Tanpa JS</title>
</head>
<body>
    <h1>Form Input Data</h1>
    <!-- Form Input Data -->
    <form method="post" action="">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <br>
        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" required>
        <br><br>
        <button type="submit" name="tambah">Simpan</button>
    </form>

    <h2>Data yang Telah Dimasukkan</h2>
    <!-- Tabel Menampilkan Data -->
    <?php if (!empty($_SESSION['data'])): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['data'] as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= $item['nama']; ?></td>
                        <td><?= $item['umur']; ?></td>
                        <td>
                            <!-- Tombol Hapus Satu -->
                            <form method="post" action="" style="display: inline;">
                                <input type="hidden" name="index" value="<?= $index; ?>">
                                <button type="submit" name="hapus_satu">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <!-- Tombol Hapus Semua -->
        <form method="post" action="">
            <button type="submit" name="hapus_semua">Hapus Semua</button>
        </form>
    <?php else: ?>
        <p>Belum ada data yang dimasukkan.</p>
    <?php endif; ?>
</body>
</html>
