<!DOCTYPE html>
<html>
<head>
    <title>Form Daftar Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
 
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ID=input($_POST["ID"]);
        $Type=input($_POST["Type"]);
        $Product=input($_POST["Product"]);
        $Price=input($_POST["Price"]);
        $Description=input($_POST["Description"]);

        $sql="INSERT INTO drinks (ID,Type,Product,Price,Description) VALUES ('$ID','$Type','$Product','$Price','$Description')";
        $hasil=mysqli_query($kon,$sql);

        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama Produk:</label>
            <input type="text" name="Product" class="form-control" placeholder="Masukan Nama Produk" required />
        </div>
        <div class="form-group">
            <label>Tipe:</label>
            <input type="text" name="Type" class="form-control" placeholder="Masukan Tipe" required/>
        </div>
       <div class="form-group">
            <label>Harga:</label>
            <input type="text" name="Price" class="form-control" placeholder="Masukan Harga" required/>
        </div>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea name="Description" class="form-control" rows="5" placeholder="Masukan Deskripsi" required></textarea>
        </div>       
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
