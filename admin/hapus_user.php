<?php
include "koneksi.php";
$db = new database();

if(isset($_GET['id_users'])) {
    $nisn = $_GET['id_users'];
    
    // Panggil fungsi hapus data
    $result = $db->hapus_data_user($id_users);
    
    if($result) {
        header("Location: datausers.php?status=deleted");
    } else {
        header("Location: datausers.php?status=delete_failed");
    }
    exit();
} else {
    header("Location: datausers.php");
    exit();
}
?>