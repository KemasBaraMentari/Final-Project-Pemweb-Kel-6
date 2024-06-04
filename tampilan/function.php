<?php 
require_once '../assets/database/koneksi.php'; // Sesuaikan dengan jalur file koneksi.php Anda

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

?>