<?php
class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database= "sekolah";

    function __construct(){
        $this->koneksi = mysqli_connect(
            $this->host, $this->username, $this->password);
        $cekdb = mysqli_select_db(
            $this->koneksi, $this->database);

    }

    function tampil_data_siswa(){
    $data = mysqli_query(
        $this->koneksi, 
        "SELECT 
                s.nisn AS 'nisn', 
                s.nama AS 'nama', 
                IF(s.jeniskelamin='L','Laki-Laki','Perempuan') AS 'jeniskelamin',
                j.namajurusan AS 'jurusan',
                s.kodejurusan AS 'kodejurusan', 
                s.kelas AS 'kelas', 
                s.alamat AS 'alamat', 
                a.nama_agama AS 'agama',
                a.id_agama AS 'id_agama', 
                s.nohp AS 'nohp' 
        FROM siswa s 
        JOIN jurusan j ON s.kodejurusan = j.kodejurusan 
        JOIN agama a ON s.agama = a.id_agama;"
    );

    $hasil = [];
    while($row = mysqli_fetch_array($data)){
        $hasil[] = $row;
    }
    return $hasil;
}

    function tampil_data_jurusan(){
        $data = mysqli_query($this->koneksi, 
            "SELECT j.*, COUNT(s.nisn) as jumlah 
            FROM jurusan j 
            LEFT JOIN siswa s ON j.kodejurusan = s.kodejurusan 
            GROUP BY j.kodejurusan");
        $hasil = [];
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tampil_data_agama(){
        $data = mysqli_query(
            $this->koneksi, "select * from agama");
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tampil_data_users(){
    $hasil = array(); 
    $data = mysqli_query($this->koneksi, "SELECT * FROM users");
    if ($data) {
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
    }
        return $hasil;
    }

    function tambah_siswa($nisn, $nama, $jeniskelamin, $kodejurusan, $kelas, $alamat, $agama, $nohp){
        mysqli_query($this->koneksi,
        "insert into siswa (nisn,nama,jeniskelamin,kodejurusan,kelas,alamat,agama,nohp) values (
        '$nisn', '$nama', '$jeniskelamin', '$kodejurusan',
        '$kelas', '$alamat', '$agama', '$nohp')");
    }

    function tambah_jurusan($namajurusan){
        mysqli_query($this->koneksi,
        "insert into jurusan (namajurusan) values (
         '$namajurusan')");
    }

    function tambah_agama($nama_agama){
        mysqli_query($this->koneksi,
        "insert into agama (nama_agama) values (
        '$nama_agama')");
    }

    function tambahsiswa($nisn, $nama, $jeniskelamin, $kodejurusan, $kelas, $alamat, $agama, $nohp){
        mysqli_query($this->koneksi,
        "insert into siswa (nisn,nama,jeniskelamin,kodejurusan,kelas,alamat,agama,nohp) values (
        '$nisn', '$nama', '$jeniskelamin', '$kodejurusan',
        '$kelas', '$alamat', '$agama', '$nohp')");
    }

    function tambahjurusan($namajurusan){
        mysqli_query($this->koneksi,
        "insert into jurusan (namajurusan) values (
         '$namajurusan')");
    }

    function tambahagama($nama_agama){
        mysqli_query($this->koneksi,
        "insert into agama (nama_agama) values (
        '$nama_agama')");
    }
    
    function tambahusers($nama, $username, $password, $role){
        $query = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')";
        mysqli_query($this->koneksi, $query);
    }

    public function hapus_data_siswa($nisn) {
        $query = "DELETE FROM siswa WHERE nisn = '".$nisn."'";
        return mysqli_query($this->koneksi, $query);
    }

    public function hapus_data_agama($id_agama) {
        $query = "DELETE FROM agama WHERE id_agama = '".$id_agama."'";
        return mysqli_query($this->koneksi, $query);
    }
    
    public function hapus_data_jurusan($kodejurusan) {
        $query = "DELETE FROM jurusan WHERE kodejurusan = '".$kodejurusan."'";
        return mysqli_query($this->koneksi, $query);
    }
    
    public function hapus_data_user($id_users) {
        $query = "DELETE FROM users WHERE id_users = '".$id_users."'";
        return mysqli_query($this->koneksi, $query);
    }

    public function update_data_siswa($nisn, $nama, $jeniskelamin, $kelas, $alamat, $nohp, $jurusan, $agama) {
        $query = "UPDATE siswa SET 
                  nama='$nama', 
                  jeniskelamin='$jeniskelamin', 
                  kelas='$kelas', 
                  alamat='$alamat', 
                  nohp='$nohp',
                  kodejurusan='$jurusan',
                  agama='$agama'
                  WHERE nisn='$nisn'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }       
    }

    public function update_data_jurusan($kodejurusan, $namajurusan) {
        $query = "UPDATE jurusan SET 
                  namajurusan='$namajurusan' 
                  WHERE kodejurusan='$kodejurusan'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }       
    }

    public function update_data_agama($id_agama, $nama_agama) {
        $query = "UPDATE agama SET 
                  nama_agama='$nama_agama' 
                  WHERE id_agama='$id_agama'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }       
    }

    public function update_data_user($id_users, $nama, $username, $password, $role) {
        $query = "UPDATE users SET 
                  nama='$nama', 
                  username='$username', 
                  password='$password', 
                  role='$role'
                  WHERE id_users='$id_users'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }       
    }

    function jumlahdata_siswa(){
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total from siswa");
        $hasil = mysqli_fetch_assoc($data);
        return $hasil['total'];
    }
    function jumlahdata_agama(){
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total from agama");
        $hasil = mysqli_fetch_assoc($data);
        return $hasil['total'];
    }
    function jumlahdata_jurusan(){
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total from jurusan");
        $hasil = mysqli_fetch_assoc($data);
        return $hasil['total'];
    }
    function jumlahdata_user(){
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total from users");
        $hasil = mysqli_fetch_assoc($data);
        return $hasil['total'];
    }

    
    // Dalam class database
    function login($username, $password) {
        // Gunakan prepared statement untuk mencegah SQL injection
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($this->koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) == 1) {
            $users = mysqli_fetch_assoc($result);
            
            // Jika password di database di-hash (direkomendasikan)
            
            
            // Jika password tidak di-hash (tidak direkomendasikan)
            if($password === $users['password']) {
                return $users;
        }
        }
        
        return false;
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id_users = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

public function getStatistikKelas() {
    $query = "SELECT kelas, COUNT(nisn) as jumlah FROM siswa GROUP BY kelas";
    $result = mysqli_query($this->koneksi, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

public function getStatistikGender() {
    $query = "SELECT jeniskelamin, COUNT(nisn) as jumlah FROM siswa GROUP BY jeniskelamin";
    $result = mysqli_query($this->koneksi, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

} 
?>