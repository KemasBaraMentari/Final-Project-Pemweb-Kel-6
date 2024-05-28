<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Resep</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #f5f5dc;">
  <div class="container-fluid h-100">
    <a href="halaman-resepku.php" class="btn btn-secondary mb-3">Back</a>
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-lg-6">
        <div class="card p-4" style="background-color: #fff8dc;">
          <h1 class="mb-4">Upload Resep</h1>
          <form>
            <div class="form-group">
              <label for="uploadFoto">Upload Foto Makanan</label>
              <input type="file" class="form-control-file" id="uploadFoto" accept="image/*" onchange="previewImage()">
            </div>
            <div class="form-group">
              <label for="previewFoto"></label>
              <img src="#" alt="Preview Foto Makanan" id="previewFoto" class="img-thumbnail" style="width: 200px; height: 200px;">
            </div>
            <div class="form-group">
              <label for="namaMakanan">Nama Makanan</label>
              <input type="text" class="form-control" id="namaMakanan">
            </div>
            <div class="form-group">
              <label for="kategoriMakanan">Kategori Makanan</label>
              <select class="form-control" id="kategoriMakanan">
                <option value="indonesia">Makanan Indonesia</option>
                <option value="western">Makanan Western</option>
              </select>
            </div>
            <div class="form-group" id="subkategoriMakanan">
              <label for="subKategoriMakanan">Subkategori Makanan</label>
              <select class="form-control" id="subKategoriMakanan">
                <!-- Options will be added dynamically based on the selected category -->
              </select>
            </div>
            <div class="form-group">
              <label for="deskripsiMakanan">Deskripsi Makanan</label>
              <textarea class="form-control" id="deskripsiMakanan" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="bahanMakanan">Bahan-bahan</label>
              <textarea class="form-control" id="bahanMakanan" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label for="langkahPembuatan">Langkah Pembuatan</label>
              <textarea class="form-control" id="langkahPembuatan" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function previewImage() {
      var preview = document.getElementById('previewFoto');
      var file = document.getElementById('uploadFoto').files[0];
      var reader = new FileReader();

      reader.onloadend = function() {
        preview.src = reader.result;
      }

      if (file) {
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
      }
    }

    document.getElementById('kategoriMakanan').addEventListener('change', function() {
      var kategori = this.value;
      var subkategoriDropdown = document.getElementById('subKategoriMakanan');
      subkategoriDropdown.innerHTML = '';
      
      if (kategori === 'indonesia') {
        var subkategoriOptions = ['Jawa Timur', 'Jawa Barat', 'Jawa Tengah', 'Bali'];
        subkategoriOptions.forEach(function(option) {
          var optionElement = document.createElement('option');
          optionElement.textContent = option;
          subkategoriDropdown.appendChild(optionElement);
        });
      } else {
      }
    });
  </script>
</body>
</html>
