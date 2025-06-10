<?php
// Pastikan ini di BARIS PALING ATAS (tanpa spasi/echo sebelumnya)
ob_start();
session_start();

// 1. Hapus semua data session
$_SESSION = array();

// 2. Hapus cookie session PHP
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// 3. Hapus cookie remember_login DENGAN PARAMETER PERSIS SAAT DIBUAT
setcookie('remember_login', '', time() - 3600, "/", "", true, true);

// 4. Hancurkan session
session_destroy();

// 5. Redirect PAKAI JAVASCRIPT + HTML META UNTUK JAGA-JAGA
echo '<script>window.location.href = "login.php";</script>';
echo '<meta http-equiv="refresh" content="0;url=login.php">';
exit();
?>