<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: halaman-pilihan.php");
    exit();
}

require_once '../assets/Database/koneksi.php';

// Ambil data resep dari database sesuai user_id
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM recipes WHERE user_id = $user_id";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/custom/custom.css">

  <title>Resepku</title>
</head>

<body>
    <div class="position-absolute top-0 left-0">
      <a href="halaman-awal.php"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
    </div>
    <div class="position-fixed bottom-0 right-0 z-100" style="bottom: 0; right:100px; z-index: 10;">
      <a href="halaman-upload-resep.php"><img src="../assets/vectors/upload-resepku.svg" alt="tombol back"></a>
    </div>
    
  <div class="background">
    <div class="container">
      <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-12">
          <div class="card" style="background-color: #FFC994; border-radius: 70px;">
            <div class="card-body text-center">
              <div class="d-flex justify-content-center">
                <div class="col-md-8 bg-white row align-items-center" style="border-radius: 20px;">
                  <div class="col-2">
                    <img src="../Logo-AromaDapur.png" width="70" alt="">
                  </div>
                  <div class="col-10">
                    <h1 class="">Resepku</h1>
                  </div>
                </div>
              </div>
              <div class="container py-5">
                <div class="d-flex justify-content-center">
                  <div class="col-md-4">
                    <input type="search" name="search" placeholder="Search.." class="search form-control rounded-pill border-0" autocomplete="off">
                  </div>
                </div>
                <?php while($row = $result->fetch_assoc()): ?>
                  <div class="row align-items-center mb-5">
                    <div class="col-md-4">
                      <img src="../assets/foto-makanan/<?php echo $row['foto_masakan']; ?>" alt="gambar produk" style="object-fit: contain;" class="rounded-lg w-100">
                    </div>
                    <div class="col-md-8 text-left">
                      <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                        <h2><?php echo $row['nama_masakan']; ?></h2>
                        <h5><a href="halaman-resep.php?id=<?php echo $row['recipe_id']; ?>">Lihat</a></h5>
                        <form action="hapus-resep.php" method="POST" class="mt-3">
                          <input type="hidden" name="recipe_id" value="<?php echo $row['recipe_id']; ?>">
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Optional JavaScript -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
