<?php
include "data.php";
//untuk proses booking 
function ProsesBooking($post_data, $bookinKamar){
    if (isset($post_data['pesan']) && !in_array($post_data['id'],$bookinKamar)) {
        $bookinKamar[] = $post_data['id'];
    }
    return $bookinKamar;
}


//untuk statsitik data

function getKamarStats($kamar, $bookinKamar){
    return [count($kamar), count($bookinKamar),count($kamar) - count($bookinKamar)];
}
$bookinKamar = ProsesBooking($_POST, $_POST['booked_rooms'] ?? [
]);
list($total_kamar, $kamar_booking, $kamar_kosong) = getKamarStats($kamar, $bookinKamar);
?>

//get put,post sama delete
//post untuk mengiri sebuah data