<?php
include 'koneksi.php';

    $kode_arsip = $_GET['kode'];
    $tanggal_hapus = date("Y-m-d H:i:s");

    $sql = "UPDATE arsip SET delete_at = '$tanggal_hapus' WHERE kode_arsip = '$kode_arsip'";

    if (mysqli_query($conn, $sql)) {
        header('location:dasboardadmin.php');
    } else {
        echo "error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
