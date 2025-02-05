<?php
include 'koneksi.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$namaUser = $_POST['NamaUser'];
$jabatan = $_POST['Jabatan'];
$usernameUser = $_POST['Username'];
$passwordUser = $_POST['Password'];
$kodeBidang = $_POST['kodeBidang'];
$bidang = $_POST['bidang'];

$sql_check = "SELECT * FROM bidang WHERE kode_bidang = '$kodeBidang'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    echo "<script>alert('Kode Bidang sudah ada. Silakan pilih kode bidang lain.'); window.history.back();</script>";
} else {
    $sql_user = "INSERT INTO user (nama_user, jabatan, username, pass_user, status) 
                 VALUES ('$namaUser', '$jabatan', '$usernameUser', '$passwordUser', 'aktif')";

    if (mysqli_query($conn, $sql_user)) {
        $id_user = mysqli_insert_id($conn);

        $sql_bidang = "INSERT INTO bidang (kode_bidang, nama_bidang, id_user) 
                       VALUES ('$kodeBidang', '$bidang', '$id_user')";

        if (mysqli_query($conn, $sql_bidang)) {
            header('location:dasboarddatauser.php');
        } else {
            echo "Error: " . $sql_bidang . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql_user . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
