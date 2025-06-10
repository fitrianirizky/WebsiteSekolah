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

if(isset($_GET['id_agama'])) {
    $id_agama = $_GET['id_agama'];
    
    try {
        $result = $db->hapus_data_agama($id_agama);
        
        if($result) {
            header("Location: dataagama.php?status=deleted");
        } else {
            header("Location: dataagama.php?status=delete_failed");
        }
    } catch (Exception $e) {
        header("Location: dataagama.php?status=delete_error");
    }
    exit();
}

header("Location: dataagama.php");
exit();
?>