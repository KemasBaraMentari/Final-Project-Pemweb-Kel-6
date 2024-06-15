<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: halaman-pilihan.php");
    exit();
}

// Include koneksi ke database
require_once '../assets/Database/koneksi.php';

// Inisialisasi variabel pesan kesalahan
$pesan_error = '';

// Proses saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];

    // Ambil user_id dari session
    $user_id = $_SESSION['user_id'];

    // Query untuk mengambil kata sandi lama dari database
    $query = "SELECT password FROM users WHERE user_id = $user_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password_database = $row['password'];

        // Verifikasi kata sandi lama
        if (password_verify($password_lama, $password_database)) {
            // Kata sandi lama benar, hash kata sandi baru
            $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);

            // Update kata sandi baru di database
            $update_query = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";

            if ($conn->query($update_query) === TRUE) {
                // Redirect ke halaman sukses atau halaman sebelumnya
                header("Location: halaman-pengaturan.php");
                exit();
            } else {
                $pesan_error = "Gagal mengubah kata sandi. Silakan coba lagi.";
            }
        } else {
            $pesan_error = "Kata sandi lama yang Anda masukkan salah.";
        }
    } else {
        $pesan_error = "User tidak ditemukan.";
    }

    // Tutup koneksi
    $conn->close();
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

    <title>Ubah Kata Sandi | Aroma Dapur</title>

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
                                <h1 class="text-go text-center">Ubah Kata Sandi</h1>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="mb-3">
                                    <label for="password_lama" class="form-label">Kata Sandi lama</label>
                                    <input type="password" name="password_lama" class="form-control rounded-pill" id="password_lama" placeholder="Masukkan kata sandi lama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_baru" class="form-label">Kata Sandi Baru</label>
                                    <input type="password" name="password_baru" class="form-control rounded-pill" id="password_baru" placeholder="Masukkan kata sandi baru" required>
                                </div>
                                <div class="d-flex justify-content-center mb-3 align-self-end mt-5">
                                    <button type="submit" class="btn btn-go d-block w-50 text-white rounded-pill">Ubah</button>
                                </div>
                                <?php if (!empty($pesan_error)) : ?>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <?php echo $pesan_error; ?>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-absolute top-0 left-0">
            <a href="halaman-awal.php"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
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
