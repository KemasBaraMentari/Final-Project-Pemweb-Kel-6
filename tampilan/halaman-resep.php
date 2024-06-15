<?php
// Mulai sesi untuk mengakses data pengguna yang sedang login
session_start();

// Sertakan file koneksi.php untuk terhubung ke database
require_once '../assets/Database/koneksi.php';

// Periksa apakah parameter ID resep telah diberikan di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak, kembali ke halaman awal
    header("Location: halaman-awal.php");
    exit();
}

// Ambil ID resep dari parameter URL
$recipe_id = intval($_GET['id']);

// Perbarui hitungan akses
$update_sql = "UPDATE recipes SET access_count = access_count + 1 WHERE recipe_id = ?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$stmt->close();

// Query untuk mengambil detail resep berdasarkan ID resep
$sql = "SELECT * FROM recipes WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah resep ditemukan
if ($result->num_rows == 0) {
    // Jika tidak ditemukan, kembali ke halaman awal
    header("Location: halaman-awal.php");
    exit();
}

// Ambil data resep dari hasil query
$row = $result->fetch_assoc();
$stmt->close();

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep</title>
    <link rel="stylesheet" href="../css/custom/resep.css">
</head>

<body>
    <div class="position-absolute top-0 left-0">
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
    </div>

    <div class="background">
        <div class="container">
            <section class="content">
                <div class="inner-container">
                    <div class="image-column">
                        <img loading="lazy" src="../assets/foto-makanan/<?php echo htmlspecialchars($row['foto_masakan']); ?>" class="main-image" alt="Main dish image" style="width: 80%" />
                    </div>
                    <div class="info-column">
                        <article class="title-section">
                            <h1 class="title"><?php echo htmlspecialchars($row['nama_masakan']); ?></h1>
                            <p class="description"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                        </article>
                    </div>
                </div>
                <section class="content-section">
                    <div class="content-container">
                        <div class="ingredients-section">
                            <div class="ingredients-title" tabindex="0">
                                Bahan-Bahan :
                                <br />
                                <ul>
                                    <?php
                                    // Bagian ini mengambil bahan-bahan resep dari teks yang disimpan di database
                                    $bahan_list = explode("\n", $row['bahan']);
                                    foreach ($bahan_list as $bahan) {
                                        echo "<li><span class='ingredient'>" . htmlspecialchars($bahan) . "</span></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="steps-section">
                            <div class="steps-title" tabindex="0">
                                Langkah Pembuatan:
                                <br />
                                <ol>
                                    <?php
                                    // Bagian ini mengambil langkah-langkah pembuatan resep dari teks yang disimpan di database
                                    $langkah_list = explode("\n", $row['langkah']);
                                    foreach ($langkah_list as $langkah) {
                                        echo "<li><span class='step'>" . htmlspecialchars($langkah) . "</span></li>";
                                    }
                                    ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </div>
</body>

</html>
