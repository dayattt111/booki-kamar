<?php
session_start();

include 'data.php';
// Proses booking
function ProsesBooking($post_data, $bookedRooms) {
    if (isset($post_data['pesan'])) {
        $id_kamar = $post_data['id'];
        $nama_pemesan = $post_data['nama_pemesan'] ?? null;
        $tanggal_checkin = $post_data['tanggal_checkin'] ?? null;

        if (!isset($_SESSION['booked_rooms'])) {
            $_SESSION['booked_rooms'] = [];
        }

        // Tambahkan data pemesan ke sesi
        $_SESSION['booked_rooms'][$id_kamar] = [
            'nama_pemesan' => $nama_pemesan,
            'tanggal_checkin' => $tanggal_checkin
        ];
    }

    if (isset($post_data['batal'])) {
        $id_kamar = $post_data['id'];
        if (isset($_SESSION['booked_rooms'][$id_kamar])) {
            unset($_SESSION['booked_rooms'][$id_kamar]);
        }
    }

    if (isset($post_data['reset'])) {
        unset($_SESSION['booked_rooms']);
    }

    return $_SESSION['booked_rooms'] ?? [];
}

// Statistik kamar
function getKamarStats($kamar, $bookedRooms) {
    return [count($kamar), count($bookedRooms), count($kamar) - count($bookedRooms)];
}

// Ambil nama pemesan
function getNamaPemesan($id_kamar) {
    return $_SESSION['booked_rooms'][$id_kamar]['nama_pemesan'] ?? null;
}

// Ambil tanggal check-in
function getTanggalCheckin($id_kamar) {
    return $_SESSION['booked_rooms'][$id_kamar]['tanggal_checkin'] ?? null;
}

// Proses data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookinKamar = ProsesBooking($_POST, $_SESSION['booked_rooms'] ?? []);
} else {
    $bookinKamar = $_SESSION['booked_rooms'] ?? [];
}

list($total_kamar, $kamar_booking, $kamar_kosong) = getKamarStats($kamar, $bookinKamar);
?>