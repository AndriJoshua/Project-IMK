<?php
session_start();
include '../Database/db.php';

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_nama'])) {
    header("Location: login.php");
    exit;
}

//logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login_admin.php");
    exit;
}

$showSuccess = false;
$showUpdated = false;
$errorMsg = "";

// Tambah produk 
if (isset($_POST['tambah_produk'])) {
    $namaBaru = trim($_POST['nama_produk']);
    $hargaBaru = intval($_POST['harga_produk']);
    $deskripsiBaru = trim($_POST['deskripsi_produk']);
    $gambarBaru = null;

    // upload gambar 
    if (isset($_FILES['gambar_produk']) && $_FILES['gambar_produk']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/Gallery/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $ext = pathinfo($_FILES['gambar_produk']['name'], PATHINFO_EXTENSION);
        $namaFile = str_replace(' ', '_', $namaBaru) . '.' . strtolower($ext);
        $targetFile = $uploadDir . $namaFile;
        
        if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $targetFile)) {
            // Format URL untuk nyimpan di db 
            $gambarBaru = 'http://localhost/PROJECT%20IMK/UMKM-MARITIM/component/Gallery/' . $namaFile;
        }
    }

    if ($namaBaru && $hargaBaru > 0 && $deskripsiBaru && $gambarBaru) {
        $stmt = $conn->prepare("INSERT INTO produk (nama, harga, deskripsi, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $namaBaru, $hargaBaru, $deskripsiBaru, $gambarBaru);
        
        if ($stmt->execute()) {
            $showSuccess = true;
        } else {
            $errorMsg = "Gagal menambah produk: " . $conn->error;
        }
        $stmt->close();
    } else {
        $errorMsg = "Nama, harga, deskripsi, dan gambar wajib diisi!";
    }
}

// untuk edit deskripsi produk
if (isset($_POST['update_deskripsi'])) {
    $idProduk = intval($_POST['id_produk']);
    $deskripsiUpdate = trim($_POST['deskripsi_update']);
    
    if ($idProduk > 0 && $deskripsiUpdate) {
        $stmt = $conn->prepare("UPDATE produk SET deskripsi = ? WHERE id = ?");
        $stmt->bind_param("si", $deskripsiUpdate, $idProduk);
        
        if ($stmt->execute()) {
            $showUpdated = true;
        } else {
            $errorMsg = "Gagal mengupdate deskripsi: " . $conn->error;
        }
        $stmt->close();
    } else {
        $errorMsg = "Deskripsi tidak boleh kosong!";
    }
}

// Hapus produk 
if (isset($_GET['hapus']) && $_GET['hapus']) {
    $idHapus = intval($_GET['hapus']);
    

    $res = $conn->query("SELECT gambar FROM produk WHERE id=$idHapus");
    if ($row = $res->fetch_assoc()) {
        if (!empty($row['gambar'])) {
            // Extract filename dari URL
            $filename = basename(parse_url($row['gambar'], PHP_URL_PATH));
            $filepath = __DIR__ . '/Gallery/' . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }
        }
    }
    
    $conn->query("DELETE FROM produk WHERE id=$idHapus");
    header("Location: " . $_SERVER['PHP_SELF'] . "?deleted=1");
    exit;
}

