<?php
$page_title = 'Daftar UMKM Batam';
include 'includes/config.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Ambil parameter filter
$category = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$search = isset($_GET['search']) ? escape($_GET['search']) : '';
$district = isset($_GET['district']) ? escape($_GET['district']) : '';

// Query database
$query = "SELECT * FROM businesses WHERE status = 'active'";
if ($category > 0) {
    $query .= " AND category_id = $category";
}
if (!empty($search)) {
    $query .= " AND (name LIKE '%$search%' OR description LIKE '%$search%')";
}
if (!empty($district)) {
    $query .= " AND district = '$district'";
}
$query .= " ORDER BY is_featured DESC, views DESC";

$result = mysqli_query($conn, $query);
$businesses = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Ambil semua kategori untuk filter
$categories = getCategories();
?>

<section class="page-header">
    <div class="container">
        <h1>UMKM Batam</h1>
        <p>Temukan ribuan produk unggulan, fesyen, elektronik, dan kerajinan khas Batam</p>
    </div>
</section>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-group">
                <div class="search-box">
                    <input type="text" name="search" placeholder="Cari UMKM, produk, atau nama usaha..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
                <div class="filter-category">
                    <select name="category" onchange="this.form.submit()">
                        <option value="0">Semua Kategori</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo $category == $cat['id'] ? 'selected' : ''; ?>>
                                <?php echo $cat['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-location">
                    <select name="district" onchange="this.form.submit()">
                        <option value="">Semua Kecamatan</option>
                        <option value="Batu Aji" <?php echo $district == 'Batu Aji' ? 'selected' : ''; ?>>Batu Aji</option>
                        <option value="Batam Center" <?php echo $district == 'Batam Center' ? 'selected' : ''; ?>>Batam Center</option>
                        <option value="Bengkong" <?php echo $district == 'Bengkong' ? 'selected' : ''; ?>>Bengkong</option>
                        <option value="Nagoya" <?php echo $district == 'Nagoya' ? 'selected' : ''; ?>>Nagoya</option>
                        <option value="Sekupang" <?php echo $district == 'Sekupang' ? 'selected' : ''; ?>>Sekupang</option>
                        <option value="Sagulung" <?php echo $district == 'Sagulung' ? 'selected' : ''; ?>>Sagulung</option>
                        <option value="Lubuk Baja" <?php echo $district == 'Lubuk Baja' ? 'selected' : ''; ?>>Lubuk Baja</option>
                        <option value="Nongsa" <?php echo $district == 'Nongsa' ? 'selected' : ''; ?>>Nongsa</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Result Count -->
    <div class="result-count">
        <p>Menampilkan <strong><?php echo count($businesses); ?></strong> UMKM di Batam</p>
    </div>

    <!-- UMKM Grid -->
    <div class="umkm-grid">
        <?php if(!empty($businesses)): ?>
            <?php foreach($businesses as $business): ?>
                <div class="umkm-card">
                    <div class="card-img" style="background-image: url('<?php echo UPLOADS_URL . 'umkm/' . $business['photo']; ?>');">
                        <?php if($business['is_featured']): ?>
                            <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <span class="card-category">
                            <?php 
                            $cat_query = "SELECT name FROM categories WHERE id = " . $business['category_id'];
                            $cat_result = mysqli_query($conn, $cat_query);
                            $cat_name = mysqli_fetch_assoc($cat_result);
                            echo $cat_name['name'] ?? 'UMKM';
                            ?>
                        </span>
                        <h3 class="card-title"><?php echo $business['name']; ?></h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i> <?php echo $business['district']; ?>, Batam
                        </div>
                        <p class="card-desc"><?php echo substr($business['description'], 0, 100); ?>...</p>
                        <div class="card-contact">
                            <?php if(!empty($business['phone'])): ?>
                                <a href="https://wa.me/<?php echo $business['phone']; ?>" class="whatsapp-btn" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Chat
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo base_url('umkm-detail.php?id=' . $business['id']); ?>" class="detail-btn">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-store-slash"></i>
                <h3>Belum ada UMKM ditemukan</h3>
                <p>Silakan daftarkan usaha Anda atau coba filter lain.</p>
                <a href="<?php echo base_url('register-umkm.php'); ?>" class="btn-primary">Daftar UMKM Gratis</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>