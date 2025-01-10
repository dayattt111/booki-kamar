<?php
include "data.php";
//untuk proses booking 
function ProsesBooking($post_data, $bookinKamar){
    if (isset($post_data['pesan']) && !in_array($post_data['id'], $bookinKamar)) {
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

function getNamaPemesan($id_kamar) {
    return $_SESSION['booked_rooms'][$id_kamar] ?? null;
}

?>