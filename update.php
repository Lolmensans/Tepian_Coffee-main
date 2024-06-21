<!DOCTYPE html>
<html>
<head>
    <title>Radhen Adebos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">TEPIAN ADMIN PAGE</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR MENU MINUMAN</center></h4>
        <?php
        include "koneksi.php";

        // Delete function
        if (isset($_GET['ID'])) {
            $ID = htmlspecialchars($_GET["ID"]);

            $sql = "DELETE FROM drinks WHERE ID='$ID'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }

        // Update function
        if (isset($_GET['update_id'])) {
            $update_id = htmlspecialchars($_GET["update_id"]);

            $sql = "SELECT * FROM drinks WHERE ID='$update_id'";
            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_assoc($hasil);
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ID = input($_POST["ID"]);
            $Type = input($_POST["Type"]);
            $Product = input($_POST["Product"]);
            $Price = input($_POST["Price"]);
            $Description = input($_POST["Description"]);

            if (isset($_POST['update'])) {
                // Update existing record
                $sql = "UPDATE drinks SET Type='$Type', Product='$Product', Price='$Price', Description='$Description' WHERE ID='$ID'";
            } else {
                // Insert new record
                $sql = "INSERT INTO drinks (Type, Product, Price, Description) VALUES ('$Type', '$Product', '$Price', '$Description')";
            }

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
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
                            <a href="index.php?update_id=<?php echo htmlspecialchars($data['ID']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?ID=<?php echo $data['ID']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="index.php?add_new=true" class="btn btn-primary" role="button">Tambah Data</a>

        <?php
        if (isset($_GET['add_new']) || isset($_GET['update_id'])) {
            $ID = isset($data['ID']) ? $data['ID'] : '';
            $Type = isset($data['Type']) ? $data['Type'] : '';
            $Product = isset($data['Product']) ? $data['Product'] : '';
            $Price = isset($data['Price']) ? $data['Price'] : '';
            $Description = isset($data['Description']) ? $data['Description'] : '';
        ?>
        <h2><?php echo isset($_GET['update_id']) ? 'Update Data' : 'Tambah Data'; ?></h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" name="Product" class="form-control" value="<?php echo $Product; ?>" placeholder="Masukan Nama Produk" required />
            </div>
            <div class="form-group">
                <label>Tipe:</label>
                <input type="text" name="Type" class="form-control" value="<?php echo $Type; ?>" placeholder="Masukan Tipe" required/>
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="text" name="Price" class="form-control" value="<?php echo $Price; ?>" placeholder="Masukan Harga" required/>
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="Description" class="form-control" rows="5" placeholder="Masukan Deskripsi" required><?php echo $Description; ?></textarea>
            </div>
            <?php if (isset($_GET['update_id'])) { ?>
                <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            <?php } else { ?>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <?php } ?>
        </form>
        <?php } ?>
    </div>
</body>
</html>
