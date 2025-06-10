<?php
include "koneksi.php";
$db = new database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Agama</title>
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
    background:rgb(173, 192, 216);
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


a[href*="hapus_agama"] {
    background: #dc3545;
}

a[href*="hapus_agama"]:hover {
    background: #c82333;
}

a[href*="edit_siswa"], 
a[href*="edit_jurusan"], 
a[href*="edit_agama"] { 
    background: #28a745;
}

a[href*="edit_siswa"]:hover, 
a[href*="edit_jurusan"]:hover, 
a[href*="edit_agama"]:hover { 
    background: #218838;
}

a[href*="tambah"] {
    display: inline-block;
    margin-top: 15px;
    background: #007BFF;
    padding: 8px 15px;
    color: white;
    border-radius: 5px;
}

a[href*="tambah"]:hover {
    background:rgb(173, 192, 216);
}
</style>
<body>
    <h2>Data Agama</h2>
    <table border="1">
        <tr>
            <th>Id Agama</th>
            <th>Nama Agama</th>
            <th>Option</th>
        </tr>

        <?php
        $no = 1;
        foreach($db->tampil_data_agama() as $x){
        ?>
        <tr>
            <td><?php echo $x['id_agama'] ?></td>
            <td><?php echo $x['nama_agama'] ?></td>
            <td>
                <a href="edit_agama.php?nama_agama=<?php echo $x['nama_agama'] ?>&aksi=edit">Edit</a>
                <a href="hapus_agama.php?id_agama=<?php echo $x['id_agama'] ?>&aksi=hapus" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>

            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <a href="tambah_agama.php?">Tambah Data</a>
</body>
</html>