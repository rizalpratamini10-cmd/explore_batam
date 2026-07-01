<?php
$page_title = 'Wisata Batam';
include 'config.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Ambil data wisata dari database (category_id = 1)
$query = "SELECT * FROM businesses WHERE category_id = 1 AND status = 'active' ORDER BY views DESC";
$result = mysqli_query($conn, $query);
$tourism_spots = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="page-header">
    <div class="container">
        <h1>Wisata Batam</h1>
        <p>Temukan keindahan alam dan destinasi wisata terbaik di Batam</p>
    </div>
</section>

<div class="container">
    <!-- Filter Wisata -->
    <div class="filter-section">
        <div class="filter-group">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari tempat wisata...">
                <button onclick="filterWisata()"><i class="fas fa-search"></i> Cari</button>
            </div>
            <div class="filter-category">
                <select id="typeFilter" onchange="filterWisata()">
                    <option value="all">Semua Jenis</option>
                    <option value="Alam">Wisata Alam</option>
                    <option value="Buatan">Wisata Buatan</option>
                    <option value="Religi">Wisata Religi</option>
                    <option value="Sejarah">Wisata Sejarah</option>
                </select>
            </div>
            <div class="filter-location">
                <select id="locationFilter" onchange="filterWisata()">
                    <option value="all">Semua Kecamatan</option>
                    <option value="Nongsa">Nongsa</option>
                    <option value="Sekupang">Sekupang</option>
                    <option value="Nagoya">Nagoya</option>
                    <option value="Batam Center">Batam Center</option>
                    <option value="Galang">Galang</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Daftar Wisata -->
    <div class="wisata-grid" id="wisataContainer">
        <?php if(!empty($tourism_spots)): ?>
            <?php foreach($tourism_spots as $spot): ?>
                <div class="wisata-card" data-type="<?php echo $spot['tags']; ?>" data-location="<?php echo $spot['district']; ?>">
                    <div class="wisata-img" style="background-image: url('<?php echo UPLOADS_URL . 'umkm/' . $spot['photo']; ?>');">
                        <span class="wisata-badge"><?php echo $spot['tags']; ?></span>
                    </div>
                    <div class="wisata-content">
                        <h3><?php echo $spot['name']; ?></h3>
                        <div class="wisata-loc"><i class="fas fa-map-marker-alt"></i> <?php echo $spot['district']; ?>, Batam</div>
                        <p><?php echo substr($spot['description'], 0, 120); ?>...</p>
                        <a href="<?php echo base_url('umkm-detail.php?id=' . $spot['id']); ?>" class="btn-detail">Lihat Detail →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-map-marked-alt"></i>
                <p>Belum ada data wisata. Silakan tambahkan melalui admin panel.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Rekomendasi Wisata Populer -->
<div class="container">
    <div class="section-title">Rekomendasi <span>Wisata Populer</span></div>
    <div class="popular-wisata">
        <div class="pop-card">
            <img src="https://images.pexels.com/photos/2387873/pexels-photo-2387873.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Jembatan Barelang">
            <div class="pop-overlay">
                <h4>Jembatan Barelang</h4>
                <p>Ikon wisata Batam, menghubungkan 3 pulau</p>
            </div>
        </div>
        <div class="pop-card">
            <img src="https://images.pexels.com/photos/16434092/pexels-photo-16434092.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Pantai Melur">
            <div class="pop-overlay">
                <h4>Pantai Melur</h4>
                <p>Pasir putih, air jernih, cocok untuk liburan keluarga</p>
            </div>
        </div>
        <div class="pop-card">
            <img src="https://images.pexels.com/photos/2398220/pexels-photo-2398220.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Maha Vihara">
            <div class="pop-overlay">
                <h4>Maha Vihara Duta Maitreya</h4>
                <p>Vihara terbesar di Batam, spot foto favorit</p>
            </div>
        </div>
    </div>
</div>

<script>
function filterWisata() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var type = document.getElementById('typeFilter').value;
    var location = document.getElementById('locationFilter').value;
    var cards = document.querySelectorAll('.wisata-card');
    
    cards.forEach(function(card) {
        var title = card.querySelector('h3').innerText.toLowerCase();
        var desc = card.querySelector('p').innerText.toLowerCase();
        var cardType = card.dataset.type;
        var cardLoc = card.dataset.location;
        
        var matchSearch = title.includes(search) || desc.includes(search);
        var matchType = type === 'all' || cardType === type;
        var matchLoc = location === 'all' || cardLoc === location;
        
        if (matchSearch && matchType && matchLoc) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?php include 'includes/footer.php'; ?>