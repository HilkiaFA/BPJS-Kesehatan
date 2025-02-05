<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}


$id_user = $_SESSION['id_user'];
$query = "SELECT kode_bidang, nama_bidang FROM bidang WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPJS Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
  .navbar-custom {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  .navbar-brand img {
    height: 40px;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="logo.png" alt="BPJS Kesehatan">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="berandapage.php">Beranda</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Login Sebagai
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php while ($row = $result->fetch_assoc()): ?>
                <li><a class="dropdown-item"><?= $row['kode_bidang']; ?></a></li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link user-icon" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="User.png" alt="User" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <form action="uploaddata.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="namaArsip" class="form-label">Kode Arsip</label>
            <input type="text" class="form-control" id="kode_arsip" name="kode_arsip" required placeholder="Masukkan kode arsip">
          </div>
          <div class="mb-3">
            <label for="namaArsip" class="form-label">Nama Arsip</label>
            <input type="text" class="form-control" id="nama_arsip" name="nama_arsip" required placeholder="Masukkan nama arsip">
          </div>

          <div class="mb-3">
            <label for="kodeKategori" class="form-label">Kode Kategori</label>
            <input type="text" class="form-control"  id="kode_kategori" name="kode_kategori" required placeholder="Masukkan kode kategori">
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="tahunFile" class="form-label">Tahun File</label>
              <input type="text" class="form-control" id="tahun_file" name="tahun_file" required placeholder="Masukkan tahun file">
            </div>
            <div class="col-md-6 mb-3">
              <label for="tahunInactive" class="form-label">Tahun Inactive</label>
              <input type="text" class="form-control" id="tahun_inactive" name="tahun_inactive" required placeholder="Masukkan tahun inactive">
            </div>
          </div>

          <div class="mb-3">
            <label for="dokumen" class="form-label">Dokumen</label>
            <div class="input-group">
              <input type="text" class="form-control" id="dokumen" required placeholder="Pilih dokumen" readonly>

              <button class="btn btn-primary" style="background-color: #1D4580;" type="button" onclick="openFileDialog()">Cari File</button>
            </div>

            <input type="file" id="fileInput" style="display: none;" id="fileupload" name="fileupload"  onchange="updateFileName()">
          </div>
          <div class="d-flex justify-content-end">
                        <button type="submit" style="background-color: #1D4580;" class="btn btn-primary">Simpan</button>
                    </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let uploadedFilePath = '';

    function openFileDialog() {
      document.getElementById('fileInput').click();
    }

    function updateFileName() {
      const fileInput = document.getElementById('fileInput');
      const dokumenInput = document.getElementById('dokumen');
      const fileName = fileInput.files[0]?.name || '';
      dokumenInput.value = fileName;

      const serverFilePath = `uploads/${fileName}`;
      uploadedFilePath = serverFilePath;
    }

    function openPdf() {
      if (uploadedFilePath) {
        window.open(uploadedFilePath, '_blank');
      } else {
        alert('Belum ada dokumen yang dipilih atau diupload!');
      }
    }
  </script>
</body>

</html>