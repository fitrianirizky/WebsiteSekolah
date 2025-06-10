<?php
include "koneksi.php";
$db = new database();

if(isset($_POST['simpan'])){
    $db->tambah_agama(

        $_POST['namaagama'],
    );
    header("location:dataagama.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Agama</title>
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
    <h2>Form Data Tambah Agama</h2>
    <form action="" method="post">
        
        <label for="nama_agama">Nama Agama:</label><br>
        <input type="text" id="namaagama" name="namaagama" required><br><br>
        
        <input type="submit" name="simpan" value="Tambah Agama">
    </form>
</body>
</html>