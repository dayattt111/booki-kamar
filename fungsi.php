<?php
include "data.php";
session_start();
//untuk proses booking 
function ProsesBooking($post_data, $bookinKamar){
    if (isset($post_data['pesan']) && !in_array($post_data['id'],$bookinKamar)) {
        $bookinKamar[] = $post_data['id'];
    }
    return $bookinKamar;

}

// session_start();

// Fungsi untuk mengubah status kamar
function changeStatus($id, $room){
    foreach($room as $key => $value){
        if($value['id'] == $id){
            $room[$key]['status'] = false; 
        }
    }
    return $room;  
}

if (isset($_POST['pesan'])) {
    if(isset($_SESSION['kamar'])){  
        $room = $_SESSION['kamar'];
    } 
    $id = $_POST['id'][0];  // Misalnya id dikirim sebagai array dengan 1 elemen
    $namaKamar = $_POST['nama'][0];

    $_SESSION['kamar'] = changeStatus($id, $room);
    echo "<script>alert('Kamar berhasil dipesan: $namaKamar')</script>";

}

if (isset($_POST['reset'])) {
    $_SESSION['kamar'] = $kamar;
    

}

// Menghitung jumlah kamar dengan status true
$countAvailable = count(array_filter($_SESSION['kamar'], function($item) {
    return $item['status'] === true;
}));

function countAvailable() {
    return count(array_filter($_SESSION['kamar'], function($item)  {
        return $item['status'] === false;
    }));
}

function countNotAvailable() {
    return count(array_filter($_SESSION['kamar'], function($item)  {
        return $item['status'] === true;
    }));
}



//untuk statsitik data

// function getKamarStats($kamar, $bookinKamar){
//     return [count($kamar), count($bookinKamar),count($kamar) - count($bookinKamar)];
// }
// $bookinKamar = ProsesBooking($_POST, $_POST['booked_rooms'] ?? [
// ]);
// list($total_kamar, $kamar_booking, $kamar_kosong) = getKamarStats($_SESSION['kamar'], $bookinKamar);
// ?>

<!-- get put,post sama delete
post untuk mengiri sebuah data -->