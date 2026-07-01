<?php
$page_title = 'Daftarkan UMKM';
include 'includes/config.php';
include 'includes/header.php';
include 'includes/navbar.php';

$success = false;
$error = '';

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $category_id = (int)$_POST['category_id'];
    $description = mysqli_real_escape_string($conn, trim($_POST['description']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));
    $district = mysqli_real_escape_string($conn, trim($_POST['district']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $website_url = mysqli_real_escape_string($conn, trim($_POST['website_url']));
    $open_hours = mysqli_real_escape_string($conn, trim($_POST['open_hours']));
    
    // Handle file upload
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['photo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_filename = time() . '_' . uniqid() . '.' . $ext;
            $upload_path = 'uploads/umkm/' . $new_filename;
            
            // Create directory if not exists
            if (!file_exists('uploads/umkm')) {
                mkdir('uploads/umkm', 0777, true);
            }
            
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                $photo = $new_filename;
            }
        }
    }
    
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    
    $query = "INSERT INTO businesses (name, slug, category_id, description, address, district, phone, website_url, open_hours, photo, status) 
              VALUES ('$name', '$slug', $category_id, '$description', '$address', '$district', '$phone', '$website_url', '$open_hours', '$photo', 'pending')";
    
    if (mysqli_query($conn, $query)) {
        $success = true;
    } else {
        $error = "Gagal mendaftar: " . mysqli_error($conn);
    }
}

$categories = getCategories();
?>

<!-- HTML form nya sama seperti sebelumnya (tidak berubah) -->
<section class="page-header">
    <div class="container">
        <h1>Daftarkan UMKM Anda</h1>
        <p>Gratis! Promosikan usaha Anda ke ribuan pengunjung</p>
    </div>
</section>

<div class="container">
    <?php if($success): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <h3>Pendaftaran Berhasil!</h3>
            <p>Data UMKM Anda telah kami terima. Akan diverifikasi dalam 1x24 jam.</p>
            <a href="<?php echo base_url(); ?>" class="btn-primary">Kembali ke Beranda</a>
        </div>
    <?php else: ?>
        <?php if($error): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <p><?php echo $error; ?></p>
            </div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data" class="register-form" id="registerForm">
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nama Usaha / UMKM <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required placeholder="Contoh: Keripik Mak Nah Batam">
                </div>
                
                <div class="form-group">
                    <label for="category_id">Kategori Usaha <span class="required">*</span></label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group full-width">
                    <label for="description">Deskripsi Usaha <span class="required">*</span></label>
                    <textarea id="description" name="description" rows="4" required placeholder="Jelaskan produk/jasa yang ditawarkan, keunggulan, dll."></textarea>
                </div>
                
                <div class="form-group full-width">
                    <label for="address">Alamat Lengkap <span class="required">*</span></label>
                    <textarea id="address" name="address" rows="2" required placeholder="Jalan, RT/RW, Kelurahan"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="district">Kecamatan <span class="required">*</span></label>
                    <select id="district" name="district" required>
                        <option value="">Pilih Kecamatan</option>
                        <option value="Batu Aji">Batu Aji</option>
                        <option value="Batam Center">Batam Center</option>
                        <option value="Bengkong">Bengkong</option>
                        <option value="Nagoya">Nagoya</option>
                        <option value="Sekupang">Sekupang</option>
                        <option value="Sagulung">Sagulung</option>
                        <option value="Lubuk Baja">Lubuk Baja</option>
                        <option value="Nongsa">Nongsa</option>
                        <option value="Galang">Galang</option>
                        <option value="Bulang">Bulang</option>
                        <option value="Belakang Padang">Belakang Padang</option>
                        <option value="Batu Ampar">Batu Ampar</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="phone">Nomor WhatsApp <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" required placeholder="Contoh: 628123456789">
                </div>
                
                <!-- FIELD WEBSITE -->
                <div class="form-group">
                    <label for="website_url">Link Website / Media Sosial <span class="optional">(Opsional)</span></label>
                    <input type="url" id="website_url" name="website_url" placeholder="Contoh: https://www.instagram.com/keripikmaknah/ atau https://keripikmaknah.id">
                    <small>Instagram, Facebook, TikTok, atau website resmi UMKM</small>
                </div>
                
                <div class="form-group">
                    <label for="open_hours">Jam Operasional</label>
                    <input type="text" id="open_hours" name="open_hours" placeholder="Contoh: 08.00 - 21.00 WIB">
                </div>
                
                <div class="form-group">
                    <label for="photo">Foto Usaha</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                    <small>Format JPG, PNG, WEBP. Maks 2MB.</small>
                </div>
            </div>
            
            <div class="form-submit">
                <button type="submit" class="btn-primary btn-large">
                    <i class="fas fa-paper-plane"></i> Daftarkan UMKM
                </button>
                <p class="form-note">* Data akan diverifikasi oleh admin sebelum ditampilkan</p>
            </div>
        </form>
    <?php endif; ?>
</div>

<style>
/* Style sama seperti sebelumnya */
.register-form {
    background: white;
    padding: 30px;
    border-radius: 24px;
    margin: 40px 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
}
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}
.form-group.full-width {
    grid-column: span 2;
}
.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #1e2a3e;
}
.form-group .required {
    color: #e74c3c;
}
.form-group .optional {
    color: #7f8c8d;
    font-weight: normal;
    font-size: 12px;
}
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.3s;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #1e7b64;
    outline: none;
    box-shadow: 0 0 0 3px rgba(30,123,100,0.1);
}
.form-group small {
    display: block;
    font-size: 11px;
    color: #7f8c8d;
    margin-top: 4px;
}
.form-submit {
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
}
.btn-large {
    padding: 14px 40px;
    font-size: 16px;
}
.form-note {
    font-size: 12px;
    color: #7f8c8d;
    margin-top: 12px;
}
.alert {
    padding: 30px;
    border-radius: 24px;
    text-align: center;
    margin: 40px 0;
}
.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
.alert i {
    font-size: 48px;
    margin-bottom: 16px;
}
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .form-group.full-width {
        grid-column: span 1;
    }
    .register-form {
        padding: 20px;
    }
}
</style>

<?php include 'includes/footer.php'; ?>