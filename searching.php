<?php
// Mengimpor koneksi database
include 'koneksi.php';

// Memeriksa apakah parameter 'query' ada
if (isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']); // Menghindari SQL Injection

    // Query untuk mencari pengguna
    $sql = "SELECT * FROM user WHERE name LIKE '%$query%'";
    $result = $conn->query($sql);

    // Memeriksa apakah ada hasil
    if ($result->num_rows > 0) {
        // Menampilkan hasil pencarian
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Nama: " . $row["nama"] . "<br>";
        }
    } else {
        echo "Tidak ada hasil ditemukan.";
    }
} else {
    echo "Masukkan kata kunci pencarian.";
}

// Menutup koneksi
$conn->close();
?>