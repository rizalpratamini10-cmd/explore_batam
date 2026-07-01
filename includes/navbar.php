<?php
$current_page = basename($_SERVER['PHP_SELF']);
$categories = getCategories();
?>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-left">
            <span><i class="fas fa-briefcase"></i> Plan a Business Event</span>
            <span><i class="fas fa-store"></i> Daftarkan UMKM Gratis</span>
        </div>
        <div class="top-bar-right">
            <span>🌐 Indonesia | <a href="#">EN</a></span>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="<?php echo base_url(); ?>">
                <h1>explore<span>BATAM</span></h1>
                <p>Wisata • UMKM • Bisnis • Properti</p>
            </a>
        </div>
        <div class="nav-toggle" id="navToggle">
            <i class="fas fa-bars"></i>
        </div>
        <div class="nav-links" id="navLinks">
            <a href="<?php echo base_url(); ?>" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Beranda</a>
            <a href="<?php echo base_url('about-batam.php'); ?>">Tentang Batam</a>
            <a href="<?php echo base_url('tourism.php'); ?>">Wisata</a>
            <a href="<?php echo base_url('umkm.php'); ?>">UMKM</a>
            <a href="<?php echo base_url('services.php'); ?>">Jasa & Bisnis</a>
            <a href="<?php echo base_url('culinary.php'); ?>">Kuliner</a>
            <a href="<?php echo base_url('property.php'); ?>">Properti</a>
            <a href="<?php echo base_url('events.php'); ?>">Event</a>
            <a href="<?php echo base_url('register-umkm.php'); ?>" class="btn-outline">
                <i class="fas fa-plus-circle"></i> Daftar Usaha
            </a>
            <!-- ========== TOMBOL AI DI NAVBAR ========== -->
            <a href="https://ai-anda.com" class="btn-ai" target="_blank">
                <i class="fas fa-robot"></i> AI Batam
            </a>
        </div>
    </div>
</nav>