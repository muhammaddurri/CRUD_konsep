<?php
    
    $koneksi = mysqli_connect("localhost", "root", "", "crud_db");
    if ($koneksi->connect_error){
        die("koneksi Gagal : " . $koneksi->connect_error);

    }

    // Ambil ID pengguna dari URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Ambil data pengguna dari database
        $sql = "SELECT * FROM user WHERE id = $id";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Data tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID tidak disediakan.";
        exit;
    }


    // Memeriksa jika form telah disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Validasi sederhana
        if (!empty($name) && !empty($email) && !empty($phone)) {
            // Perbarui data pengguna
            $sql = "UPDATE user SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id";

            if ($koneksi->query($sql) === TRUE) {
                header("Location: index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        } else {
            echo "Semua kolom harus diisi!";
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
    <title>Edit Data</title>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Edit Data Pengguna</h2>

        <div class="card p-4 shadow-sm">
            <form action="" method="POST">
                <!-- Hidden input for user ID -->
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= $row['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="<?= $row['phone'] ?>" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Data</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

