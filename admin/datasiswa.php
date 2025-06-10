<?php

session_start();

// Redirect ke halaman login jika belum login
if (!isset($_SESSION['id_users'])) {
    header("Location: ../login.php");
    exit();
}

// Cek role
if ($_SESSION['role'] != 'admin') {
    header("Location: ../unauthorized.php");
    exit();
}
include "../koneksi.php";
$db = new database();

// Proses form edit jika ada POST request
if ($_POST && isset($_POST['nisn'])) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $jurusan = $_POST['jurusan'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $nohp = $_POST['nohp'];
    
    // Update data siswa
    $db->update_data_siswa($nisn, $nama, $jeniskelamin, $kelas, $alamat, $nohp, $jurusan, $agama);
    
    // Redirect untuk menghindari double submit
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();    
}
if(isset($_GET['status'])) {
    if($_GET['status'] == 'deleted') {
        echo '<script>alert("Data berhasil dihapus");</script>';
    } elseif($_GET['status'] == 'delete_failed') {
        echo '<script>alert("Gagal menghapus data");</script>';
    }
}
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Simple Tables</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Simple Tables" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
  <style>

table th, table td {
    text-align: left !important;
}

tr td a[href*="editsiswa"],
tr td a[href*="hapus_siswa"] {
  text-decoration: none;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 14px;
  color: white;
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
    background: #007BFF;
    padding: 8px 15px;
    color: white;
    border-radius: 5px;
}

a[href*="tambah"]:hover {
    background:rgb(4, 83, 180);
}

  /* Add these styles to your existing CSS */
  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  
  #myTable {
    width: 100% !important;
  }

  /* CSS untuk mengatur posisi elemen kontrol DataTables */
.top-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 15px;
    margin-top: 15px;
    width: 100%;
}

.bottom-container {
    margin-top: 15px;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    width: 100%;
}

/* Untuk tampilan mobile */
@media (max-width: 768px) {
    .top-container {
        flex-direction: column;
    }
    
    .top-left, .top-right { 
        width: 100%;
        margin-bottom: 10px;
    }
    
    .dataTables_filter input {
        width: 100% !important;
    }
    
    .dataTables_length select {
        width: 100% !important;
    }
}

