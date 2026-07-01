<?php
$page_title = 'Beranda';
include 'config.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Ambil data untuk ditampilkan di halaman utama
$featured_businesses = getFeaturedBusinesses(6);
$upcoming_events = getUpcomingEvents(3);
$categories = getCategories();

// Fungsi tambahan untuk mendapatkan nama kategori
function getCategoryName($category_id) {
    global $conn;
    $query = "SELECT name FROM categories WHERE id = $category_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row ? $row['name'] : 'UMKM';
}

// Ambil total UMKM
$total_umkm_query = "SELECT COUNT(*) as total FROM businesses WHERE status = 'active'";
$total_umkm_result = mysqli_query($conn, $total_umkm_query);
$total_umkm = mysqli_fetch_assoc($total_umkm_result)['total'];

// Ambil total wisata
$total_wisata_query = "SELECT COUNT(*) as total FROM businesses WHERE category_id = 1 AND status = 'active'";
$total_wisata_result = mysqli_query($conn, $total_wisata_query);
$total_wisata = mysqli_fetch_assoc($total_wisata_result)['total'];

// Ambil total kecamatan
$districts = ['Batu Aji', 'Batam Center', 'Bengkong', 'Nagoya', 'Sekupang', 'Sagulung', 'Lubuk Baja', 'Nongsa', 'Galang'];
$total_kecamatan = count($districts);
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h2>Satu Portal untuk Semesta Batam</h2>
            <p>Temukan wisata, ribuan UMKM, bisnis, properti, dan seluruh potensi Batam.<br>Promosikan usaha Anda dan jelajahi kekayaan wilayah ini.</p>
            <div class="hero-buttons">
                <a href="<?php echo base_url('umkm.php'); ?>" class="btn-primary">
                    <i class="fas fa-compass"></i> Jelajahi Semua Kategori
                </a>
                <a href="#" class="btn-secondary" id="playVideoBtn">
                    <i class="fas fa-play-circle"></i> Tonton Video 360° Batam
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Profile Batam Section -->
<section class="profile-batam">
    <div class="container">
        <div class="profile-wrapper">
            <div class="profile-text">
                <span class="badge">Tentang Batam</span>
                <h2>Pintu Gerbang Ekonomi & Budaya Kepulauan Riau</h2>
                <p>Batam adalah kota industri, perdagangan, dan pariwisata terbesar di Kepulauan Riau. Dengan letak strategis berbatasan langsung dengan Singapura dan Malaysia, Batam tumbuh menjadi pusat ekonomi yang dinamis sekaligus menyimpan kekayaan budaya Melayu yang autentik. Dari wisata alam hingga pusat UMKM yang berkembang pesat, Batam adalah destinasi lengkap untuk berwisata dan berbisnis.</p>
                <div class="profile-stats">
                    <div class="stat">
                        <span class="stat-number">1,2 Juta+</span>
                        <span class="stat-label">Penduduk</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number"><?php echo number_format($total_umkm); ?>+</span>
                        <span class="stat-label">UMKM & Usaha</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number"><?php echo $total_kecamatan; ?></span>
                        <span class="stat-label">Kecamatan</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">45 Menit</span>
                        <span class="stat-label">Ke Singapura</span>
                    </div>
                </div>
                <div class="profile-tags">
                    <span><i class="fas fa-ship"></i> Kawasan Perdagangan Bebas</span>
                    <span><i class="fas fa-globe"></i> FTZ Batam</span>
                    <span><i class="fas fa-mosque"></i> Budaya Melayu</span>
                    <span><i class="fas fa-chart-line"></i> Pusat Industri & Manufaktur</span>
                    <span><i class="fas fa-umbrella-beach"></i> <?php echo $total_wisata; ?>+ Destinasi Wisata</span>
                </div>
            </div>
            <div class="profile-image">
                <img src="https://images.pexels.com/photos/2387873/pexels-photo-2387873.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Jembatan Barelang Batam">
                <div class="image-caption">Ikon Batam: Jembatan Barelang</div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Grid (6 Tombol Utama) -->
