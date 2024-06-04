<?php
// Mulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Jika sudah login, ambil nama pengguna dari sesi
    require_once '../assets/database/koneksi.php'; // Sesuaikan dengan jalur file koneksi.php Anda
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT nama FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_pengguna = $row['nama'];
    }
    $stmt->close();
    $conn->close();
} else {
    // Jika belum login, atur nama pengguna menjadi kosong
    $nama_pengguna = "";
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/custom/custom.css">

    <title>Aroma Dapur</title>
</head>

<body>
  <!-- As a heading -->
  <div class="background">
    <nav class="navbar navbar-light " style="background-color: #FFC994 !important;">
      <div class="container-fluid">
        <span data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="cursor-pointer"><img src="../assets/vectors/textalign-left.svg" alt="" width="40px"></span>
        <span class="navbar-brand mb-0 h1"><img src="../Logo-AromaDapur.png" alt="" width="50px">AromaDapur</span>
        <?php if ($nama_pengguna != "") : ?>
                    <!-- Jika pengguna sudah login, tampilkan nama pengguna -->
                    <span class="navbar-brand mb-0 h1"><?php echo $nama_pengguna; ?></span>
                <?php else : ?>
                    <!-- Jika pengguna belum login, tampilkan tombol atau tautan untuk login -->
                    <span class="navbar-brand mb-0 h1"><a href="halaman-pilihan.php" class="text-decoration-none text-dark"><img src="../assets/images/male_user.png" alt="" width="40px">Akun</a></span>
                <?php endif; ?>
      </div>
    </nav>

    <div class="container py-3">
      <div class="d-flex justify-content-center">
        <div class="col-md-4">
          <input type="search" name="search" placeholder="Search.." class="search form-control rounded-pill border-0" autocomplete="off">
        </div>
      </div>

      <div class="row py-5">
        <div class="col-md-6 p-5">
          <div class="card text-white" style="background-image: url('../assets/images/rectangle_105.jpeg'); height: 300px; background-size: cover; border-radius: 50px;">
            <div class="card-body row align-items-end">
              <div class="row justify-content-center col-12">
                <h3 class="text-center">Makanan Western</h3>
                <div class="d-flex justify-content-center">
                  <a href="#" class="btn btn-outline-light rounded-pill px-5 border-4 fw-bold">Lihat</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 p-5">
          <div class="card text-white" style="background-image: url('../assets/images/rectangle_107.jpeg'); height: 300px; background-size: cover; border-radius: 50px;">
            <div class="card-body row align-items-end">
              <div class="row justify-content-center col-12">
                <h3 class="text-center">Makanan Indonesia</h3>
                <div class="d-flex justify-content-center">
                  <a href="masakan-indonesia.php" class="btn btn-outline-light rounded-pill px-5 border-4 fw-bold">Lihat</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 p-5">
          <div class="card text-white" style="background-image: url('../assets/images/rectangle_109.jpeg'); height: 300px; background-size: cover; border-radius: 50px;">
            <div class="card-body row align-items-end">
              <div class="row justify-content-center col-12">
                <h3 class="text-center">Makanan Arab</h3>
                <div class="d-flex justify-content-center">
                  <a href="#" class="btn btn-outline-light rounded-pill px-5 border-4 fw-bold">Lihat</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 p-5">
          <div class="card text-white" style="background-image: url('../assets/images/rectangle_106.jpeg'); height: 300px; background-size: cover; border-radius: 50px;">
            <div class="card-body row align-items-end">
              <div class="row justify-content-center col-12">
                <h3 class="text-center">Makanan Korea</h3>
                <div class="d-flex justify-content-center">
                  <a href="#" class="btn btn-outline-light rounded-pill px-5 border-4 fw-bold">Lihat</a>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>


    <!-- off canvas sidebar -->
    <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #531607">
        <div class="offcanvas-header">
            <span data-bs-dismiss="offcanvas" aria-label="Close" class="cursor-pointer"><img src="../assets/vectors/textalign-left2.svg" alt="" width="40px"></span>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex justify-content-center">
                <img src="../Logo-AromaDapur.png" alt="" width="70px">
            </div>
            <div class="d-flex justify-content-center">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">AromaDapur</h5>
            </div>
            <div class="dropdown mt-3">
                <!-- List pilihan -->
                <a href="halaman-resepku.php" class="text-decoration-none text-light"><img src="../assets/images/cooking_book.png" alt="" height="40px">Resepku</a>
                <br><br>
                <a href="halaman-resep-yang-disukai.php" class="text-decoration-none text-light"><img src="../assets/images/love.png" alt="" height="40px">Resep yang Disukai</a>
                <br><br>
                <a href="halaman-resep-trending.php" class="text-decoration-none text-light"><img src="../assets/images/ratings.png" alt="" height="40px">Resep Trending</a>
                <br><br>
                <a href="halaman-pengaturan.php" class="text-decoration-none text-light"><img src="../assets/images/settings.png" alt="" height="40px">Pengaturan</a>
                <br><br>
                <a href="../assets/Database/logout.php" class="text-decoration-none text-light"><img src="../assets/images/logout.png" alt="" height="40px">Logout</a>
            </div>
        </div>
        <div>

            <!-- Background image kecil bawah -->
            <div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: 150px;">
                <div class="mt-auto p-2 bd-highlight"><img src="../assets/images/dudel_masak_oren_2.png" style="background-size: cover; background-position: center; width: 100%;" alt="">
                </div>
            </div>
            <!-- end off canvas sidebar -->


            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="../js/bootstrap.js"></script>
            <script src="../js/popper.min.js"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </div>
</body>

</html>
