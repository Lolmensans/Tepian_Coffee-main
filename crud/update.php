<!DOCTYPE html>
<html>
<head>
    <title>Update Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">TEPIAN ADMIN PAGE</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>Update Data Minuman</center></h4>

        <?php
        include "koneksi.php";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (isset($_GET['ID'])) {
            $ID = input($_GET["ID"]);
            $sql = "SELECT * FROM drinks WHERE ID='$ID'";
            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_assoc($hasil);

            if (!$data) {
                echo "<div class='alert alert-danger'> Data tidak ditemukan.</div>";
                exit;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ID = input($_POST["ID"]);
            $Type = input($_POST["Type"]);
            $Product = input($_POST["Product"]);
            $Price = input($_POST["Price"]);
            $Description = input($_POST["Description"]);

            $sql = "UPDATE drinks SET Type='$Type', Product='$Product', Price='$Price', Description='$Description' WHERE ID='$ID'";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="ID" value="<?php echo $data['ID']; ?>" />
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" name="Product" class="form-control" value="<?php echo $data['Product']; ?>" required />
            </div>
            <div class="form-group">
                <label>Tipe:</label>
                <input type="text" name="Type" class="form-control" value="<?php echo $data['Type']; ?>" required />
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="text" name="Price" class="form-control" value="<?php echo $data['Price']; ?>" required />
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="Description" class="form-control" rows="5" required><?php echo $data['Description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
