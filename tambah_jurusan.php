<?php
include "koneksi.php";
$db = new database();

if(isset($_POST['simpan'])){
    $db->tambah_jurusan(
       
        $_POST['namajurusan'],
    );
    header("location:datajurusan.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Jurusan</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

h2 {
    text-align: center;
    color: #333;
    margin-top: 20px;
}

form {
    width: 50%;
    background: white;
    padding: 20px;
    margin: 20px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 15px;
}

input[type="submit"]:hover {
    background: #0056b3;
}
</style>
<body>
    <h2>Form Tambah Data Jurusan</h2>
    <form action="" method="post">
        
        <label for="namajurusan">Nama Jurusan:</label><br>
        <input type="text" id="namajurusan" name="namajurusan" required><br><br>
        
        <input type="submit" name="simpan" value="Tambah Jurusan">
    </form>
</body>
</html></form>