$showDeleted = isset($_GET['deleted']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Produk</title>
    <link rel="stylesheet" href="../component/checkout.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .checkout-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .checkout-header h1 {
            color: #fff;
            font-size: 2.5em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .logout-btn:hover {
            background: linear-gradient(45deg, #c82333, #a71e2a);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            color: white;
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .alert-success {
            background: #28a745;
            color: #fff;
        }

        .alert-danger {
            background: #dc3545;
            color: #fff;
        }

        .alert-info {
            background: #17a2b8;
            color: #fff;
        }

        .admin-add-product {
            background: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        .admin-add-product h3 {
            color: #fff;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.3em;
        }

        .admin-add-product form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            align-items: start;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .admin-add-product label {
            color: #fff;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .admin-add-product input[type="text"],
        .admin-add-product input[type="number"],
        .admin-add-product textarea {
            padding: 12px;
            border: 2px solid #444;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .admin-add-product input[type="text"]:focus,
        .admin-add-product input[type="number"]:focus,
        .admin-add-product textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        .admin-add-product textarea {
            resize: vertical;
            min-height: 80px;
        }

        .admin-add-product input[type="file"] {
            padding: 10px;
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border: 2px dashed #444;
            border-radius: 8px;
        }

        .admin-add-product button {
            padding: 12px 25px;
            border: none;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s;
            grid-column: span 2;
            justify-self: center;
        }

        .admin-add-product button:hover {
            background: linear-gradient(45deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .admin-product-list {
            background: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .admin-product-list h3 {
            color: #fff;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.3em;
        }

        .admin-product-list table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            overflow: hidden;
        }

        .admin-product-list th,
        .admin-product-list td {
            padding: 15px;
            color: #fff;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-product-list th {
            background: rgba(0, 0, 0, 0.5);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9em;
        }

        .admin-product-list tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-product-list img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .admin-product-list a {
            color: #00c3ff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .admin-product-list a:hover {
            color: #fff;
        }

        .edit-form {
            display: none;
            margin-top: 10px;
        }

        .edit-form textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #444;
            background: rgba(255, 255, 255, 0.9);
            margin-bottom: 10px;
        }

        .edit-form button {
            padding: 6px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-save {
            background: #28a745;
            color: white;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        @media (max-width: 768px) {
            .checkout-header div {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .checkout-header h1 {
                font-size: 2em;
            }
            
            .admin-add-product form {
                grid-template-columns: 1fr;
            }
            
            .admin-add-product button {
                grid-column: span 1;
            }
            
            .admin-product-list {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="checkout-header">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <h1>🛍️ Admin Panel - Kelola Produk</h1>
                <div class="admin-info">
                    <span style="color: #fff; margin-right: 15px;">
                        👋 Selamat datang, <strong><?= htmlspecialchars($_SESSION['admin_nama']) ?></strong>
                    </span>
                    <a href="?logout=1" class="logout-btn" onclick="return confirm('Yakin ingin logout?')">
                        🚪 Logout
                    </a>
                </div>
            </div>
        </div>

        <?php if ($showSuccess): ?>
            <div class="alert alert-success">
                ✅ Produk berhasil ditambahkan!
            </div>
        <?php endif; ?>

        <?php if ($showUpdated): ?>
            <div class="alert alert-info">
                ✅ Deskripsi produk berhasil diupdate!
            </div>
        <?php endif; ?>

        <?php if ($showDeleted): ?>
            <div class="alert alert-danger">
                🗑️ Produk berhasil dihapus!
            </div>
        <?php endif; ?>

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger">
                ❌ <?= htmlspecialchars($errorMsg) ?>
            </div>
        <?php endif; ?>

        <div class="admin-add-product">
            <h3>➕ Tambah Produk Baru</h3>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk:</label>
                    <input type="text" id="nama_produk" name="nama_produk" required>
                </div>

                <div class="form-group">
                    <label for="harga_produk">Harga (Rp):</label>
                    <input type="number" id="harga_produk" name="harga_produk" min="1" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi_produk">Deskripsi:</label>
                    <textarea id="deskripsi_produk" name="deskripsi_produk" rows="3" required placeholder="Masukkan deskripsi produk..."></textarea>
                </div>

                <div class="form-group">
                    <label for="gambar_produk">Gambar Produk:</label>
                    <input type="file" id="gambar_produk" name="gambar_produk" accept="image/*" required>
                </div>

                <button type="submit" name="tambah_produk">🚀 Tambah Produk</button>
            </form>
        </div>

        <div class="admin-product-list">
            <h3>📋 Daftar Produk</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = $conn->query("SELECT * FROM produk ORDER BY id DESC");
                    if ($res && $res->num_rows > 0) {
                        while ($produk = $res->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td><strong>' . htmlspecialchars($produk['nama']) . '</strong></td>';
                            echo '<td><span style="color: #4CAF50;">Rp ' . number_format($produk['harga'], 0, ',', '.') . '</span></td>';
                            echo '<td>';
                            echo '<div id="desc-display-' . $produk['id'] . '">';
                            echo htmlspecialchars($produk['deskripsi'] ?? 'Tidak ada deskripsi');
                            echo '</div>';
                            echo '<div id="desc-edit-' . $produk['id'] . '" class="edit-form">';
                            echo '<form method="post" action="">';
                            echo '<input type="hidden" name="id_produk" value="' . $produk['id'] . '">';
                            echo '<textarea name="deskripsi_update" rows="2">' . htmlspecialchars($produk['deskripsi'] ?? '') . '</textarea>';
                            echo '<button type="submit" name="update_deskripsi" class="btn-save">💾 Simpan</button>';
                            echo '<button type="button" class="btn-cancel" onclick="cancelEdit(' . $produk['id'] . ')">❌ Batal</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</td>';
                            echo '<td>';
                            if (!empty($produk['gambar'])) {
                                echo '<img src="' . htmlspecialchars($produk['gambar']) . '" alt="' . htmlspecialchars($produk['nama']) . '">';
                            } else {
                                echo '<span style="color: #888;">Tidak ada gambar</span>';
                            }
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="javascript:void(0)" onclick="editDesc(' . $produk['id'] . ')">✏️ Edit Deskripsi</a>';
                            echo ' | ';
                            echo '<a href="?hapus=' . urlencode($produk['id']) . '" onclick="return confirm(\'Yakin hapus produk ini?\')" style="color: #dc3545;">🗑️ Hapus</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" style="text-align: center; color: #888;">📭 Tidak ada data produk.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function editDesc(id) {
            document.getElementById('desc-display-' + id).style.display = 'none';
            document.getElementById('desc-edit-' + id).style.display = 'block';
        }

        function cancelEdit(id) {
            document.getElementById('desc-display-' + id).style.display = 'block';
            document.getElementById('desc-edit-' + id).style.display = 'none';
        }
    </script>
</body>
</html>