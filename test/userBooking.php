<?php
include "fungsi.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kamar = $_POST['id'];
    $nama_pemesan = $_POST['nama_pemesan'];

    // Simpan nama pemesan ke sesi
    if (!isset($_SESSION['booked_rooms'])) {
        $_SESSION['booked_rooms'] = [];
    }
    $_SESSION['booked_rooms'][$id_kamar] = $nama_pemesan;

    // Redirect kembali ke halaman utama
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking</title>
</head>
<body>
    <h1>Form Booking</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">
        <label for="nama_pemesan">Nama Pemesan:</label>
        <input type="text" id="nama_pemesan" name="nama_pemesan" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
