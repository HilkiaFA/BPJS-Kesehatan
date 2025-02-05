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

        .nav-link.active,
        .nav-link:hover {
            background-color: rgba(6, 162, 243, 0.8);
            border-radius: 5px;
            color: white;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            margin-left: 300px;
            /* Sesuai dengan lebar sidebar */
            padding: 20px;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #06a2f3;
            height: 70px;
            color: white;
            position: fixed;
            top: 0;
            left: 300px;
            /* Sesuai dengan sidebar */
            width: calc(100% - 300px);
            z-index: 1000;
        }

        .navbar .nav-link {
            color: white;
        }

        .container {
            margin-top: 80px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
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
                                <a class="nav-link" href="dasboardadmin.php">Beranda</a>
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
               
             <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Username</th>
                            <th>Nama Bidang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    include 'koneksi.php';

                    if ($conn->connect_error) {
                        header('location:index.php');
                    }

                                            $sql = "SELECT 
                            u.id_user, 
                            u.nama_user, 
                            u.jabatan, 
                            u.username, 
                            u.status AS status_user, 
                            b.kode_bidang, 
                            b.nama_bidang
                        FROM 
                            user u
                        JOIN 
                            bidang b ON u.id_user = b.id_user";

                    $result = mysqli_query($conn, $sql);
                    ?>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['nama_user'] . "</td>";
                                echo "<td>" . $row['jabatan'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['nama_bidang'] . "</td>";
                                echo "<td><a href='dasboardEditdatauser.php?kode=" . $row['id_user'] . "' class='btn btn-primary  btn-sm '>Edit</a></td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center'>Data tidak ditemukan</td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
                <?php
                $conn->close();
                ?>

                </table>
                <a href="dasboardTambahUser.php"><button type="button" class="btn btn-success">Tambah Data</button></a>
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
            const searchInput = document.querySelector("input[type='text']");
            const searchSelect = document.querySelector("select");
            const tableRows = document.querySelectorAll("tbody tr");

            searchInput.addEventListener("keyup", function() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedColumn = searchSelect.value;

                const columnIndex = {
                    "Nama Box": 3,
                    "Kode Kategori": 2,
                    "Tahun Arsip": 5,
                    "Tingkat Rak": 1,
                    "Nama Arsip": 4
                } [selectedColumn];

                tableRows.forEach((row) => {
                    let shouldDisplay = false;
                    const cells = row.getElementsByTagName("td");

                    if (columnIndex !== undefined && cells[columnIndex]) {
                        shouldDisplay = cells[columnIndex].innerText.toLowerCase().includes(searchTerm);
                    }

                    row.style.display = shouldDisplay ? "" : "none";
                });
            });
        });
    </script>
</body>

</html>