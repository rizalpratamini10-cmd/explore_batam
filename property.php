<?php
$page_title = 'Properti & Sewa Batam';
include 'config.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Ambil data properti (category_id = 5)
$query = "SELECT * FROM businesses WHERE category_id = 5 AND status = 'active' ORDER BY is_featured DESC";
$result = mysqli_query($conn, $query);
$properties = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="page-header">
    <div class="container">
        <h1>Properti & Sewa di Batam</h1>
        <p>Temukan kost, ruko, apartemen, dan tanah untuk investasi</p>
    </div>
</section>

<div class="container">
    <div class="property-grid">
        <?php foreach($properties as $property): ?>
            <div class="property-card">
                <div class="property-img" style="background-image: url('<?php echo UPLOADS_URL . 'umkm/' . $property['photo']; ?>');">
                    <span class="property-type"><?php echo strpos($property['name'], 'Kost') !== false ? 'Kost' : (strpos($property['name'], 'Ruko') !== false ? 'Ruko' : 'Properti'); ?></span>
                </div>
                <div class="property-content">
                    <h3><?php echo $property['name']; ?></h3>
                    <div class="property-loc"><i class="fas fa-map-marker-alt"></i> <?php echo $property['district']; ?></div>
                    <div class="property-price"><i class="fas fa-money-bill-wave"></i> Sewa: Rp <?php echo number_format(rand(500000, 5000000), 0, ',', '.'); ?> / bulan</div>
                    <p><?php echo substr($property['description'], 0, 100); ?>...</p>
                    <a href="https://wa.me/<?php echo $property['phone']; ?>" class="btn-contact" target="_blank">
                        <i class="fab fa-whatsapp"></i> Hubungi Pemilik
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>