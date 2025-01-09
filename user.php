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
</head>
<body>
    <h1 style="text-align: center;">Daftar Kamar</h1>
    <!-- menampilkan data kamar -->
    <div class="room-stats" style="text-align: center; margin-bottom: 20px;">
        <p>Total Kamar: <?= $total_kamar ?> </p>
        <p>Kamar Yang sudah di booking: <?= $kamar_booking ?></p>
        <p>Kamar Kosong: <?= $kamar_kosong ?></p>
    </div>
    <div class="container">
        <?php
        foreach ($kamar as $item) : ?>
            <div class="card <?= in_array($item['id'], $bookinKamar) ? 'greyed-out' : '' ?>">
                <img src="<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>">
                <div class="card-content">
                    <h3><?= $item['nama'] ?></h3>
                    <p><?= $item['deskripsi'] ?></p>
                    <p>Rp. <?= $item['harga'] ?></p>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <?php foreach ($bookinKamar as $room_id) : ?>
                            <input type="hidden" name="booked_rooms[]" value="<?= $room_id ?>">
                        <?php endforeach; ?>
                        <button class="btn-pesan" type="submit" name="pesan" <?= in_array($item['id'], $bookinKamar) ? 'disabled' : '' ?>>
                            Pesan Kamar
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>