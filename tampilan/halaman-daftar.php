<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <title>Daftar | Aroma Dapur</title>

    <style>
    .btn-go {
      background-color: #330000;
    }

    .text-go {
      color: #330000;
    }
  </style>

  </head>
  
  <body>
  <div class="position-relative" style="background-color: #FFF9D0;">
    <div class="container">
      <div class="row justify-content-center align-items-center" style="min-height: 100vh; ">
        <div class="col-md-6 ">
          <div class="card p-4" style="background-color: #FFC994; border-radius: 100px; height: 80vh;">
            <div class="card-body ">
              <div class="mb-5">
                <h1 class="text-go text-center">Daftar Akun</h1>
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control rounded-pill" id="nama" placeholder="nama lengkap">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control rounded-pill" id="email" placeholder="masukkan email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control rounded-pill" id="password" placeholder="masukkan kata sandi">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Ulangi Kata Sandi</label>
                <input type="password" name="password" class="form-control rounded-pill" id="password" placeholder="masukkan ulang kata sandi">
              </div>
              <div class="d-flex justify-content-center mb-3 align-self-end mt-5">
                <a href="halaman-masuk.php" class="btn btn-go d-block w-50 text-white rounded-pill">Daftar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="position-absolute top-0 left-0">
      <a href="halaman-pilihan.php"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/popper.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>