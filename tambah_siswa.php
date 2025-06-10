<?php
include "koneksi.php";
$db = new database();

if(isset($_POST['simpan'])){
    $db->tambah_siswa(
        $_POST['nisn'],
        $_POST['nama'],
        $_POST['jeniskelamin'],
        $_POST['kodejurusan'],
        $_POST['kelas'],
        $_POST['alamat'],
        $_POST['agama'],
        $_POST['nohp'],
    );
    header("location:datasiswa.php");
}
?>

<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
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

input[type="text"],
input[type="alamat"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="radio"] {
    margin-right: 5px;
}

.radio-group {
    display: flex;
    align-items: center;
    gap: 15px;
}
.radio-group label {
    margin: 0;
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
    <h2>Form Tambah Data Siswa</h2>
    <form action="" method="post">
        
        <label for="nisn">NISN:</label><br>
        <input type="text" id="nisn" name="nisn" required><br><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>
        
        <label for="jeniskelamin">Jenis Kelamin:</label><br>
        <div class="radio-group">
        <input type="radio" id="laki_laki" name="jeniskelamin" value="L" required>
        <label for="laki_laki">Laki-laki</label>

        <input type="radio" id="perempuan" name="jeniskelamin" value="P" required>
        <label for="perempuan">Perempuan</label>
        </div><br>

        <label for="kodejurusan">Kode Jurusan:</label><br>
        <input type="text" id="kodejurusan" name="kodejurusan" required><br><br>

        <label for="kelas">Kelas:</label><br>
        <input type="text" id="kelas" name="kelas" required><br><br>

        <label for="alamat">Alamat:</label><br>
        <input type="alamat" id="alamat" name="alamat" required><br><br>

        <label for="agama">Agama:</label><br>
        <input type="text" id="agama" name="agama" required><br><br>

        <label for="nohp">No HP:</label><br>
        <input type="text" id="nohp" name="nohp" required><br><br>
        
        <input type="submit" name="simpan" value="Tambah Siswa">
    </form>
</body>


