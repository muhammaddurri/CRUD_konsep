<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <title>CRUD System</title>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Daftar Pengguna</h2>

        <!-- Button to add new user -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="create.php" class="btn btn-primary">Tambah Pengguna Baru</a>
            <form method="GET" action="index.php" class="d-flex"> <!-- Search form -->
                <input type="text" name="search" class="form-control me-2" placeholder="Cari pengguna...">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>

        <!-- Table for displaying user data -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "crud_db");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Mengambil data dari tabel
                    $sql = $search
                        ? "SELECT * FROM user WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'"
                        : "SELECT * FROM user";
                    
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"] . "</td>
                                    <td>" . $row["name"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["phone"] . "</td>
                                    <td>
                                        <a href='update.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm me-1'>Edit</a>
                                        <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
