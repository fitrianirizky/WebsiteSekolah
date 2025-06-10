<?php
session_start();

if (!isset($_SESSION['id_users'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['role'] != 'admin') {
    header("Location: ../unauthorized.php");
    exit();
}

include "../koneksi.php";
$db = new database();

if(isset($_GET['kodejurusan'])) {
    $kodejurusan = $_GET['kodejurusan'];
    
    try {
        $result = $db->hapus_data_jurusan($kodejurusan);
        
        if($result) {
            header("Location: datajurusan.php?status=deleted");
        } else {
            header("Location: datajurusan.php?status=delete_failed");
        }
    } catch (Exception $e) {
        header("Location: datajurusan.php?status=delete_error");
    }
    exit();
}

header("Location: datajurusan.php");
exit();
?>