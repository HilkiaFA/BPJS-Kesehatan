<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = mysqli_real_escape_string($conn, $_SESSION['id_user']);
$tahun_sekarang = date("Y");

$query_update_status = "
    UPDATE arsip 
    SET status = 'inactive' 
    WHERE id_user = '$id_user' 
    AND tahun_inactive = '$tahun_sekarang'
    AND status = 'active'
";
mysqli_query($conn, $query_update_status);

$query_inactive = "
    SELECT nama_arsip 
    FROM arsip 
    WHERE id_user = '$id_user' 
    AND tahun_inactive = '$tahun_sekarang'
";
$result_inactive = mysqli_query($conn, $query_inactive);

$arsip_inactive = [];
while ($row = mysqli_fetch_assoc($result_inactive)) {
    $arsip_inactive[] = $row['nama_arsip'];
}

$query_sudah_konfirmasi = "
    SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
    FROM arsip a
    JOIN box b ON a.kode_arsip = b.kode_arsip
    JOIN rak r ON a.kode_arsip = r.kode_arsip
    WHERE a.id_user = '$id_user'
";
$result_sudah = mysqli_query($conn, $query_sudah_konfirmasi);
$row_sudah = mysqli_fetch_assoc($result_sudah);
$jumlah_sudah_konfirmasi = $row_sudah['jumlah'] ?? 0;

$query_belum_konfirmasi = "
    SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
    FROM arsip a
    LEFT JOIN box b ON a.kode_arsip = b.kode_arsip
    LEFT JOIN rak r ON a.kode_arsip = r.kode_arsip
    WHERE a.id_user = '$id_user' AND (b.kode_arsip IS NULL OR r.kode_arsip IS NULL)
";
$result_belum = mysqli_query($conn, $query_belum_konfirmasi);
$row_belum = mysqli_fetch_assoc($result_belum);
$jumlah_belum_konfirmasi = $row_belum['jumlah'] ?? 0;

$query_bidang_list = "SELECT kode_bidang FROM bidang WHERE id_user = '$id_user'";
$result_bidang_list = mysqli_query($conn, $query_bidang_list);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPJS Kesehatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .status-card {
      background-color: #1D4580;
      color: white;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .status-card h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .navbar-custom {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    .navbar-brand img {
      height: 40px;
    }

    footer {
  position: absolute; 
  bottom: 0;
  width: 100%;
  height: 200px;
  background-color: #00A14C;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: white;
  text-align: center;
  font-size: 14px;
}

.footer-content {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
}

.footer-disain {
  height: 10px;
  width: 100%;
  margin-top: 50px;
  background-color: white;
}

  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="logo.png" alt="BPJS Kesehatan">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="tambahdatapage.php">Tambah data</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
              Login Sebagai
            </a>
            <ul class="dropdown-menu">
              <?php while ($row = mysqli_fetch_assoc($result_bidang_list)): ?>
                <li><a class="dropdown-item"><?= htmlspecialchars($row['kode_bidang']); ?></a></li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link user-icon" href="#" id="userDropdown" data-bs-toggle="dropdown">
              <img src="User.png" alt="User" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-4 mb-3">
        <div class="status-card">
          <h1><?= htmlspecialchars($jumlah_sudah_konfirmasi); ?></h1>
          <p>Sudah Dikonfirmasi</p>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="status-card">
          <h1><?= htmlspecialchars($jumlah_belum_konfirmasi); ?></h1>
          <p>Belum Dikonfirmasi</p>
        </div>
      </div>
    </div>
  </div>
  <footer>
  <div class="footer-content">
    <p>&copy; 2024 - Arsip BPJS Kesehatan By Magang 09/2024</p>
  </div>
  <div class="footer-disain"></div>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        var arsipInactive = <?= json_encode($arsip_inactive); ?>;
        if (arsipInactive.length > 0) {
            var message = "Perhatian!\nArsip di bawah ini akan tidak aktif di tahun ini:\n\n";
            message += arsipInactive.join("\n");
            alert(message);
        }
    });
</script>

</body>
</html>
