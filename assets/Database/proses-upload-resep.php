<?php
session_start();
require_once('koneksi.php'); // Memanggil file koneksi database

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../tampilan/halaman-pilihan.php");
    exit();
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $user_id = $_SESSION['user_id'];
    $nama_masakan = $_POST['nama_masakan'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $bahan = $_POST['bahan'];
    $langkah = $_POST['langkah'];

    // Proses upload file foto makanan
    $target_dir = "../foto-makanan/";
    $target_file = $target_dir . basename($_FILES["foto_masakan"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi dan pemeriksaan file
    $check = getimagesize($_FILES["foto_masakan"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["foto_masakan"]["size"] > 5000000) { // Ubah ukuran file sesuai kebutuhan
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Memeriksa apakah file sudah ada
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Mengizinkan hanya beberapa format file tertentu
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Jika semua validasi lolos, coba upload file
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["foto_masakan"]["tmp_name"], $target_file)) {
            // File berhasil diupload, simpan data ke database
            $foto_masakan = basename($_FILES["foto_masakan"]["name"]);

            // Query untuk menyimpan data ke database
            $sql = "INSERT INTO recipes (user_id, nama_masakan, foto_masakan, kategori, deskripsi, bahan, langkah) 
                    VALUES ('$user_id', '$nama_masakan', '$foto_masakan', '$kategori', '$deskripsi', '$bahan', '$langkah')";

            if ($conn->query($sql) === TRUE) {
                // Redirect pengguna ke halaman resep setelah upload berhasil
                header("Location: ../../tampilan/halaman-resepku.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
