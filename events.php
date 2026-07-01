<?php
$page_title = 'Event & Pelatihan UMKM Batam';
include 'config.php';
include 'includes/header.php';
include 'includes/navbar.php';

// Ambil data event
$query = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $query);
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="page-header">
    <div class="container">
        <h1>Event & Pelatihan UMKM</h1>
        <p>Ikuti berbagai acara untuk mengembangkan usaha Anda</p>
    </div>
</section>

<div class="container">
    <!-- Event Categories -->
    <div class="event-tabs">
        <a href="#" class="event-tab active" data-filter="all">Semua Event</a>
        <a href="#" class="event-tab" data-filter="upcoming">Akan Datang</a>
        <a href="#" class="event-tab" data-filter="ongoing">Sedang Berlangsung</a>
        <a href="#" class="event-tab" data-filter="ended">Sudah Selesai</a>
    </div>

    <div class="events-grid" id="eventsContainer">
        <?php foreach($events as $event): ?>
            <div class="event-card" data-status="<?php echo $event['status']; ?>">
                <div class="event-date-large">
                    <span class="event-day"><?php echo date('d', strtotime($event['event_date'])); ?></span>
                    <span class="event-month"><?php echo date('M', strtotime($event['event_date'])); ?></span>
                </div>
                <div class="event-content">
                    <h3><?php echo $event['title']; ?></h3>
                    <div class="event-meta">
                        <span><i class="fas fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($event['event_date'])); ?></span>
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo $event['location']; ?></span>
                        <span><i class="fas fa-user"></i> <?php echo $event['organizer']; ?></span>
                    </div>
                    <p><?php echo substr($event['description'], 0, 120); ?>...</p>
                    <div class="event-footer">
                        <?php if($event['is_free']): ?>
                            <span class="event-price free"><i class="fas fa-ticket-alt"></i> Gratis</span>
                        <?php else: ?>
                            <span class="event-price paid"><i class="fas fa-ticket-alt"></i> Rp <?php echo number_format($event['price'], 0, ',', '.'); ?></span>
                        <?php endif; ?>
                        <a href="<?php echo base_url('event-detail.php?id=' . $event['id']); ?>" class="btn-register">Daftar →</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.querySelectorAll('.event-tab').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.event-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        let filter = this.dataset.filter;
        let cards = document.querySelectorAll('.event-card');
        
        cards.forEach(card => {
            if (filter === 'all' || card.dataset.status === filter) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>