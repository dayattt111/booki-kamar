<?php
include "fungsi.php";
// include "data.php";
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card-content h3 {
            margin: 10px 0;
            font-size: 20px;
            color: #333;
        }
        .card-content p {
            font-size: 14px;
            color: #666;
        }
        .btn-pesan {
            background-color: #007bff;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .btn-reset {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .btn-batal {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Daftar Kamar</h1>
    <div class="room-stats" style="text-align: center; margin-bottom: 20px;">
        <p>Total Kamar: <?= $total_kamar ?></p>
        <p>Kamar Yang sudah di booking: <?= $kamar_booking ?></p>
        <p>Kamar Kosong: <?= $kamar_kosong ?></p>
    </div>
    <div style="text-align: center; margin-bottom: 20px;">
        <form method="POST">
            <button class="btn-reset" type="submit" name="reset">Reset Booking</button>
        </form>
    </div>
    <div class="container">
        <?php foreach ($kamar as $item): ?>
            <div class="card <?= isset($bookinKamar[$item['id']]) ? 'greyed-out' : '' ?>">
                <img src="<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>">
                <div class="card-content">
                    <h3><?= $item['nama'] ?></h3>
                    <p><?= $item['deskripsi'] ?></p>
                    <p>Rp. <?= $item['harga'] ?></p>
                    <?php if (isset($bookinKamar[$item['id']])): ?>
                        <p>Nama Pemesan: <?= getNamaPemesan($item['id']) ?></p>
                        <p>Tanggal Check-in: <?= getTanggalCheckin($item['id']) ?></p>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button class="btn-batal" type="submit" name="batal">Batalkan Booking</button>
                        </form>
                    <?php else: ?>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <label for="nama_pemesan_<?= $item['id'] ?>">Nama Pemesan:</label>
                            <input type="text" id="nama_pemesan_<?= $item['id'] ?>" name="nama_pemesan" required>
                            <label for="tanggal_checkin_<?= $item['id'] ?>">Tanggal Check-in:</label>
                            <input type="date" id="tanggal_checkin_<?= $item['id'] ?>" name="tanggal_checkin" required>
                            <button class="btn-pesan" type="submit" name="pesan">Pesan Kamar</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>