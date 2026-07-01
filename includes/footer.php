<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4>Explore Batam</h4>
                <a href="<?php echo base_url('about-batam.php'); ?>">Tentang Kami</a>
                <a href="<?php echo base_url('register-umkm.php'); ?>">Daftarkan Usaha/UMKM</a>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
            </div>
            <div>
                <h4>Jelajahi Kategori</h4>
                <a href="<?php echo base_url('tourism.php'); ?>">Wisata & Liburan</a>
                <a href="<?php echo base_url('umkm.php'); ?>">UMKM & Produk Lokal</a>
                <a href="<?php echo base_url('services.php'); ?>">Jasa & Servis</a>
                <a href="<?php echo base_url('culinary.php'); ?>">Kuliner Batam</a>
                <a href="<?php echo base_url('property.php'); ?>">Properti & Sewa</a>
            </div>
            <div>
                <h4>Bantuan</h4>
                <a href="<?php echo base_url('register-umkm.php'); ?>">Cara Daftar UMKM</a>
                <a href="#">Iklankan Usahamu</a>
                <a href="#">Pusat Media</a>
                <a href="<?php echo base_url('contact.php'); ?>">Hubungi Kami</a>
            </div>
            <div>
                <h4>Ikuti Kami</h4>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-facebook"></i> Facebook BatamHub</a>
                <a href="#"><i class="fab fa-youtube"></i> Virtual Tour Batam</a>
                <a href="#"><i class="fab fa-tiktok"></i> TikTok UMKM Batam</a>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Explore Batam – Situs resmi promosi wisata, UMKM, dan seluruh potensi usaha di Batam.</p>
            <p class="cookie-info">Situs ini menggunakan cookie. <a href="#">Pelajari lebih lanjut</a></p>
        </div>
    </div>
</footer>

<!-- ========== FLOATING AI BUTTON ========== -->
<a href="https://ai-anda.com" class="floating-ai" target="_blank">
    <i class="fas fa-robot"></i>
    <span>AI Assistant Batam</span>
</a>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="<?php echo asset_url('js/main.js'); ?>"></script>
<script src="<?php echo asset_url('js/filter.js'); ?>"></script>

<style>
.floating-ai {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: linear-gradient(135deg, #6b5b95, #8b6baf);
    color: white;
    padding: 14px 22px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    font-weight: 700;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    z-index: 1000;
    transition: 0.3s;
}
.floating-ai:hover {
    transform: scale(1.05);
    background: linear-gradient(135deg, #5a4a80, #7a5a9f);
    color: white;
}
.floating-ai i {
    font-size: 24px;
}
@media (max-width: 600px) {
    .floating-ai span { display: none; }
    .floating-ai { padding: 14px; border-radius: 50%; }
}
</style>

</body>
</html>