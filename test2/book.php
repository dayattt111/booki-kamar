<?php
include 'data.php'; // Array kamar dan booking

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $room = $rooms[$index];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'];
    $customer_name = $_POST['customer_name'];
    $booking_date = $_POST['booking_date'];

    // Proses booking
    if ($rooms[$index]['status'] === 'available') {
        $rooms[$index]['status'] = 'booked';

        // Tambahkan data booking
        $bookings[] = [
            "customer_name" => $customer_name,
            "room_number" => $rooms[$index]['room_number'],
            "booking_date" => $booking_date,
        ];

        // Redirect ke halaman utama setelah sukses
        header("Location: Location: http://localhost/kelompok3-booking/test2/index.php"); // Pastikan jalurnya benar
        exit(); // Menghentikan script
    } else {
        echo "Kamar tidak tersedia!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Booking</title>
</head>
<body>
    <h1>Proses Booking</h1>
    <p>Nomor Kamar: <?= $room['room_number']; ?></p>
    <p>Tipe Kamar: <?= $room['room_type']; ?></p>
    <p>Harga: Rp <?= number_format($room['price'], 2, ',', '.'); ?></p>
    <form action="booking.php" method="POST">
        <input type="hidden" name="index" value="<?= $index; ?>">
        <label for="customer_name">Nama Pemesan:</label>
        <input type="text" id="customer_name" name="customer_name" required><br>
        <label for="booking_date">Tanggal Booking:</label>
        <input type="date" id="booking_date" name="booking_date" required><br>
        <button type="submit">Submit Booking</button>
    </form>
</body>
</html>
