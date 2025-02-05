<?php
include 'koneksi.php';

    $iduser = $_GET['iduser'];
    $status = $_POST['status'];
    

    $sql = "UPDATE user SET status = '$status' WHERE id_user = '$iduser'";

    if (mysqli_query($conn, $sql)) {
        header('location:dasboarddatauser.php');
    } else {
        echo "error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
