<?php
require_once '../assets/Database/koneksi.php';

// Query untuk mengambil semua masakan dengan kategori 'Korea'
$sql = "SELECT * FROM recipes WHERE kategori = 'makanan_indonesia'";
$result = $conn->query($sql);
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

  <title>Masakan Indonesia</title>
</head>

<body>
  <div class="position-absolute top-0 left-0">
    <a href="halaman-awal.php"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
  </div>


  <div class="background">
    <div class="container">
      <div class="row justify-content-center align-items-center" style="min-height: 100vh; ">
        <div class="col-md-12">
          <div class="card" style="background-color: #FFC994; border-radius: 70px; ">
            <div class="card-body text-center">
              <div class="d-flex justify-content-center">
                <div class="col-md-8 bg-white row align-items-center" style="border-radius: 20px;">
                  <div class="col-2">
                    <img src="../Logo-AromaDapur.png" width="70" alt="">
                  </div>
                  <div class="col-10">
                    <h1 class="">Masakan Indonesia</h1>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-center my-5">
                <div class="col-md-4">
                  <input type="search" name="search" placeholder="Search.." class="search form-control rounded-pill border-0 bg-white" autocomplete="off">
                </div>
              </div>
              <div class="container py-5">
                <?php while($row = $result->fetch_assoc()): ?>
                  <div class="row align-items-center mb-5">
                    <div class="col-md-4">
                      <img src="../assets/foto-makanan/<?php echo $row['foto_masakan']; ?>" alt="gambar produk" style="object-fit: contain;" class="rounded-lg w-100">
                    </div>
                    <div class="col-md-8 text-left">
                      <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                        <h2><?php echo $row['nama_masakan']; ?></h2>
                        <h5><a href="halaman-resep.php?id=<?php echo $row['recipe_id']; ?>">Lihat</a></h5>
                        <?php
                          // Memeriksa apakah pengguna sudah login
                          if (isset($_SESSION['user_id'])) {
                            // Query untuk memeriksa apakah resep ini sudah disukai oleh pengguna
                            $check_like_sql = "SELECT * FROM liked_recipes WHERE user_id = ? AND recipe_id = ?";
                            $stmt_check_like = $conn->prepare($check_like_sql);
                            $stmt_check_like->bind_param("ii", $_SESSION['user_id'], $row['recipe_id']);
                            $stmt_check_like->execute();
                            $result_like = $stmt_check_like->get_result();

                            if ($result_like->num_rows > 0) {
                            // Jika sudah disukai, tampilkan tombol Dislike
                              echo '<form action="../assets/Database/proses-like.php" method="post">
                                    <input type="hidden" name="recipe_id" value="' . $row['recipe_id'] . '">
                                    <button type="submit" class="btn btn-danger">Dislike</button>
                                    </form>';
                            } else {
                            // Jika belum disukai, tampilkan tombol Like
                                echo '<form action="../assets/Database/proses-like.php" method="post">
                                      <input type="hidden" name="recipe_id" value="' . $row['recipe_id'] . '">
                                      <button type="submit" class="btn btn-primary">Like</button>
                                      </form>';
                            }
                          } else {
                            // Jika pengguna belum login, arahkan ke halaman login
                            echo '<a href="halaman-pilihan.php" class="btn btn-primary">Login untuk Like</a>';
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
                

      <!-- Optional JavaScript -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
