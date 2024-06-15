<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: halaman-pilihan.php");
    exit();
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

  <title>Daftar resep</title>
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
                    <h1 class="">Pengaturan</h1>
                  </div>
                </div>
              </div>
              <div class="mt-5 p-2 display-6">
                  <a href="halaman-ubah-pass.php" class="text-decoration-none text-dark">Ubah Kata Sandi</a>
              </div>
              <div class="mt-5 p-5 display-6">
                  <a href="halaman-ubah-email.php" class="text-decoration-none text-dark">Ubah Email</a>
              </div>
            </div>
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
