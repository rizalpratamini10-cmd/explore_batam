<?php
session_start();
include '../includes/config.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Ambil semua UMKM yang pending
$query = "SELECT * FROM businesses WHERE status = 'pending' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$pending_businesses = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Proses approve
if (isset($_GET['approve'])) {
    $id = (int)$_GET['approve'];
    mysqli_query($conn, "UPDATE businesses SET status = 'active' WHERE id = $id");
    header("Location: verify-umkm.php");
    exit();
}

// Proses reject
if (isset($_GET['reject'])) {
    $id = (int)$_GET['reject'];
    mysqli_query($conn, "DELETE FROM businesses WHERE id = $id");
    header("Location: verify-umkm.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Verifikasi UMKM</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .umkm-list { display: flex; flex-direction: column; gap: 20px; }
        .umkm-item { border: 1px solid #ddd; padding: 15px; border-radius: 10px; }
        .btn-approve { background: green; color: white; padding: 5px 15px; text-decoration: none; border-radius: 5px; }
        .btn-reject { background: red; color: white; padding: 5px 15px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Verifikasi UMKM Baru</h1>
    <p>Total UMKM menunggu verifikasi: <?php echo count($pending_businesses); ?></p>
    
    <div class="umkm-list">
        <?php foreach($pending_businesses as $umkm): ?>
            <div class="umkm-item">
                <h3><?php echo $umkm['name']; ?></h3>
                <p><?php echo $umkm['description']; ?></p>
                <p><strong>WhatsApp:</strong> <?php echo $umkm['phone']; ?></p>
                <?php if(!empty($umkm['website_url'])): ?>
                    <p><strong>Website:</strong> <?php echo $umkm['website_url']; ?></p>
                <?php endif; ?>
                <p><strong>Alamat:</strong> <?php echo $umkm['address']; ?></p>
                
                <div style="margin-top: 10px;">
                    <a href="?approve=<?php echo $umkm['id']; ?>" class="btn-approve" onclick="return confirm('Setujui UMKM ini?')">✓ Approve</a>
                    <a href="?reject=<?php echo $umkm['id']; ?>" class="btn-reject" onclick="return confirm('Tolak UMKM ini?')">✗ Reject</a>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if(count($pending_businesses) == 0): ?>
            <p>Tidak ada UMKM yang menunggu verifikasi.</p>
        <?php endif; ?>
    </div>
</body>
</html>