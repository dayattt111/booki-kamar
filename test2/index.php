<?php 
    include 'data.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar</title>
</head>
<body>
    <h1>Daftar Kamar</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nomor Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($rooms as $index => $room): ?>
            <tr>
                <td><?= $room['room_number']; ?></td>
                <td><?= $room['room_type']; ?></td>
                <td>Rp <?= number_format($room['price'], 2, ',', '.'); ?></td>
                <td><?= ucfirst($room['status']); ?></td>
                <td>
                    <?php if ($room['status'] === 'available'): ?>
                        <a href="book.php?index=<?= $index; ?>">Book Now</a>
                    <?php else: ?>
                        Tidak Tersedia
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
