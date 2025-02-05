<?php
include 'koneksi.php';


$tahun_sekarang = date("Y");


$query_update_status = "
    UPDATE arsip 
    SET status = 'inactive' 
    WHERE tahun_inactive = '$tahun_sekarang'
    AND status = 'active'
";
mysqli_query($conn, $query_update_status);

$query_inactive = "
    SELECT nama_arsip 
    FROM arsip 
    WHERE tahun_inactive = '$tahun_sekarang'
";
$result_inactive = mysqli_query($conn, $query_inactive);

$arsip_inactive = [];
while ($row = mysqli_fetch_assoc($result_inactive)) {
  $arsip_inactive[] = $row['nama_arsip'];
}


// Data  untuk MLFK
$query_banyak_dataMLFK = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN user u ON a.id_user = u.id_user
JOIN bidang b ON b.id_user = u.id_user
WHERE b.nama_bidang = 'Mitra Layanan Fasilitas Kesehatan'
";
$result_banyakMLFK = mysqli_query($conn, $query_banyak_dataMLFK);
$row_banyakMLFK = mysqli_fetch_assoc($result_banyakMLFK);
$jumlah_banyak_MLFK = $row_banyakMLFK['jumlah'] ?? 0;

$query_sudah_konfirmasiMLFK = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN box b ON a.kode_arsip = b.kode_arsip
JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Mitra Layanan Fasilitas Kesehatan'
";
$result_sudahMLFK = mysqli_query($conn, $query_sudah_konfirmasiMLFK);
$row_sudahMLFK = mysqli_fetch_assoc($result_sudahMLFK);
$jumlah_sudah_konfirmasiMLFK = $row_sudahMLFK['jumlah'] ?? 0;

$query_belum_konfirmasiMLFK = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
LEFT JOIN box b ON a.kode_arsip = b.kode_arsip
LEFT JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Mitra Layanan Fasilitas Kesehatan' AND (b.kode_arsip IS NULL OR r.kode_arsip IS NULL)
";
$result_belumMLFK = mysqli_query($conn, $query_belum_konfirmasiMLFK);
$row_belumMLFK = mysqli_fetch_assoc($result_belumMLFK);
$jumlah_belum_konfirmasiMLFK = $row_belumMLFK['jumlah'] ?? 0;

// Data  untuk PHU
$query_banyak_dataPHU = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN user u ON a.id_user = u.id_user
JOIN bidang b ON b.id_user = u.id_user
WHERE b.nama_bidang = 'Pengelola Harta dan Utilisasi'
";
$result_banyakPHU = mysqli_query($conn, $query_banyak_dataPHU);
$row_banyakPHU = mysqli_fetch_assoc($result_banyakPHU);
$jumlah_banyak_PHU = $row_banyakPHU['jumlah'] ?? 0;

$query_sudah_konfirmasiPHU = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN box b ON a.kode_arsip = b.kode_arsip
JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Pengelola Harta dan Utilisasi'
";
$result_sudahPHU = mysqli_query($conn, $query_sudah_konfirmasiPHU);
$row_sudahPHU = mysqli_fetch_assoc($result_sudahPHU);
$jumlah_sudah_konfirmasiPHU = $row_sudahPHU['jumlah'] ?? 0;

$query_belum_konfirmasiPHU = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
LEFT JOIN box b ON a.kode_arsip = b.kode_arsip
LEFT JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Pengelola Harta dan Utilisasi' AND (b.kode_arsip IS NULL OR r.kode_arsip IS NULL)
";
$result_belumPHU = mysqli_query($conn, $query_belum_konfirmasiPHU);
$row_belumPHU = mysqli_fetch_assoc($result_belumPHU);
$jumlah_belum_konfirmasiPHU = $row_belumPHU['jumlah'] ?? 0;

// Data  untuk Keuangan
$query_banyak_dataKeuangan = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN user u ON a.id_user = u.id_user
JOIN bidang b ON b.id_user = u.id_user
WHERE b.nama_bidang = 'Keuangan'
";
$result_banyakKeuangan = mysqli_query($conn, $query_banyak_dataKeuangan);
$row_banyakKeuangan = mysqli_fetch_assoc($result_banyakKeuangan);
$jumlah_banyak_Keuangan = $row_banyakKeuangan['jumlah'] ?? 0;

