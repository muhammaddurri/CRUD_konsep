<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    //koneksi database
    $conn = new mysqli("localhost", "root", "", "crud_db");
    if ($conn->connect_error){
        die("koneksi Gagal : " . $conn->connect_error);

    }

    $sql = "INSERT INTO user (name, email, phone) VALUES ('$name','$email','$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");

    }else{
        echo "Error" . $sql. "<br>" . $conn->error;
    }



}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <title>Form Input</title>
</head>
<body>

    <div class="container my-5">
        <h2 class="text-center mb-4">Form Input Pengguna</h2>

        <form class="p-4 border rounded shadow" action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telepon</label>
                <input type="text" name="phone" class="form-control" id="phone" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
