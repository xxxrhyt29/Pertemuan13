<?php
include 'db.php';
session_start();
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

$kategori = mysqli_query($conn, "SELECT * FROM tb_product INNER JOIN tb_category ON tb_category.category_id=tb_product.category_id  WHERE product_id ='".$_GET['id']."'");
if (mysqli_num_rows($kategori) == 0 ){
    echo '<script>window.location="data-produk.php"</script>';
}
$k = mysqli_fetch_object($kategori);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buka warung</title>
    <link rel="stylesheet" type = "text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
<!-- header di sini bos -->
<header>
    <div class="container">
    <h1><a href = "dasboard.php">buka warung</a></h1>
    <ul>
        <li><a href="dasboard.php">dashboard</a></li>
        <li><a href="profil.php">profil</a></li>
        <li><a href="data-kategori.php">data kategori</a></li>
        <li><a href="data-produk.php"> data produk</a></li>
        <li><a href="keluar.php"> keluar</a></li>
    </ul>
    </div>
</header>
<!-- content nih bos -->
<div class="section">
    <div class="container">
        <h3>Edit data kategori</h3>
        <div class="box">
            <form action="" method="POST">
                 <input type="text" name="kategori" placeholder="Nama kategori" class="input-control" value="<?php echo $k->category_name?>" required>
                 <input type="text" name="name" placeholder="Nama kategori" class="input-control" value="<?php echo $k->product_name?>" required>
                 <input type="text" name="harga" placeholder="Nama kategori" class="input-control" value="<?php echo $k->product_price?>" required>
                 <input type="hidden" name="file" placeholder="Nama kategori" class="input-control" value="<?= $k->product_image?>"  required>
               <textarea class ="input-control" name="deskripsi"  placeholder="deskripsi" ><?= $k->product_description?></textarea>
               <input type="hidden" name="status" value="<?= $k->product_status?>">
                 <input type="submit" name="submit" value="edit " class="btn">
                </form>
        </div>    
    <?php
           if (isset($_POST['submit'])) {

            // print_r($_FILES['gambar']);//
            //menampung inputan dari from 
            $category_id    = $_POST['kategori'];
            $product_name      = $_POST['name'];
            $product_price      = $_POST['harga'];
            $product_description  = $_POST['deskripsi'];
            $product_status= $_POST['status'];
            $nama= $_POST['image'];
            //menampung data file yang di upload
            $query = "UPDATE  tb_product SET  product_name='$product_name',product_price='$product_price',product_description='$product_description', product_image='$nama',product_status='$product_status' WHERE category_id='$category_id'";
                     if($conn->query($query)){
                         echo '<script>alert("Data Terimpan...");window.location="data-produk.php";</script>';
                     }else{
                         echo '<script>alert("Gagal Upload Gambar...");window.location="edit-produk.php";</script>';
                     }
           
         }
               
    ?>
    </div>
</div>
<!-- footer nih bos -->
<footer>
  <p>copyright 2023 - buka warung<br>
  <a href="fachrulruhiat@gmail.com">fachrulruhiat@gmail.com</a></p>
</footer>
</body>
</html>