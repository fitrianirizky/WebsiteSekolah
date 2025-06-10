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

if(isset($_GET['id_users'])) {
    $id_users = $_GET['id_users'];
    
    try {
        $result = $db->hapus_data_user($id_users);
        
        if($result) {
            header("Location: datausers.php?status=deleted");
        } else {
            header("Location: datausers.php?status=delete_failed");
        }
    } catch (Exception $e) {
        header("Location: datausers.php?status=delete_error");
    }
    exit();
}

header("Location: datausers.php");
exit();
?>