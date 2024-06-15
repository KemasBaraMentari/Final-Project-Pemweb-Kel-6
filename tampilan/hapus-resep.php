<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: halaman-pilihan.php");
    exit();
}

require_once '../assets/Database/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recipe_id'])) {
    $recipe_id = $_POST['recipe_id'];
    $user_id = $_SESSION['user_id'];

    // Ambil nama file gambar dari database
    $stmt = $conn->prepare("SELECT foto_masakan FROM recipes WHERE recipe_id = ? AND user_id = ?");
    $stmt->bind_param('ii', $recipe_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto_masakan = $row['foto_masakan'];
        $file_path = "../assets/foto-makanan/" . $foto_masakan;

        // Hapus file gambar dari folder
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Prepare a statement to delete the recipe
        $stmt = $conn->prepare("DELETE FROM recipes WHERE recipe_id = ? AND user_id = ?");
        $stmt->bind_param('ii', $recipe_id, $user_id);

        if ($stmt->execute()) {
            header("Location: halaman-resepku.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Recipe not found or you do not have permission to delete this recipe.";
    }

    $stmt->close();
    $conn->close();
}
?>
