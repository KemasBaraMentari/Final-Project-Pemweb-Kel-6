<?php 
// Mulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["login"])) {
  header("Location: halaman-masuk.php");
  exit;
}

require_once 'function.php'; // Sesuaikan dengan jalur file koneksi.php Anda
$categories = query('SELECT * FROM categories');

?>

<?php if (isset($_POST) ) {
  var_dump($_POST);
  // tinggal teruskan buat masukin data ke tabel receipes
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
  <div class="position-fixed bottom-0 right-0 z-100" style="bottom: 0; right:100px; z-index: 10;">
    <button type="button" id="upload" class="btn btn-go my-5 px-5 d-block text-white rounded-pill">Upload</button>
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
              <div class="">
                <form action="" id="form-resep" class="row " method="post" enctype="multipart/form-data">
                  <div class="col-md-6 px-5">
                    <label class="bg-white w-100 cursor-pointer m-4" style="border-radius:10px; cursor: pointer;">
                      <input type="file" name="gambar" id="gambar" class="d-none" accept="image/*">
                      <div class="text-center p-5">
                        <img src="../assets/images/+.png" alt="" id="preview" width="100">
                        <h3 class="pt-5" id="tambah-foto">Tambah Foto</h3>
                      </div>
                    </label>
                    <div class="mb-3 m-4 w-100 mt-3">
                      <textarea name="bahan" id="bahan" rows="4" placeholder="Bahan bahan..." class="form-control rounded p-3" style="height: 200px"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6 px-5 mt-4">
                    <div class="mb-3">
                      <input type="text" name="nama_masakan" class="form-control rounded-pill p-3" id="nama_masakan" placeholder="Judul Masakan">
                    </div>
                    
                    <div class="mb-3">
                      <select name="kategori" id="kategori" class="form-control rounded-pill p-3">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $row) : ?>
                        <option value="<?= $row["id"]; ?>"><?= $row["kategori"]; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
  
                    <div class="mb-3">
                      <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Deskripsi..." class="form-control rounded-3 p-3" style="height: 200px"></textarea>
                    </div>
  
                    <div class="mb-3 mt-5">
                      <textarea name="langkah" id="langkah" rows="4" placeholder="Langkah Pembuatan..." class="form-control rounded p-3" style="height: 200px"></textarea>
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

      <script>
        $(document).ready(function(){
          $('#gambar').change(function(){
            var file = $(this)[0].files[0];
            console.log(file);
            $('#preview').attr('src',  URL.createObjectURL(file));
            $('#tambah-foto').addClass('d-none')
          })

          $('#upload').click(function(){
            $('#form-resep').submit()
          })
        })
      </script>
    </div>
  </div>
</body>

</html>
