<?php
session_start();

// Redirect ke halaman login jika belum login
// Redirect ke halaman login jika belum login
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

// Proses form edit jika ada POST request
if ($_POST && isset($_POST['id_agama'])) {
    $id_agama = $_POST['id_agama'];
    $nama_agama = $_POST['nama_agama'];
    
    // Update data agama
    $db->update_data_agama($id_agama, $nama_agama);
    
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
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
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
              <div class="col-sm-6"><h3 class="mb-0">Data Agama</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Agama</li>
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
                            <th>Id Agama</th>
                            <th>Nama Agama</th>
                            <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $no = 1;
                        foreach($db->tampil_data_agama() as $x){
                        ?>
                        <tr class="align-middle">
                            <td><?php echo $x['id_agama'] ?></td>
                            <td><?php echo $x['nama_agama'] ?></td>
                            <td>
                              <!-- Tombol Edit (trigger modal) -->
                                    <button class="btn btn-warning btn-sm mb-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit<?= $x['id_agama']; ?>">
                                      Edit
                                    </button>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEdit<?= $x['id_agama']; ?>" 
                                    data-bs-backdrop="static" 
                                    data-bs-keyboard="false" 
                                    tabindex="-1" 
                                    aria-labelledby="labelEdit<?= $x['id_agama']; ?>" 
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title" id="labelEdit<?= $x['id_agama']; ?>">Edit Data Agama</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_agama" value="<?= $x['id_agama']; ?>">
                                                    <div class="mb-3">
                                                        <label for="nama_agama<?= $x['nama_agama']; ?>" class="form-label">Nama Agama</label>
                                                        <input type="text" class="form-control" id="nama_agama<?= $x['nama_agama']; ?>" 
                                                              name="nama_agama" value="<?= htmlspecialchars($x['nama_agama']); ?>" required>
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
                                            data-bs-target="#modalHapus<?= $x['id_agama']; ?>">
                                      Hapus
                                    </button>
                                    
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modalHapus<?= $x['id_agama']; ?>" 
                                        data-bs-backdrop="static" 
                                        data-bs-keyboard="false" 
                                        tabindex="-1" 
                                        aria-labelledby="labelHapus<?= $x['id_agama']; ?>" 
                                        aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="labelHapus<?= $x['id_agama']; ?>">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <p>Yakin ingin menghapus data agama ini?</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <a href="hapus_agama.php?id_agama=<?= $x['id_agama']; ?>" class="btn btn-danger">Hapus</a>
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
                <a href="tambahagama.php">Tambah Data</a> </div>
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
