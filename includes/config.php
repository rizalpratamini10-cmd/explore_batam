<?php
// config.php - Koneksi database dan pengaturan umum

session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'explore_batam');

// Website configuration
define('SITE_NAME', 'Explore Batam');
define('SITE_URL', 'http://localhost/explore-batam/');
define('ASSETS_URL', SITE_URL . 'assets/');
define('UPLOADS_URL', SITE_URL . 'uploads/');

// Koneksi database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($conn, "utf8mb4");

// Fungsi helper
function base_url($path = '') {
    return SITE_URL . ltrim($path, '/');
}

function asset_url($path = '') {
    return ASSETS_URL . ltrim($path, '/');
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
}

function redirect($url) {
    header("Location: " . base_url($url));
    exit();
}

function escape($string) {
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}

function getCategories() {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM categories ORDER BY name");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getFeaturedBusinesses($limit = 6) {
    global $conn;
    $query = "SELECT * FROM businesses WHERE status = 'active' AND is_featured = 1 ORDER BY views DESC LIMIT $limit";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getUpcomingEvents($limit = 3) {
    global $conn;
    $query = "SELECT * FROM events WHERE status = 'upcoming' AND event_date >= CURDATE() ORDER BY event_date ASC LIMIT $limit";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>