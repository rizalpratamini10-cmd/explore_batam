<?php
$page_title = 'Kuliner Batam';
include 'config.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Ambil data kuliner (category_id = 4)
$query = "SELECT * FROM businesses WHERE category_id = 4 AND status = 'active' ORDER BY views DESC";
$result = mysqli_query($conn, $query);
$culinary = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="page-header">
    <div class="container">
        <h1>Kuliner Nusantara di Batam</h1>
        <p>Jelajahi cita rasa seafood, mie, kopi, dan makanan khas Batam</p>
    </div>
</section>

<div class="container">
    <div class="culinary-grid">
        <?php foreach($culinary as $food): ?>
            <div class="culinary-card">
                <div class="culinary-img" style="background-image: url('<?php echo UPLOADS_URL . 'umkm/' . $food['photo']; ?>');"></div>
                <div class="culinary-content">
                    <h3><?php echo $food['name']; ?></h3>
                    <div class="culinary-loc"><i class="fas fa-map-marker-alt"></i> <?php echo $food['district']; ?></div>
                    <div class="culinary-price"><i class="fas fa-tag"></i> Harga: Rp <?php echo number_format(rand(15000, 150000), 0, ',', '.'); ?> - an</div>
                    <p><?php echo substr($food['description'], 0, 80); ?>...</p>
                    <a href="https://wa.me/<?php echo $food['phone']; ?>" class="btn-order" target="_blank">
                        <i class="fab fa-whatsapp"></i> Pesan Makanan
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>