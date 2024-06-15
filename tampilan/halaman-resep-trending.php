<?php
require_once '../assets/Database/koneksi.php';

// Ambil semua resep berdasarkan jumlah access_count tertinggi
$select_sql = "SELECT * FROM recipes ORDER BY access_count DESC";
$result = $conn->query($select_sql);

// Variabel untuk menentukan urutan
$ranking = 1;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/custom/custom.css">

    <title>Resep Trending</title>
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
                                        <h1 class="">Resep Trending</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="container py-5">
                                <div class="d-flex justify-content-center">
                                    <!-- Display trending recipes here -->
                                    <?php if ($result->num_rows > 0): ?>
                                        <div class="row">
                                            <?php while ($row = $result->fetch_assoc()): ?>
                                                <div class="col-md-4 mb-4">
                                                    <div class="card">
                                                        <img src="../assets/foto-makanan/<?php echo htmlspecialchars($row['foto_masakan']); ?>" class="card-img-top" alt="...">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo htmlspecialchars($row['nama_masakan']); ?></h5>
                                                            <p class="card-text"><?php echo substr(htmlspecialchars($row['deskripsi']), 0, 100); ?>...</p>
                                                            <a href="halaman-resep.php?id=<?php echo $row['recipe_id']; ?>" class="btn btn-primary">Lihat Detail</a>
                                                            <p class="mt-2">Ranking: <?php echo $ranking; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $ranking++; // Increment ranking setiap kali menampilkan resep
                                                ?>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php else: ?>
                                        <p>Tidak ada resep yang ditemukan.</p>
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
