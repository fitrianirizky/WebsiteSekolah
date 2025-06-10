<?php
session_start();
include "koneksi.php";
$db = new database();

// Cek cookie "remember_login"
if (!isset($_SESSION['id_users']) && isset($_COOKIE['remember_login'])) {
    $id_users = $_COOKIE['remember_login'];
    $users = $db->getUserById($id_users); // Buat method di database class
    
    if ($users) {
        $_SESSION['id_users'] = $users['id_users'];
        $_SESSION['nama'] = $users['nama'];
        $_SESSION['username'] = $users['username'];
        $_SESSION['role'] = $users['role'];
        
        // Redirect sesuai role
        if ($users['role'] == 'admin') {
            header("Location: admin/index.php");
        } elseif ($users['role'] == 'guru') {
            header("Location: guru/index.php");
        } elseif ($users['role'] == 'siswa') {
            header("Location: siswa/index.php");
        }
        exit;
    }
}

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['id_users'])) {
    // Redirect sesuai role
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/index.php");
    } elseif ($_SESSION['role'] == 'guru') {
        header("Location: guru/index.php");
    } elseif ($_SESSION['role'] == 'siswa') {
        header("Location: siswa/index.php");
    }
    exit;
}

// Proses login jika ada data POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Lakukan validasi login
    $users = $db->login($username, $password);
    
    if ($users) {
    $_SESSION['id_users'] = $users['id_users'];
    $_SESSION['nama'] = $users['nama'];
    $_SESSION['username'] = $users['username'];
    $_SESSION['role'] = $users['role'];
    $_SESSION['last_login'] = date('Y-m-d H:i:s');

    // Jika "Remember Me" dicentang, set cookie
    if (isset($_POST['remember'])) {
        $cookie_name = "remember_login";
        $cookie_value = $users['id_users']; // atau token unik
        $cookie_expiry = time() + (30 * 24 * 60 * 60); // 30 hari
        setcookie($cookie_name, $cookie_value, $cookie_expiry, "/");
    }

    // Redirect sesuai role
    if ($users['role'] == 'admin') {
        header("Location: admin/index.php");
    } elseif ($users['role'] == 'guru') {
        header("Location: guru/index.php");
    } elseif ($users['role'] == 'siswa') {
        header("Location: siswa/index.php");
    }
    exit;
    } else {
        $error = "Login gagal! Username atau password salah.";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="dist/css/adminlte.css" />
  </head>
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>Login</b></a>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Log in to start your session</p>
          
          <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php endif; ?>
          
          <form action="login.php" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username" required />
              <div class="input-group-text"><span class="bi bi-person-fill"></span></div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" required id="passwordInput" />
              <div class="input-group-text">
                <span class="bi bi-lock-fill" id="togglePassword" style="cursor: pointer"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                  <label class="form-check-label" for="remember"> Remember Me </label>
                </div>
              </div>
              <div class="col-4">
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <script src="dist/js/adminlte.js"></script>
    <script>
  document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('passwordInput');
    const icon = this;
    
    // Toggle password visibility
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    // Toggle icon
    icon.classList.toggle('bi-lock-fill');
    icon.classList.toggle('bi-unlock-fill');
  });
</script>
  </body>
</html>