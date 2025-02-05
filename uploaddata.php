<?php
session_start();

include 'koneksi.php';

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!isset($_SESSION['id_user'])) {
    echo "Anda harus login terlebih dahulu.";
    exit;
}

$id_user = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_arsip = mysqli_real_escape_string($conn, $_POST['kode_arsip']);
    $nama_arsip = mysqli_real_escape_string($conn, $_POST['nama_arsip']);
    $kode_kategori = mysqli_real_escape_string($conn, $_POST['kode_kategori']);
    $tahun_file = mysqli_real_escape_string($conn, $_POST['tahun_file']);
    $tahun_inactive = mysqli_real_escape_string($conn, $_POST['tahun_inactive']);
    $fileupload = $_FILES['fileupload'];

    $check_query = "SELECT * FROM arsip WHERE kode_arsip = '$kode_arsip'";
    $result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Kode arsip sudah ada di database.'); window.history.back();</script>";
    } else {
        $target_dir = "uploads/"; 
        $file_name = basename($fileupload['name']);
        $target_file = $target_dir . $file_name;
        $upload_ok = 1;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($file_type !== "pdf") {
            echo "Hanya file PDF yang diperbolehkan.";
            $upload_ok = 0;
        }

        if ($upload_ok == 1) {
            if (move_uploaded_file($fileupload['tmp_name'], $target_file)) {
                $query_kategori = "INSERT INTO kategori (kode_kategori, id_user) VALUES ('$kode_kategori', '$id_user')";
                if (mysqli_query($conn, $query_kategori)) {
                    $id_kategori = mysqli_insert_id($conn);

                    $waktu_upload = date('Y-m-d H:i:s');
                    $status_arsip = "active";
                    $query_arsip = "INSERT INTO arsip (kode_arsip, nama_arsip, id_user, id_kategori, tahun_dokumen, status_arsip, fileupload, tahun_inactive, waktu_upload) 
                                    VALUES ('$kode_arsip','$nama_arsip', '$id_user', '$id_kategori', '$tahun_file', '$status_arsip', '$file_name', '$tahun_inactive', '$waktu_upload')";

                    if (mysqli_query($conn, $query_arsip)) {
                       header('location:tambahdatapage.php');
                    } else {
                        echo "Gagal menyimpan data ke tabel arsip: " . mysqli_error($conn);
                    }
                } else {
                    echo "Gagal menyimpan data ke tabel kategori: " . mysqli_error($conn);
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        }
    }
}

mysqli_close($conn);
?>