<div class="container">
    <div class="section-title">Jelajahi <span>Seluruh Batam</span></div>
    <div class="section-sub">Dari wisata alam hingga pusat oleh-oleh, jasa terbaik dan UMKM unggulan</div>
    
    <div class="categories-grid">
        <a href="<?php echo base_url('tourism.php'); ?>" class="cat-card">
            <i class="fas fa-umbrella-beach"></i>
            <h3>Wisata & Rekreasi</h3>
            <p>Pantai Melur, Barelang, Ocarina</p>
        </a>
        <a href="<?php echo base_url('umkm.php'); ?>" class="cat-card">
            <i class="fas fa-store"></i>
            <h3>UMKM & Produk</h3>
            <p>Oleh-oleh, fesyen, kerajinan</p>
        </a>
        <a href="<?php echo base_url('services.php'); ?>" class="cat-card">
            <i class="fas fa-tools"></i>
            <h3>Jasa & Servis</h3>
            <p>Bengkel, laundry, salon, rental</p>
        </a>
        <a href="<?php echo base_url('culinary.php'); ?>" class="cat-card">
            <i class="fas fa-utensils"></i>
            <h3>Kuliner Nusantara</h3>
            <p>Seafood, mie, kopi kekinian</p>
        </a>
        <a href="<?php echo base_url('property.php'); ?>" class="cat-card">
            <i class="fas fa-building"></i>
            <h3>Properti & Sewa</h3>
            <p>Kost, ruko, apartemen, tanah</p>
        </a>
        <a href="<?php echo base_url('events.php'); ?>" class="cat-card">
            <i class="fas fa-chalkboard-user"></i>
            <h3>Event & Pelatihan</h3>
            <p>Bazar, workshop, pameran</p>
        </a>
    </div>

    <!-- Featured UMKM Section -->
    <div class="section-title"><i class="fas fa-star-of-life"></i> UMKM & Usaha Pilihan</div>
    <div class="section-sub">Beragam usaha lokal Batam, dari skala rumahan hingga bisnis ternama</div>
    
    <div class="featured-grid" id="featuredGrid">
        <?php if(!empty($featured_businesses)): ?>
            <?php foreach($featured_businesses as $business): ?>
                <div class="business-card">
                    <div class="card-img" style="background-image: url('<?php echo UPLOADS_URL . 'umkm/' . $business['photo']; ?>');">
                        <?php if($business['is_featured']): ?>
                            <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <div class="card-category"><?php echo getCategoryName($business['category_id']); ?></div>
                        <h3 class="card-title"><?php echo htmlspecialchars($business['name']); ?></h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($business['district']); ?>, Batam
                        </div>
                        <p class="card-desc"><?php echo substr(htmlspecialchars($business['description']), 0, 100); ?>...</p>
                        <div class="card-tags">
                            <?php 
                            $tags = explode(',', $business['tags'] ?? '');
                            foreach(array_slice($tags, 0, 2) as $tag): 
                                if(trim($tag)):
                            ?>
                                <span class="tag"><?php echo htmlspecialchars(trim($tag)); ?></span>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </div>
                        <a href="<?php echo base_url('umkm-detail.php?id=' . $business['id']); ?>" class="btn-detail">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state" style="grid-column: span 3;">
                <i class="fas fa-store"></i>
                <h3>Belum Ada UMKM Unggulan</h3>
                <p>Silakan daftarkan UMKM Anda atau tambahkan data melalui admin panel.</p>
                <a href="<?php echo base_url('register-umkm.php'); ?>" class="btn-primary">Daftarkan UMKM</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Map Preview Section -->
    <div class="map-preview">
        <div class="map-text">
            <h3><i class="fas fa-map-marked-alt"></i> Peta Interaktif Usaha Batam</h3>
            <p>Temukan ribuan UMKM, bengkel, cafe, toko, dan jasa terdekat dari lokasi Anda.</p>
            <a href="<?php echo base_url('business-map.php'); ?>" class="map-link">
                Lihat peta lengkap <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div id="previewMap" class="map-placeholder" style="height: 220px; background: #b9cdc4; border-radius: 24px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <i class="fas fa-map-pin" style="font-size: 32px; color: #1e7b64;"></i>
            <p style="margin-top: 10px;"><strong>📍 <?php echo number_format($total_umkm); ?>+ Titik Usaha</strong></p>
            <p style="font-size: 12px;">Bengkong • Batam Center • Sekupang • Nagoya • Batu Aji</p>
        </div>
    </div>

    <!-- Events Section -->
    <div class="section-title"><i class="fas fa-calendar-alt"></i> Event & Pelatihan UMKM Batam</div>
    <div class="section-sub">Ikuti berbagai acara untuk mengembangkan usaha Anda</div>
    
    <div class="event-grid">
        <?php if(!empty($upcoming_events)): ?>
            <?php foreach($upcoming_events as $event): ?>
                <div class="event-card">
                    <div class="event-date">
                        <span class="day"><?php echo date('d', strtotime($event['event_date'])); ?></span>
                        <span class="month"><?php echo date('M', strtotime($event['event_date'])); ?></span>
                    </div>
                    <div class="event-content">
                        <div class="event-cat"><?php echo htmlspecialchars($event['organizer']); ?></div>
                        <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                        <div class="event-loc">
                            <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?>
                        </div>
                        <p><?php echo substr(htmlspecialchars($event['description']), 0, 80); ?>...</p>
                        <?php if($event['is_free']): ?>
                            <span class="tag" style="background: #d4edda; color: #155724;"><i class="fas fa-ticket-alt"></i> Gratis</span>
                        <?php else: ?>
                            <span class="tag" style="background: #f8d7da; color: #721c24;"><i class="fas fa-ticket-alt"></i> Rp <?php echo number_format($event['price'], 0, ',', '.'); ?></span>
                        <?php endif; ?>
                        <a href="<?php echo base_url('event-detail.php?id=' . $event['id']); ?>" class="btn-event">Daftar Sekarang →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state" style="grid-column: span 3;">
                <i class="fas fa-calendar-times"></i>
                <h3>Belum Ada Event Terbaru</h3>
                <p>Pantau terus website kami untuk informasi event dan pelatihan UMKM.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- CTA Banner untuk Daftar UMKM -->
    <div class="cta-banner">
        <div class="cta-content">
            <i class="fas fa-store"></i>
            <h3>Punya Usaha di Batam?</h3>
            <p>Daftarkan UMKM Anda secara GRATIS dan jangkau ribuan pelanggan potensial</p>
            <a href="<?php echo base_url('register-umkm.php'); ?>" class="btn-primary btn-large">
                <i class="fas fa-plus-circle"></i> Daftar Sekarang
            </a>
        </div>
    </div>
