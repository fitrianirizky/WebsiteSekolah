<?php
include "koneksi.php";
$db = new database();

if(isset($_GET['id_agama'])) {
    $id_agama = $_GET['id_agama'];
    
    // Panggil fungsi hapus data
    $result = $db->hapus_data_agama($id_agama);
    
    if($result) {
        header("Location: dataagama.php?status=deleted");
    } else {
        header("Location: dataagama.php?status=delete_failed");
    }
    exit();
}

header("Location: dataagama.php");
exit();
?>