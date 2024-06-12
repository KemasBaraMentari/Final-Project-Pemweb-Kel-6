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

    // Prepare a statement to delete the recipe
    $stmt = $conn->prepare("DELETE FROM recipes WHERE recipe_id = ? AND user_id = ?");
    $stmt->bind_param('ii', $recipe_id, $user_id);

    if ($stmt->execute()) {
        header("Location: halaman-resepku.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