</div>

<!-- Tombol AI SUDAH ADA di navbar.php dan footer.php -->
<!-- 
    ================================================
    TOMBOL AI SUDAH ADA DI:
    1. navbar.php (di samping tombol Daftar Usaha)
    2. footer.php (floating button di pojok kanan bawah)
    ================================================
-->

<style>
/* Additional styles for CTA Banner */
.cta-banner {
    background: linear-gradient(135deg, #0b2b26, #1e7b64);
    border-radius: 32px;
    margin: 60px 0 40px;
    padding: 50px 30px;
    text-align: center;
    color: white;
}

.cta-content i {
    font-size: 48px;
    margin-bottom: 16px;
}

.cta-content h3 {
    font-size: 28px;
    margin-bottom: 12px;
}

.cta-content p {
    font-size: 16px;
    margin-bottom: 24px;
    opacity: 0.9;
}

.btn-large {
    padding: 14px 32px;
    font-size: 16px;
}

.map-placeholder {
    cursor: pointer;
    transition: 0.3s;
}

.map-placeholder:hover {
    transform: scale(1.01);
    background: #a8c0b6 !important;
}

/* Badge dan tag tambahan */
.featured-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #ffb347;
    color: #1e2a3e;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.card-img {
    position: relative;
}

.event-card {
    display: flex;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.event-date {
    background: #1e7b64;
    color: white;
    padding: 16px 12px;
    text-align: center;
    min-width: 70px;
}

.event-date .day {
    font-size: 28px;
    font-weight: 800;
    display: block;
}

.event-date .month {
    font-size: 12px;
    text-transform: uppercase;
}

.event-content {
    padding: 16px;
    flex: 1;
}

.event-cat {
    font-size: 11px;
    color: #1e7b64;
    font-weight: 600;
    text-transform: uppercase;
}

.event-content h4 {
    font-size: 18px;
    margin: 8px 0;
}

.event-loc {
    font-size: 12px;
    color: #5b6e8c;
    margin-bottom: 8px;
}

.btn-event {
    display: inline-block;
    margin-top: 12px;
    background: #1e7b64;
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
}

.card-location {
    font-size: 13px;
    color: #5b6e8c;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.card-category {
    display: inline-block;
    background: #eef2f6;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #1e7b64;
    margin-bottom: 12px;
}

.btn-detail {
    color: #1e7b64;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: 0.2s;
    display: inline-block;
    margin-top: 12px;
}

.btn-detail:hover {
    color: #0b5e4a;
    margin-left: 5px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: #f8fafc;
    border-radius: 24px;
    margin: 40px 0;
}

.empty-state i {
    font-size: 64px;
    color: #cbd5e1;
    margin-bottom: 20px;
}
</style>

<script>
// Simple preview map click handler
document.getElementById('previewMap')?.addEventListener('click', function() {
    window.location.href = '<?php echo base_url('business-map.php'); ?>';
});

// Video 360 button handler
document.getElementById('playVideoBtn')?.addEventListener('click', function(e) {
    e.preventDefault();
    alert('Video 360° Batam akan segera tersedia. Stay tuned!');
});

// Animate numbers on scroll
function animateNumbers() {
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const value = stat.innerText;
        if (!stat.hasAttribute('data-animated') && !isNaN(parseInt(value))) {
            stat.setAttribute('data-animated', 'true');
            let start = 0;
            const end = parseInt(value.replace(/[^0-9]/g, ''));
            const duration = 1000;
            const increment = end / (duration / 16);
            
            function updateNumber() {
                start += increment;
                if (start < end) {
                    stat.innerText = Math.floor(start).toLocaleString() + (value.includes('+') ? '+' : '');
                    requestAnimationFrame(updateNumber);
                } else {
                    stat.innerText = end.toLocaleString() + (value.includes('+') ? '+' : '');
                }
            }
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateNumber();
                        observer.unobserve(entry.target);
                    }
                });
            });
            observer.observe(stat);
        }
    });
}

// Run animation when page loads
document.addEventListener('DOMContentLoaded', animateNumbers);
</script>

<?php include 'includes/footer.php'; ?>