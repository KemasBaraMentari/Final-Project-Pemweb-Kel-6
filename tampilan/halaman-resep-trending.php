<?php
require_once '../assets/Database/koneksi.php';

// Get the recipe ID from the URL
$recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($recipe_id > 0) {
    // Update the access count
    $update_sql = "UPDATE recipes SET access_count = access_count + 1 WHERE recipe_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $stmt->close();

    // Fetch the recipe details
    $select_sql = "SELECT * FROM recipes WHERE recipe_id = ?";
    $stmt = $conn->prepare($select_sql);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $recipe = $result->fetch_assoc();
    $stmt->close();
} else {
    die("Invalid recipe ID.");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/custom/custom.css">

  <title>Detail Resep</title>
</head>

<body>
    <div class="position-absolute top-0 left-0">
        <a href="halaman-awal.php"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
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
                                        <h1 class="">Detail Resep</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="container py-5">
                                <div class="d-flex justify-content-center">
                                    <!-- Display recipe details here -->
                                    <?php if ($recipe): ?>
                                        <div>
                                            <h2><?php echo htmlspecialchars($recipe['nama_masakan']); ?></h2>
                                            <img src="../assets/foto-makanan/<?php echo htmlspecialchars($recipe['foto_masakan']); ?>" alt="gambar produk" style="object-fit: contain;" class="rounded-lg w-100">
                                            <p><?php echo nl2br(htmlspecialchars($recipe['deskripsi_masakan'])); ?></p>
                                            <!-- Add other details as needed -->
                                        </div>
                                    <?php else: ?>
                                        <p>Resep tidak ditemukan.</p>
                                    <?php endif; ?>
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
    </div>
</body>

</html>
