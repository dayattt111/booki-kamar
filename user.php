<?php
include "fungsi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .card.greyed-out {
            background-color: gray;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Daftar Kamar</h1>
    <!-- menampilkan data kamar -->
    <div class="room-stats" style="text-align: center; margin-bottom: 20px;">
        <p>Total Kamar: <?= count($_SESSION['kamar']); ?> </p>
        <p>Kamar Yang sudah di booking: <?= countAvailable() ?></p>
        <p>Kamar Kosong: <?= countNotAvailable() ?></p>
        <form method="POST">

            <button name="reset"> Reset </button>
        </form>
    </div>
    <div class="container">
        <?php foreach ($_SESSION['kamar'] as $item): ?>
            <div class="card <?= $item['status'] ? '' : 'greyed-out' ?>">
                <img src="<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>">
                <div class="card-content">
                    <h3><?= $item['nama'] ?></h3>
                    <p><?= $item['deskripsi'] ?></p>
                    <p>Rp. <?= $item['harga'] ?></p>
                    <form method="POST">
                        <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                        <input type="hidden" name="nama[]" value="<?= $item['nama'] ?>">

                        <button class="btn-pesan" type="submit" name="pesan" <?= $item['status'] ? '' : 'disabled'; ?>>
                            Pesan Kamar
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>