$query_sudah_konfirmasiKeuangan = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN box b ON a.kode_arsip = b.kode_arsip
JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Keuangan'
";
$result_sudahKeuangan = mysqli_query($conn, $query_sudah_konfirmasiKeuangan);
$row_sudahKeuangan = mysqli_fetch_assoc($result_sudahKeuangan);
$jumlah_sudah_konfirmasiKeuangan = $row_sudahKeuangan['jumlah'] ?? 0;

$query_belum_konfirmasiKeuangan = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
LEFT JOIN box b ON a.kode_arsip = b.kode_arsip
LEFT JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Keuangan' AND (b.kode_arsip IS NULL OR r.kode_arsip IS NULL)
";
$result_belumKeuangan = mysqli_query($conn, $query_belum_konfirmasiKeuangan);
$row_belumKeuangan = mysqli_fetch_assoc($result_belumKeuangan);
$jumlah_belum_konfirmasiKeuangan = $row_belumKeuangan['jumlah'] ?? 0;

// Data  untuk Kepesertaan
$query_banyak_dataKepesertaan = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN user u ON a.id_user = u.id_user
JOIN bidang b ON b.id_user = u.id_user
WHERE b.nama_bidang = 'Kepesertaan'
";
$result_banyakKepesertaan = mysqli_query($conn, $query_banyak_dataKepesertaan);
$row_banyakKepesertaan = mysqli_fetch_assoc($result_banyakKepesertaan);
$jumlah_banyak_Kepesertaan = $row_banyakKepesertaan['jumlah'] ?? 0;

$query_sudah_konfirmasiKepesertaan = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
JOIN box b ON a.kode_arsip = b.kode_arsip
JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Kepesertaan'
";
$result_sudahKepesertaan = mysqli_query($conn, $query_sudah_konfirmasiKepesertaan);
$row_sudahKepesertaan = mysqli_fetch_assoc($result_sudahKepesertaan);
$jumlah_sudah_konfirmasiKepesertaan = $row_sudahKepesertaan['jumlah'] ?? 0;