/* Pastikan tabel yang discroll tidak mempengaruhi kontrol */
.card-body {
    overflow: visible !important;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin-top: 0;
    border: none;
}
  
  /* Mobile-specific styles */
  @media (max-width: 768px) {
    body {
      font-size: 14px;
    }
    
    .table {
      font-size: 13px;
    }
    
    .card-body {
      padding: 0.5rem;
    }
    
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_filter input {
      font-size: 13px;
    }
    
    .dataTables_wrapper .dataTables_length select {
      padding: 0.2rem 0.5rem;
    }
  }
  
  /* Ensure buttons remain usable on mobile */
  .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
  }

  @media (max-width: 768px) {
    .dataTables_wrapper .top {
        position: relative;
    }
    
    thead {
        position: relative;
        top: auto;
    }
    
    .dataTables_filter, 
    .dataTables_length {
        float: none;
        width: 100%;
        margin-bottom: 10px;
    }
    
    .dataTables_filter input {
        width: 100% !important;
    }
    
    .dataTables_length select {
        width: 100% !important;
    }
}

  </style>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body sticky-top">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="../dist/assets/img/user1-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="../dist/assets/img/user8-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="../dist/assets/img/user3-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="../dist/assets/img/admin.png"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline"><?php echo $_SESSION['role']; ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="../dist/assets/img/admin.png"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    <?php echo $_SESSION['nama']; ?>
                    <small>Role: <?php echo $_SESSION['role']; ?></small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                  <a href="../logout.php" class="btn btn-default btn-flat float-end">Logout</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <?php include "sidebar.php"; ?>
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Data Siswa</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!-- /.col -->
              <div class="col-md-12">
                <!-- /.card -->
                <div class="card mb-4">
                  <!-- /.card-header -->
                  <div class="card-body p-0 table-responsive">
                        <table id="myTable" class="display nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th style="width: 5px">No</th>
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
                      </thead>
                      <tbody>
                        <?php
                          $no = 1;
                          foreach($db->tampil_data_siswa() as $x){
                          ?>
                          <tr class="align-middle">
                              <td><?php echo $no++ ?></td>
                              <td><?php echo $x['nisn'] ?></td>
                              <td><?php echo $x['nama'] ?></td>
                              <td><?php echo $x['jeniskelamin'] ?></td>
                              <td><?php echo $x['jurusan'] ?></td>
                              <td><?php echo $x['kelas'] ?></td>
                              <td><?php echo $x['alamat'] ?></td>
                              <td><?php echo $x['agama'] ?></td>
                              <td><?php echo $x['nohp'] ?></td>
                              <td>
                                  <!-- Tombol Edit (trigger modal) -->
                                    <button class="btn btn-warning btn-sm mb-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit<?= $x['nisn']; ?>">
                                      Edit
                                    </button>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modalEdit<?= $x['nisn']; ?>" 
                                        data-bs-backdrop="static" 
                                        data-bs-keyboard="false" 
                                        tabindex="-1" 
                                        aria-labelledby="labelEdit<?= $x['nisn']; ?>" 
                                        aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <form action="datasiswa.php" method="POST">
                                            <div class="modal-header bg-warning">
                                              <h5 class="modal-title" id="labelEdit<?= $x['nisn']; ?>">Edit Data Siswa</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <input type="hidden" name="nisn" value="<?= $x['nisn']; ?>">
                                              <div class="mb-3">
                                                <label for="nama<?= $x['nisn']; ?>" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama<?= $x['nisn']; ?>" name="nama" value="<?= htmlspecialchars($x['nama']); ?>" required>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <select name="jeniskelamin" class="form-select">
                                                  <option value="L" <?= $x['jeniskelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                                  <option value="P" <?= $x['jeniskelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Jurusan</label>
                                                <select name="jurusan" class="form-select" required>
                                                  <?php foreach ($db->tampil_data_jurusan() as $jur) : ?>
                                                    <option value="<?= $jur['kodejurusan']; ?>" <?= $jur['kodejurusan'] == $x['kodejurusan'] ? 'selected' : ''; ?>>
                                                      <?= htmlspecialchars($jur['namajurusan']); ?>
                                                    </option>
                                                  <?php endforeach; ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Kelas</label>
                                                <input type="text" class="form-control" name="kelas" value="<?= htmlspecialchars($x['kelas']); ?>" required>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" value="<?= htmlspecialchars($x['alamat']); ?>">
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">Agama</label>
                                                <select name="agama" class="form-select" required>
                                                  <?php foreach ($db->tampil_data_agama() as $agm) : ?>
                                                    <option value="<?= $agm['id_agama']; ?>" <?= $agm['id_agama'] == $x['agama'] ? 'selected' : ''; ?>>
                                                      <?= htmlspecialchars($agm['nama_agama']); ?>
                                                    </option>
                                                  <?php endforeach; ?>
                                                </select>
                                              </div>
                                              <div class="mb-3">
                                                <label class="form-label">No HP</label>
                                                <input type="text" class="form-control" name="nohp" value="<?= htmlspecialchars($x['nohp']); ?>">
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                              <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  <!-- Tombol Hapus (trigger modal) -->
                                    <button class="btn btn-danger btn-sm mb-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalHapus<?= $x['nisn']; ?>">
                                      Hapus
                                    </button>
                                    
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modalHapus<?= $x['nisn']; ?>" 
                                        data-bs-backdrop="static" 
                                        data-bs-keyboard="false" 
                                        tabindex="-1" 
                                        aria-labelledby="labelHapus<?= $x['nisn']; ?>" 
                                        aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="labelHapus<?= $x['nisn']; ?>">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Yakin ingin menghapus data siswa ini?</p>
                                            <ul class="list-unstyled">
                                              <li><strong>NISN:</strong> <?= htmlspecialchars($x['nisn']); ?></li>
                                              <li><strong>Nama:</strong> <?= htmlspecialchars($x['nama']); ?></li>
                                              <li><strong>Jenis Kelamin:</strong> <?= ($x['jeniskelamin'] == 'P') ? 'Perempuan' : 'Laki-laki'; ?></li>
                                              <li><strong>Jurusan:</strong> <?= htmlspecialchars($x['namajurusan'] ?? '-'); ?></li>
                                              <li><strong>Kelas:</strong> <?= htmlspecialchars($x['kelas']); ?></li>
                                              <li><strong>Alamat:</strong> <?= htmlspecialchars($x['alamat']); ?></li>
                                              <li><strong>Agama:</strong> <?= htmlspecialchars($x['nama_agama'] ?? '-'); ?></li>
                                              <li><strong>No HP:</strong> <?= htmlspecialchars($x['nohp']); ?></li>
                                            </ul>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <a href="hapus_siswa.php?nisn=<?= $x['nisn']; ?>" class="btn btn-danger">Hapus</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                              </td>
                          </tr>
                          <?php
                          }
                          ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <a href="tambahsiswa.php">Tambah Data</a> </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2024&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <script>
      $(document).ready(function() {
    $('#myTable').DataTable({
        responsive: true,
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthChange: true,
        pageLength: 10,
        language: {
            paginate: {
                previous: "<i class='bi bi-chevron-left'></i>",
                next: "<i class='bi bi-chevron-right'></i>"
            },
        },
        dom: '<"top-container"<"top-left"l><"top-right"f>>rt<"bottom-container"ip><"clear">'
    });
});
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
