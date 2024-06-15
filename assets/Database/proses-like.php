<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../tampilan/halaman-pilihan.php");
    exit();
}

require_once 'koneksi.php'; // Sesuaikan dengan path koneksi Anda

// Memeriksa apakah request adalah POST dan mendapatkan recipe_id
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah recipe_id ada dan valid
    $recipe_id = isset($_POST['recipe_id']) ? intval($_POST['recipe_id']) : 0;
    
    if ($recipe_id > 0) {
        $user_id = $_SESSION['user_id'];
        
        // Query untuk memeriksa apakah pengguna sudah menyukai resep ini sebelumnya
        $check_sql = "SELECT * FROM liked_recipes WHERE user_id = ? AND recipe_id = ?";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bind_param("ii", $user_id, $recipe_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        
        if ($result_check->num_rows > 0) {
            // Pengguna sudah menyukai resep ini sebelumnya, lakukan dislike (hapus dari liked_recipes)
            $delete_sql = "DELETE FROM liked_recipes WHERE user_id = ? AND recipe_id = ?";
            $stmt_delete = $conn->prepare($delete_sql);
            $stmt_delete->bind_param("ii", $user_id, $recipe_id);
            
            if ($stmt_delete->execute()) {
                // Redirect kembali ke halaman resepku setelah dislike berhasil
                if(isset($_SERVER['HTTP_REFERER'])) {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                } else {
                    header("Location: ../../tampilan/halaman-awal.php"); // Redirect ke halaman resepku jika HTTP_REFERER tidak tersedia
                }
                exit();
            } else {
                echo "Error: " . $stmt_delete->error;
            }
            
            $stmt_delete->close();
        } else {
            // Insert ke liked_recipes
            $insert_sql = "INSERT INTO liked_recipes (user_id, recipe_id) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($insert_sql);
            $stmt_insert->bind_param("ii", $user_id, $recipe_id);
            
            if ($stmt_insert->execute()) {
                // Redirect kembali ke halaman resepku setelah like berhasil
                if(isset($_SERVER['HTTP_REFERER'])) {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                } else {
                    header("Location: ../../tampilan/halaman-awal.php"); // Redirect ke halaman resepku jika HTTP_REFERER tidak tersedia
                }
                exit();
            } else {
                echo "Error: " . $stmt_insert->error;
            }
            
            $stmt_insert->close();
        }
        
        $stmt_check->close();
    } else {
        echo "Invalid recipe ID.";
    }
} else {
    echo "Method not allowed.";
}
?>
