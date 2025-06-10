<?php
include "koneksi.php";
$db = new database();

if(isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];
    
    // Panggil fungsi hapus data
    $result = $db->hapus_data_siswa($nisn);
    
    if($result) {
        header("Location: datasiswa.php?status=deleted");
    } else {
        header("Location: datasiswa.php?status=delete_failed");
    }
    exit();
} else {
    header("Location: datasiswa.php");
    exit();
}
?>