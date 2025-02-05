<?php 

include 'koneksi.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$kodeBox = $_POST['kodeBox'];
$kodeRak = $_POST['kodeRak'];
$namaBox = $_POST['namaBox'];
$barisRak = $_POST['barisRak'];
$tingkatRak = $_POST['tingkatRak'];
$kode = $_GET['kode'];
$sqlRak = "INSERT INTO rak (kode_rak, baris_rak, tingkat_rak, kode_arsip) 
           VALUES ('$kodeRak', '$barisRak', '$tingkatRak', $kode)";

if (mysqli_query($conn, $sqlRak)) {
    $sqlBox = "INSERT INTO box (kode_box, nama_box, kode_arsip) 
               VALUES ('$kodeBox', '$namaBox', $kode)";

    if (mysqli_query($conn, $sqlBox)) {
        header('location:dasboardadmin.php');
    } else {
        echo "Error inserting into box table: " . mysqli_error($conn);
    }
} else {
    echo "Error inserting into rak table: " . mysqli_error($conn);
}

$conn->close();
?>