<?php
$db_host = 'localhost'; 
$db_user = 'root';    
$db_pass = '';          
$db_name = 'aroma_dapur'; 

// Membuat koneksi ke database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
