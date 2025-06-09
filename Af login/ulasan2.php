<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "senku_coffee";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query ulasan, misalnya ambil 5 ulasan terbaru
$sql = "SELECT u.deskripsi, u.rating, usr.username
FROM ulasan u
JOIN users usr ON u.user_id = usr.id_users
ORDER BY u.created_at DESC
LIMIT 5";
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
    <link rel="stylesheet" href="StyleCSS2/ulasanstyle2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Ulasan - Senku Coffee</title>
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
                            <a class="nav-link active" href="ulasan2.php">Ulasan</a>
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

    <h2 style="text-align: center;">Ulasan Populer</h2>
<section class="Testimoni">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php
      $result = $conn->query($sql);
      if (!$result) {
          die("Query error: " . $conn->error);
      }
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              // Escape output untuk keamanan
              $deskripsi = htmlspecialchars($row['deskripsi']);
              $username = htmlspecialchars($row['username']);
              $rating = isset($row['rating']) ? (int)$row['rating'] : 0;

              echo '<div class="swiper-slide">';
              echo '  <div class="card">';
              echo '    <p class="testimoni-text">"' . $deskripsi . '"</p>';
              echo '    <p class="testimoni-text">- ' . $username . '</p>';
              echo '    <div class="star-display">';
              for ($i = 1; $i <= 5; $i++) {
                  $filled = $i <= $rating ? 'filled' : '';
                  echo '<span class="star ' . $filled . '">&#9733;</span>';
              }
              echo '    </div>';
              echo '  </div>';
              echo '</div>';
          }
      } else {
          echo '<div class="swiper-slide"><div class="card"><p class="testimoni-text">Belum ada ulasan.</p></div></div>';
      }
      ?>
    </div>
  </div>
</section>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
  </div>
</section>

<?php $conn->close(); ?>


<hr>
    
    <h3 style="text-align: center;">Berikan Ulasan Anda</h3>
<div class="form">
<form action="simpan_ulasan.php" method="POST">
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="ulasan" class="form-label">Ulasan Anda</label>
                <textarea class="form-control" name="ulasan" rows="3"></textarea>
            </div>
    <div class="mb-3">
        <label class="form-label d-block">Rating:</label>
            <div class="star-rating">
                <input type="radio" id="bintang5" name="rating" value="5" checked><label for="bintang5">&#9733;</label>
                <input type="radio" id="bintang4" name="rating" value="4"><label for="bintang4">&#9733;</label>
                <input type="radio" id="bintang3" name="rating" value="3"><label for="bintang3">&#9733;</label>
                <input type="radio" id="bintang2" name="rating" value="2"><label for="bintang2">&#9733;</label>
                <input type="radio" id="bintang1" name="rating" value="1"><label for="bintang1">&#9733;</label>
            </div>
    </div>
    <button type="submit" style="margin: auto;" class="btn btn-success">Kirim</button>
        </div>
    </div>
    </form>
</div>

<hr>

    <small>
        <p style="text-align: center;">&copy; 2025 Senku Coffee &middot; 
        Jl. Kopi No. 123, Jakarta &middot;
        <a href="mailto:info@senkucoffee.com" class="text-decoration-none">info@senkucoffee.com</a> </p>
    </small>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".mySwiper", {
    loop: true,
    spaceBetween: 30,
    slidesPerView: 1, // default HP
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    autoplay: {
      delay: 4000,
      disableOnInteraction: false
    },
    breakpoints: {
      768: {
        slidesPerView: 2
      },
      1024: {
        slidesPerView: 3
      }
    }
  });
</script>

</body>

</html>