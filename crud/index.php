<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>Tepian Admin</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">TEPIAN ADMIN PAGE</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR MENU MINUMAN</center></h4>
        <?php
        include "koneksi.php";

        if (isset($_GET['ID'])) {
            $ID = htmlspecialchars($_GET["ID"]);

            $sql = "DELETE FROM drinks WHERE ID='$ID'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM drinks ORDER BY ID DESC";
                $hasil = mysqli_query($kon, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["Product"]; ?></td>
                        <td><?php echo $data["Type"]; ?></td>
                        <td><?php echo $data["Price"]; ?></td>
                        <td><?php echo $data["Description"]; ?></td>
                        <td>
                            <a href="update.php?ID=<?php echo htmlspecialchars($data['ID']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="index.php?ID=<?php echo htmlspecialchars($data['ID']); ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
</body>
</html>
