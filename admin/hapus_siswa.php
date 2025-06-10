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

if(isset($_GET['nisn'])) {
    $nisn= $_GET['nisn'];
    
    try {
        $result = $db->hapus_data_siswa($nisn);
        
        if($result) {
            header("Location: datasiswa.php?status=deleted");
        } else {
            header("Location: datasiswa.php?status=delete_failed");
        }
    } catch (Exception $e) {
        header("Location: datasiswa.php?status=delete_error");
    }
    exit();
}

header("Location: datasiswa.php");
exit();
?>