<?php
$conn = new mysqli("localhost", "root", "", "projek_imk_tes");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?> 
