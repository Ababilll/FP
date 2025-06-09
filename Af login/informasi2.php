<?php
$conn = new mysqli("localhost", "root", "", "senku_coffee");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil 3 ulasan terbaru
$sql = "
SELECT u.deskripsi, u.rating, u.created_at, usr.username
FROM ulasan u
JOIN users usr ON u.user_id = usr.id_users
ORDER BY u.created_at DESC
LIMIT 3
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="StyleCSS2/informasistyle2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Informasi - Senku Coffee</title>
</head>

<body>
    <div class="header">
        <!-- header -->
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top" style="background-color: burlywood;">
            <div class="container-fluid" style="margin: 0px 50px 0px 50px; padding: 10px;">
                <a href="" style="display: flex; align-items: center;">
                    <img src="../Resource/Senku kafe.png" alt="Logo Senku Coffee" class="navbar-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto me-2 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home2.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menu2.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ulasan2.php">Ulasan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Informasi
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="informasi2.php#about">About Us</a></li>
                                <li><a class="dropdown-item" href="informasi2.php#kontak">Kontak</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-2">
                        <li class="nav-profil-item dropdown dropdown-profil">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../Resource/fotoprofil2.jpg" alt="Profil" class="rounded-circle" width="47" height="47" style="object-fit: cover; margin-right: 10px;">
                                Profil
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profil" aria-labelledby="navbarProfileDropdown">
                                <li><a class="dropdown-item" href="profil.php">Lihat Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../Bf Login/home.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <h2 class="text-center">Tentang Kami</h2>
    <div class="container my-5">
  <div class="row align-items-center">
    <!-- Kolom Gambar (Slider) -->
    <div class="col-md-6">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="../Resource/kafe1.jpg" class="slider-img" alt="Gambar 1">
          </div>
          <div class="swiper-slide">
            <img src="../Resource/kafe2.jpg" class="slider-img" alt="Gambar 2">
          </div>
          <div class="swiper-slide">
            <img src="../Resource/kafe3.jpg" class="slider-img" alt="Gambar 3">
          </div>
          <div class="swiper-slide">
            <img src="../Resource/kafe4.jpg" class="slider-img" alt="Gambar 4">
          </div>
        </div>
        <!-- Navigasi & Pagination (opsional) -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- Kolom Teks -->
    <div class="col-md-6">
      <h3>Tentang Senku Coffee</h3>
      <p>
      Selamat Datang di Senku Coffee
Senku Coffee lahir dari kecintaan kami terhadap kopi berkualitas dan keinginan untuk menciptakan ruang yang nyaman bagi komunitas.

Kami percaya bahwa secangkir kopi yang nikmat dapat mencerahkan hari Anda. Oleh karena itu, kami hanya menggunakan biji kopi pilihan terbaik dan menyajikannya dengan sepenuh hati oleh barista kami yang berpengalaman.

Lebih dari sekadar kedai kopi, Senku Coffee adalah tempat Anda bertemu teman, bekerja, atau sekadar menikmati waktu santai. Datang dan rasakan pengalaman ngopi yang berbeda!
      </p>
    </div>
  </div>
</div>

<hr>

<div class="container my-5">
  <h3 class="text-center mb-4">Ulasan Pengunjung</h3>
  <div class="row g-4">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card p-3 h-100">
            <p class="mb-2">"<?= htmlspecialchars($row['deskripsi']) ?>"</p>
            <p class="mb-1 text-warning">
              <?php
                for ($i = 1; $i <= 5; $i++) {
                  echo $i <= $row['rating'] ? "&#9733;" : "&#9734;";
                }
              ?>
            </p>
            <p class="mb-0 text-muted"><strong>– <?= htmlspecialchars($row['username']) ?></strong></p>
            <small class="text-muted"><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></small>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center">Belum ada ulasan.</p>
    <?php endif; ?>
  </div>

  <!-- Tombol lihat lebih banyak -->
  <div class="text-center mt-4">
    <a href="ulasan2.php" class="btn btn-outline-success">More</a>
  </div>
</div>

<?php $conn->close(); ?>

<hr>

<h2 style="text-align: center;">Need Help? Contact Us</h2>
<div class="map-container">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.179561534431!2d112.78574977500047!3d-7.333721192674741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fab87edcad15%3A0xb26589947991eea1!2sUniversitas%20Pembangunan%20Nasional%20%E2%80%9CVeteran%E2%80%9D%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1749402845552!5m2!1sen!2sid" 
  width="600" 
  height="450" style="border:0;" allowfullscreen="" 
  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

  <!-- Kontak Informasi -->
  <div class="info-section">
    <div class="info-box">
      <div class="icon">📍</div>
      <h4>Address</h4>
      <p>Jl. Mliwis Putih, Bojonegoro, 62355</p>
    </div>
    <div class="info-box">
      <div class="icon">📞</div>
      <h4>Call Us</h4>
      <p>+62 12345678</p>
    </div>
    <div class="info-box">
      <div class="icon">📧</div>
      <h4>Email Us</h4>
      <p>info@senkucoffee.com</p>
    </div>
    <div class="info-box">
      <div class="icon">⏰</div>
      <h4>Jam Buka</h4>
      <p><strong>Setiap hari:</strong> 07.00 – 22.00</p>
    </div>
  </div>

  <h4 style="text-align: center;">Ikuti kami</h4>
  <div style="text-align: center;">
  <a href="informasi2.php">
    <img src="../Resource/X.jpg" alt="" height="35px" width="35px">
  </a>
  <a href="informasi2.php">
    <img src="../Resource/IG.png" alt="" height="35px" width="35px">
  </a>
</div>

<hr>

    <small>
        <p style="text-align: center;">&copy; 2025 Senku Coffee &middot; 
        Jl. Kopi No. 123, Jakarta &middot; 
        <a href="mailto:info@senkucoffee.com" class="text-decoration-none">info@senkucoffee.com</a></p>
    </small>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".mySwiper", {
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    autoplay: {
      delay: 3000,
      disableOnInteraction: false
    }
  });
</script>

</body>

</html>