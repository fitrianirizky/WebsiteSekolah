<?php
include "koneksi.php";
$db = new database();

if(isset($_GET['kodejurusan'])) {
    $kodejurusan = $_GET['kodejurusan'];
    
    // Panggil fungsi hapus data
    $result = $db->hapus_data_jurusan($kodejurusan);
    
    if($result) {
        header("Location: datajurusan.php?status=deleted");
    } else {
        header("Location: datajurusan.php?status=delete_failed");
    }
    exit();
}

header("Location: datajurusan.php");
exit();
?>