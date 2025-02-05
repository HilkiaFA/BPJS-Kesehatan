<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        /* Sidebar */
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

        .nav-link.active, .nav-link:hover {
            background-color: rgba(6, 162, 243, 0.8);
            border-radius: 5px;
            color: white;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            margin-left: 300px; /* Sesuai dengan lebar sidebar */
            padding: 20px;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #06A2F3;
            height: 70px;
            color: white;
            position: fixed;
            top: 0;
            left: 300px; /* Sesuai dengan sidebar */
            width: calc(100% - 300px);
            z-index: 1000;
        }
        .container-content{
            margin-top: 100px;
        }

        .navbar .nav-link {
            color: white;
        }


        /* Responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
            }
            .main-content {
                margin-left: 250px;
            }
            .navbar-custom {
                left: 250px;
                width: calc(100% - 250px);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
            .navbar-custom {
                left: 0;
                width: 100%;
            }
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
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom" style="height: 70px;">
                <div class="container">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                      <li class="nav-item">
                        <a class="nav-link text-white" href="dasboardadmin.php">Beranda</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Login Sebagai
                        </a>
                        <ul class="dropdown-menu text-white" aria-labelledby="navbarDropdown">
                          <a>Admin</a>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link user-icon" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="Admin.png" alt="User" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                          <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        

            <!-- Content -->
            <div class="container-content">
            <form action="insertkonfirmasi.php?kode=<?php echo $_GET['kode'] ?>" method="post">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="kodeBox" class="form-label">Kode Box</label>
            <input type="text"  class="form-control" required name="kodeBox" pattern="\d+" title="Hanya angka yang diperbolehkan" id="kodeBox" oninput="generateNamaBox()">
        </div>
        <div class="col-md-6">
            <label for="kodeRak" class="form-label">Kode Rak</label>
            <input type="text" class="form-control" required name="kodeRak" pattern="\d+" title="Hanya angka yang diperbolehkan" id="kodeRak" oninput="generateNamaBox()">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="namaBox" class="form-label">Nama Box</label>
            <input type="text" class="form-control" required name="namaBox" id="namaBox" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="barisRak" class="form-label">Baris Rak</label>
            <input type="text" class="form-control" required name="barisRak" pattern="\d+" title="Hanya angka yang diperbolehkan" id="barisRak">
        </div>
        <div class="col-md-6">
            <label for="tingkatRak" class="form-label">Tingkat Rak</label>
            <input type="text" class="form-control" required name="tingkatRak" pattern="\d+" title="Hanya angka yang diperbolehkan" id="tingkatRak">
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" style="background-color: #1D4580;" class="btn btn-primary">Simpan</button>
    </div>
</form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function generateNamaBox() {
            var kodeRak = document.getElementById('kodeRak').value;
            var kodeBox = document.getElementById('kodeBox').value;
            if (kodeRak && kodeBox) {
                document.getElementById('namaBox').value = kodeRak + '-' + kodeBox;
            } else {
                document.getElementById('namaBox').value = '';
            }
        }

        document.querySelectorAll('.dropdown-toggle').forEach(function (dropdown) {
            dropdown.addEventListener('click', function () {
                document.querySelectorAll('.dropdown-toggle').forEach(function (el) {
                    el.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
