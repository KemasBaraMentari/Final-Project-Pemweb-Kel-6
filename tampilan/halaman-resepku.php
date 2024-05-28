<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="resepku.css">

  <title>Resepku</title>
</head>

<body>
  <div class="container mt-5">
    <div class="card p-4">
      <div class="d-flex align-items-center mb-4">
        <div class="back-button mr-3">
          <a href="#" class="text-dark">
            <img src="back-icon.png" alt="Back" class="back-icon">
          </a>
        </div>
        <h1 class="m-0">Resepku</h1>
      </div>
      <div class="recipe-list">
        <div class="recipe-item d-flex align-items-center mb-4">
          <img src="nasi-goreng.jpg" alt="Nasi Goreng" class="recipe-image">
          <div class="recipe-info ml-3">
            <h2 class="m-0">Nasi Goreng</h2>
            <a href="#" class="text-dark">Lihat</a>
          </div>
        </div>
        <div class="recipe-item d-flex align-items-center mb-4">
          <img src="sop-ayam.jpg" alt="Sop Ayam" class="recipe-image">
          <div class="recipe-info ml-3">
            <h2 class="m-0">Sop Ayam</h2>
            <a href="#" class="text-dark">Lihat</a>
          </div>
        </div>
      </div>
      <div class="floating-button">
        <a href="halaman-upload-resep.php" class="btn btn-dark rounded-circle">
          <img src="plus-icon.png" alt="Plus" class="plus-icon">
        </a>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
