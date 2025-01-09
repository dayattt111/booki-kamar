<?php
session_start();

// Proses booking
function ProsesBooking($post_data, $bookedRooms) {
    if (isset($post_data['pesan'])) {
        $id_kamar = $post_data['id'];
        $nama_pemesan = $post_data['nama_pemesan'] ?? null;

        if (!isset($_SESSION['booked_rooms'])) {
            $_SESSION['booked_rooms'] = [];
        }

        // Tambahkan nama pemesan ke sesi
        $_SESSION['booked_rooms'][$id_kamar] = $nama_pemesan;
    }
    return $_SESSION['booked_rooms'] ?? [];
}

// Statistik kamar
function getKamarStats($kamar, $bookedRooms) {
    return [count($kamar), count($bookedRooms), count($kamar) - count($bookedRooms)];
}

// Ambil nama pemesan
function getNamaPemesan($id_kamar) {
    return $_SESSION['booked_rooms'][$id_kamar] ?? null;
}
?>
