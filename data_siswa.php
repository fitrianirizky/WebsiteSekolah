<?php
include "koneksi.php";
$db = new database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>
<style>
    
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 20px;
}


h2 {
    text-align: center;
    color: #333;
}


table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

th {
    background: #9AA6B2;
    color: black;
    padding: 10px;
    text-align: left;
}

td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background: #f1f1f1;
}

a {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    color: white;
}

a[href*="edit_siswa"] {
    background: #28a745;
}

a[href*="edit_siswa"]:hover {
    background: #218838;
}


a[href*="hapus_siswa"] {
    background: #dc3545;
}

a[href*="hapus_siswa"]:hover {
    background: #c82333;
}


a[href*="tambah"] {
    display: inline-block;
    margin-top: 15px;
    background: #9AA6B2;
    padding: 8px 15px;
    color: white;
    border-radius: 5px;
}

a[href*="tambah"]:hover {
    background:rgb(4, 83, 180);
}



</style>
<body>
    <h2>Data Siswa</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Agama</th>
            <th>No HP</th>
            <th>Option</th>
        </tr>

        <?php
    $no = 1;
    foreach($db->tampil_data_siswa() as $x){
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $x['nisn'] ?></td>
        <td><?php echo $x['nama'] ?></td>
        <td><?php echo $x['jeniskelamin'] ?></td>
        <td><?php echo $x['kodejurusan'] ?></td>
        <td><?php echo $x['kelas'] ?></td>
        <td><?php echo $x['alamat'] ?></td>
        <td><?php echo $x['agama'] ?></td>
        <td><?php echo $x['nohp'] ?></td>
        <td>
            <a href="edit_siswa.php?id_siswa=<?php echo $x['nisn'] ?>&aksi=edit">Edit</a>
            <a href="hapus_siswa.php?nisn=<?php echo $x['nisn'] ?>&aksi=hapus">Hapus</a>
        </td>
    </tr>
    <?php
    }
    ?>

    </table>
    <a href="tambah_siswa.php">Tambah Data</a>
</body>
</html>