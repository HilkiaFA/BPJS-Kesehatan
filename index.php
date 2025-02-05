<?php
session_start();
include 'koneksi.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Username atau password tidak boleh kosong!";
    } else {
        $query = "SELECT u.id_user, u.nama_user, u.jabatan, u.status, b.kode_bidang, b.nama_bidang 
                  FROM user u
                  LEFT JOIN bidang b ON u.id_user = b.id_user
                  WHERE u.username = ? AND u.pass_user = ? AND u.status = 'aktif'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama_user'] = $user['nama_user'];
            $_SESSION['jabatan'] = $user['jabatan'];
            $_SESSION['kode_bidang'] = $user['kode_bidang'];
            $_SESSION['nama_bidang'] = $user['nama_bidang'];

            if (!empty($user['kode_bidang']!="adm")) {
                header("Location: berandapage.php?bidang=" . $user['kode_bidang']);
            } else {
                header("Location: dasboardadmin.php");
            }
            exit;
        } else {
            $error = "Login gagal! Username atau password salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-box {
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background: #fff;
    }
    .login-box img {
      width: 250px;
      margin-bottom: 1rem;
    }
    .login-box .form-control {
      border-radius: 30px;
    }
    .login-box .btn {
      border-radius: 30px;
    }
    .btn {
        background-color: #1D4580;
        color: white;
        font-style: initial;
    }
  </style>
</head>
<body class="bg-light">

  <div class="container login-container">
    <div class="login-box text-center">
      <img src="logo.png" alt="Logo">
      <form method="POST" action="">
        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
              <i class="bi bi-person"></i>
            </span>
            <input type="text" name="username" class="form-control border-start-0" placeholder="Username" required>
          </div>
        </div>
        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
              <i class="bi bi-lock"></i>
            </span>
            <input type="password" name="password" class="form-control border-start-0" placeholder="Password" required>
          </div>
        </div>
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger">
            <?= $error; ?>
          </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</body>
</html>
