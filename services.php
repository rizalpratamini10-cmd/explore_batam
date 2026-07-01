<?php
$page_title = 'Jasa & Servis Batam';
include 'config.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Ambil data jasa & servis (category_id = 3)
$query = "SELECT * FROM businesses WHERE category_id = 3 AND status = 'active' ORDER BY is_featured DESC";
$result = mysqli_query($conn, $query);
$services = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="page-header">
    <div class="container">
        <h1>Jasa & Servis Batam</h1>
        <p>Temukan berbagai layanan jasa terbaik di Batam</p>
    </div>
</section>

<div class="container">
    <!-- Sub Kategori Quick Access -->
    <div class="subcat-tabs">
        <a href="#" class="subcat-tab active" data-filter="all">Semua</a>
        <a href="#" class="subcat-tab" data-filter="Rental">🚗 Rental Kendaraan</a>
        <a href="#" class="subcat-tab" data-filter="Servis">🔧 Servis Elektronik</a>
        <a href="#" class="subcat-tab" data-filter="Laundry">🧺 Laundry</a>
        <a href="#" class="subcat-tab" data-filter="Salon">💇 Salon & Kecantikan</a>
        <a href="#" class="subcat-tab" data-filter="Bengkel">🔩 Bengkel</a>
    </div>

    <!-- Services Grid -->
    <div class="services-grid" id="servicesContainer">
        <?php foreach($services as $service): ?>
            <div class="service-card" data-type="<?php echo strpos($service['name'], 'Rental') !== false || strpos($service['description'], 'rental') !== false ? 'Rental' : 
                                                    (strpos($service['name'], 'Laundry') !== false ? 'Laundry' :
                                                    (strpos($service['name'], 'Salon') !== false ? 'Salon' :
                                                    (strpos($service['description'], 'servis') !== false ? 'Servis' : 'Bengkel'))); ?>">
                <div class="service-img" style="background-image: url('<?php echo UPLOADS_URL . 'umkm/' . $service['photo']; ?>');"></div>
                <div class="service-content">
                    <h3><?php echo $service['name']; ?></h3>
                    <div class="service-loc"><i class="fas fa-map-marker-alt"></i> <?php echo $service['district']; ?></div>
                    <div class="service-hours"><i class="far fa-clock"></i> <?php echo $service['open_hours'] ?? '08.00 - 20.00'; ?></div>
                    <p><?php echo substr($service['description'], 0, 100); ?>...</p>
                    <div class="service-buttons">
                        <a href="https://wa.me/<?php echo $service['phone']; ?>" class="btn-wa" target="_blank">
                            <i class="fab fa-whatsapp"></i> Pesan Sekarang
                        </a>
                        <a href="<?php echo base_url('umkm-detail.php?id=' . $service['id']); ?>" class="btn-detail">Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
// Filter sub kategori
document.querySelectorAll('.subcat-tab').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.subcat-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        let filter = this.dataset.filter;
        let cards = document.querySelectorAll('.service-card');
        
        cards.forEach(card => {
            if (filter === 'all' || card.dataset.type === filter) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>