<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: halaman-pilihan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Resep</title>
  <style>
    .btn-go {
      background-color: #330000 !important;
    }

    .text-go {
      color: #330000;
    }
  </style>

  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/custom/custom.css">
</head>

<body>
  <div class="position-absolute top-0 left-0">
    <a href="halaman-resepku.php"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
  </div>
  
  <div class="background">
    <div class="container">
      <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-12">
          <div class="card" style="background-color: #FFC994; border-radius: 70px;">
            <div class="card-body">
              <div class="text-center">
                <h1>Upload Resep</h1>
              </div>
              <form id="uploadForm" action="../assets/Database/proses-upload-resep.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6 px-5">
                    <label id="fotoLabel" class="bg-white w-100 cursor-pointer m-4" style="border-radius:10px; cursor: pointer;">
                      <input type="file" name="foto_masakan" id="foto_masakan" class="d-none" required>
                      <div class="text-center p-5">
                        <img id="previewFoto" src="../assets/images/+.png" alt="" width="100">
                        <h3 id="fotoText" class="pt-5">Tambah Foto</h3>
                      </div>
                    </label>
                    <div class="mb-3 m-4 w-100 mt-3">
                      <textarea name="bahan" id="bahan" rows="4" placeholder="Bahan bahan..." class="form-control rounded p-3" style="height: 200px" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-6 px-5 mt-4">
                    <div class="mb-3">
                      <input type="text" name="nama_masakan" class="form-control rounded-pill p-3" id="nama_masakan" placeholder="Judul Masakan" required>
                    </div>
                    <div class="mb-3">
                      <select name="kategori" id="kategori" class="form-control rounded-pill p-3" required>
                        <option value="">Pilih Kategori</option>
                        <option value="makanan_western">Makanan Western</option>
                        <option value="makanan_indonesia">Makanan Indonesia</option>
                        <option value="makanan_arab">Makanan Arab</option>
                        <option value="makanan_korea">Makanan Korea</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Deskripsi..." class="form-control rounded-3 p-3" style="height: 200px" required></textarea>
                    </div>
                    <div class="mb-3 mt-5">
                      <textarea name="langkah" id="langkah" rows="4" placeholder="Langkah Pembuatan..." class="form-control rounded p-3" style="height: 200px" required></textarea>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-go my-5 px-5 d-block text-white rounded-pill">Upload</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
      $(document).ready(function() {
        // Preview selected image
        $('#foto_masakan').change(function() {
          readURL(this);
          $('#fotoText').text('Ubah Foto'); // Change text to "Ubah Foto"
        });

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#previewFoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
          }
        }
      });
    </script>
  </div>
</body>

</html>
