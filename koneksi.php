<?php 

$conn = new mysqli("localhost", "root", "", "pendaftar");
    if ($conn->connect_error){
        die("koneksi Gagal : " . $conn->connect_error);

    }
?>