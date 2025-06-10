<?php
session_start();

// Redirect jika bukan admin
if ($_SESSION['role'] != 'admin') {
    header("Location: unauthorized.php");
    exit();
}

include "koneksi.php";
$db = new database();

// Proses upload gambar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $target_dir = "dist/assets/img/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File bukan gambar.');</script>";
        $uploadOk = 0;
    }
    
    // Check file size (max 2MB)
    if ($_FILES["profile_image"]["size"] > 2000000) {
        echo "<script>alert('Ukuran gambar terlalu besar (max 2MB).');</script>";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Hanya format JPG, JPEG, PNG yang diizinkan.');</script>";
        $uploadOk = 0;
    }
    
    // If everything is ok, try to upload file
    if ($uploadOk == 1) {
        // Generate unique filename
        $new_filename = "user_" . $_SESSION['id_users'] . "." . $imageFileType;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            // Update nama file gambar di session
            $_SESSION['profile_image'] = $new_filename;
            echo "<script>alert('Gambar profil berhasil diupdate.');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat upload gambar.');</script>";
        }
    }
}

// Set default image if not exists
$profile_image = isset($_SESSION['profile_image']) ? "dist/assets/img/" . $_SESSION['profile_image'] : "dist/assets/img/user2-160x160.jpg";
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Profil Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" />
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 60px;
        }
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-details {
            margin-top: 20px;
        }
        .detail-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> <?php echo $_SESSION['nama']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="index.php"><i class="bi bi-house-door me-2"></i> Dashboard</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Content -->
    <div class="container profile-container my-5">
        <div class="profile-header">
            <img src="<?php echo $profile_image; ?>" alt="Profile Image" class="profile-img">
            <h2 class="mt-3"><?php echo $_SESSION['nama']; ?></h2>
            <span class="badge bg-success"><?php echo $_SESSION['role']; ?></span>
            
            <!-- Form Upload Gambar -->
            <form method="post" enctype="multipart/form-data" class="mt-3">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/jpeg, image/png">
                    <button class="btn btn-primary" type="submit">Upload</button>
                </div>
                <small class="text-muted">Format: JPG/PNG (max 2MB)</small>
            </form>
        </div>

        <div class="profile-details">
            <!-- Informasi profil (read-only) -->
            <div class="row detail-item">
                <div class="col-md-3 detail-label">Username:</div>
                <div class="col-md-9"><?php echo $_SESSION['username'] ?? 'N/A'; ?></div>
            </div>
            
            <div class="row detail-item">
                <div class="col-md-3 detail-label">Role:</div>
                <div class="col-md-9"><?php echo $_SESSION['role']; ?></div>
            </div>

            <div class="row detail-item">
                <div class="col-md-3 detail-label">Terakhir Login:</div>
                <div class="col-md-9"><?php echo $_SESSION['last_login'] ?? 'N/A'; ?></div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>