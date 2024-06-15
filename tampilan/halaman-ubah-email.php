<?php
session_start();

// Periksa apakah pengguna sudah login
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
    $email_lama = mysqli_real_escape_string($conn, $_POST['email_lama']);
    $email_baru = mysqli_real_escape_string($conn, $_POST['email_baru']);

    // Ambil user_id dari session
    $user_id = $_SESSION['user_id'];

    // Query untuk mengambil email lama dari database
    $query = "SELECT email FROM users WHERE user_id = $user_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email_database = $row['email'];

        // Verifikasi email lama
        if ($email_lama === $email_database) {
            // Update email baru di database
            $update_query = "UPDATE users SET email = '$email_baru' WHERE user_id = $user_id";

            if ($conn->query($update_query) === TRUE) {
                // Redirect ke halaman sukses atau halaman sebelumnya
                header("Location: halaman-pengaturan.php");
                exit();
            } else {
                $pesan_error = "Gagal mengubah email. Silakan coba lagi.";
            }
        } else {
            $pesan_error = "Email lama yang Anda masukkan salah.";
        }
    } else {
        $pesan_error = "User tidak ditemukan.";
    }

    // Tutup koneksi
    $conn->close();
}

// Jika ada pesan kesalahan, akan redirect kembali ke halaman sebelumnya dengan pesan kesalahan
if (!empty($pesan_error)) {
    $_SESSION['pesan_error'] = $pesan_error;
    header("Location: " . $_SERVER['HTTP_REFERER']);
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

    <title>Ubah Email | Aroma Dapur</title>

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
                                <h1 class="text-go text-center">Ubah Email</h1>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="mb-3">
                                    <label for="email_lama" class="form-label">Masukkan Email Lama</label>
                                    <input type="email" name="email_lama" class="form-control rounded-pill" id="email_lama" placeholder="Email lama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email_baru" class="form-label">Masukkan Email Baru</label>
                                    <input type="email" name="email_baru" class="form-control rounded-pill" id="email_baru" placeholder="Email baru" required>
                                </div>
                                <div class="d-flex justify-content-center mb-3 align-self-end mt-5">
                                    <button type="submit" class="btn btn-go d-block w-50 text-white rounded-pill">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-absolute top-0 left-0">
            <a href="halaman-awal.php"><img src="../assets/images/sort_left.png" alt="tombol back"></a>
        </div>

        <!-- Bootstrap JS -->
        <script src="../js/bootstrap.js"></script>
        <script src="../js/popper.min.js"></script>

</body>

</html>