$query_belum_konfirmasiKepesertaan = "
SELECT COUNT(DISTINCT a.kode_arsip) AS jumlah 
FROM arsip a
LEFT JOIN box b ON a.kode_arsip = b.kode_arsip
LEFT JOIN rak r ON a.kode_arsip = r.kode_arsip
JOIN user u ON a.id_user = u.id_user
JOIN bidang bi ON bi.id_user = u.id_user
WHERE bi.nama_bidang = 'Kepesertaan' AND (b.kode_arsip IS NULL OR r.kode_arsip IS NULL)
";
$result_belumKepesertaan = mysqli_query($conn, $query_belum_konfirmasiKepesertaan);
$row_belumKepesertaan = mysqli_fetch_assoc($result_belumKepesertaan);
$jumlah_belum_konfirmasiKepesertaan = $row_belumKepesertaan['jumlah'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .wrapper {
      display: flex;
    }

    .sidebar {
      width: 300px;
      height: 100vh;
      background-color: #343a40;
      color: white;
      padding: 15px;
      position: fixed;
      top: 0;
      left: 0;
      overflow-y: auto;
    }

    .sidebar img {
      display: block;
      margin: 0 auto;
      max-height: 60px;
    }

    .nav-link {
      color: white;
    }

    .nav-link.active,
    .nav-link:hover {
      background-color: rgba(6, 162, 243, 0.8);
      border-radius: 5px;
      color: white;
    }

    .main-content {
      flex-grow: 1;
      margin-left: 300px;
      padding: 20px;
    }

    .navbar-custom {
      background-color: #06a2f3;
      height: 70px;
      color: white;
      position: fixed;
      top: 0;
      left: 300px;
      width: calc(100% - 300px);
      z-index: 1000;
    }

    .navbar .nav-link {
      color: white;
    }

    .container {
      margin-top: 80px;
    }

    .card {
      border-radius: 8px;
      padding: 0;
      background-color: #1D4580;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-content {
      margin-top: 10px;
      background-color: #06a2f3;
      width: 100%;
      height: 100%;
      border-radius: 8px;
    }

    .card h1 {
      font-size: 3rem;
    }

    .card p {
      font-size: 1.1rem;
    }

    .btn-primary {
      background-color: #0d6efd;
      border: none;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <nav class="sidebar">
      <div class="d-flex align-items-center justify-content-center my-3">
        <img src="logo.png" alt="Logo" class="img-fluid" />
      </div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a
            class="nav-link dropdown-toggle"
            data-bs-toggle="collapse"
            href="#menu1">Mutu Layanan Fasilitas Kesehatan</a>
          <div class="collapse" id="menu1">
            <a class="nav-link ms-3" href="dasboardkonfirmasi.php?bidang=Mitra Layanan Fasilitas Kesehatan">Konfirmasi Arsip</a>
          </div>
        </li>
        <li class="nav-item">
          <a
            class="nav-link dropdown-toggle"
            data-bs-toggle="collapse"
            href="#menu2">Pengelola Harta dan Utilisasi</a>
          <div class="collapse" id="menu2">
            <a class="nav-link ms-3" href="dasboardkonfirmasi.php?bidang=Pengelola Harta dan Utilisasi">Konfirmasi Arsip</a>
          </div>
        </li>
        <li class="nav-item">
          <a
            class="nav-link dropdown-toggle"
            data-bs-toggle="collapse"
            href="#menu3">Keuangan</a>
          <div class="collapse" id="menu3">
            <a class="nav-link ms-3" href="dasboardkonfirmasi.php?bidang=Keuangan">Konfirmasi Arsip</a>
          </div>
        </li>
        <li class="nav-item">
          <a
            class="nav-link dropdown-toggle"
            data-bs-toggle="collapse"
            href="#menu4">Kepesertaan</a>
          <div class="collapse" id="menu4">
            <a class="nav-link ms-3" href="dasboardkonfirmasi.php?bidang=Kepesertaan">Konfirmasi Arsip</a>
          </div>
        </li>
        <li class="nav-item">
                    <a
                        class="nav-link"
                        href="dasboarddatauser.php">Data User</a>

                </li>
      </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">Beranda</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown">
                  Login Sebagai
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a>Admin</a>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link user-icon"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-bs-toggle="dropdown">
                  <img
                    src="Admin.png"
                    alt="User"
                    class="rounded-circle" />
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="userDropdown">
                  <li>
                    <a class="dropdown-item" href="logout.php">Log Out</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Content -->
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="card text-white text-center">
              <h1 class="mt-3"><?= htmlspecialchars($jumlah_banyak_MLFK); ?></h1>
              <a style="font-size: 15px;">Sudah dikonfirmasi: <?= htmlspecialchars($jumlah_sudah_konfirmasiMLFK); ?></a>
              <a style="font-size: 15px;">Belum dikonfirmasi: <?= htmlspecialchars($jumlah_belum_konfirmasiMLFK); ?></a>
              <div class="card-content">
                <p class="mt-3">MLFK<br>(Mitra Layanan Fasilitas Kesehatan)</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card  text-white text-center">
              <h1 class="mt-3"><?= htmlspecialchars($jumlah_banyak_PHU); ?></h1>
              <a style="font-size: 15px;">Sudah dikonfirmasi: <?= htmlspecialchars($jumlah_sudah_konfirmasiPHU); ?></a>
              <a style="font-size: 15px;">Belum dikonfirmasi: <?= htmlspecialchars($jumlah_belum_konfirmasiPHU); ?></a>
              <div class="card-content">
              <p class="mt-3">PHU<br>(Pengelola Harta dan Utilisasi)</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card  text-white text-center">
              <h1 class="mt-3"><?= htmlspecialchars($jumlah_banyak_Keuangan); ?></h1>
              <a style="font-size: 15px;">Sudah dikonfirmasi: <?= htmlspecialchars($jumlah_sudah_konfirmasiKeuangan); ?></a>
              <a style="font-size: 15px;">Belum dikonfirmasi: <?= htmlspecialchars($jumlah_belum_konfirmasiKeuangan); ?></a>
              <div class="card-content">
              <p class="mt-3">Keuangan</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white text-center">
              <h1 class="mt-3"><?= htmlspecialchars($jumlah_banyak_Kepesertaan); ?></h1>
              <a style="font-size: 15px;">Sudah dikonfirmasi: <?= htmlspecialchars($jumlah_sudah_konfirmasiKepesertaan); ?></a>
              <a style="font-size: 15px;">Belum dikonfirmasi: <?= htmlspecialchars($jumlah_belum_konfirmasiKepesertaan); ?></a>
              <div class="card-content">
              <p class="mt-3">Kepesertaan</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document
      .querySelectorAll(".dropdown-toggle")
      .forEach(function(dropdown) {
        dropdown.addEventListener("click", function() {
          document
            .querySelectorAll(".dropdown-toggle")
            .forEach(function(el) {
              el.classList.remove("active");
            });
          this.classList.add("active");
        });
      });

    document.addEventListener("DOMContentLoaded", function() {
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