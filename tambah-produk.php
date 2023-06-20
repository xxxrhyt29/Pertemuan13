<?php
include'db.php';
session_start();
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

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
        <h3>tambah data produk</h3>
        <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">
                <select class="input-control" name="kategori" required>
                    <option value="0">--pilih--</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    while ($r = mysqli_fetch_array($kategori)) {
                        
                    ?>
                    <option value="<?php echo $r ['category_id']?>"><?php echo $r['category_name']?></option>
                    <?php } ?>
                </select>
                <input type="text" name="name"  placeholder="nama produk" class="input-control"  required>
                <input type="number" name="harga"  placeholder="Harga" class="input-control"  required>
                <input type="file" name="file" class="input-control"  required>
               <textarea class ="input-control" name="deskripsi"  placeholder="deskripsi" ></textarea>
               <select class="input-control" name="status">
                <option value="0">--piih--</option>
                <option value="1">Aktif</option>
                <option value="1">tidak aktif</option>
               </select> 
                 <input type="submit" name="submit" value="tambah data " class="btn">
                </form>
        </div>    
    <?php
                include 'db.php';
            if (isset($_POST['submit'])) {

               // print_r($_FILES['gambar']);//
               //menampung inputan dari from 
               $category_id    = $_POST['kategori'];
               $product_name      = $_POST['name'];
               $product_price      = $_POST['harga'];
               $product_description  = $_POST['deskripsi'];
               $product_status      = $_POST['status'];
               //menampung data file yang di upload
                $ekstensi_diperbolehkan	= array('png','jpg');
                $nama = $_FILES['file']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran	= $_FILES['file']['size'];
                $file_tmp = $_FILES['file']['tmp_name'];	
     
                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                    if($ukuran < 1044070){			
                        move_uploaded_file($file_tmp, 'produk/'.$nama);
                        $query = "INSERT INTO tb_product (category_id, product_name, product_price, product_description, product_image, product_status) VALUES ('$category_id', '$product_name', '$product_price',  '$product_description', '$nama', '$product_status')";
                        if($conn->query($query)){
                            echo '<script>alert("Data Terimpan...");window.location="data-produk.php";</script>';
                        }else{
                            echo '<script>alert("Gagal Upload Gambar...");window.location="tambah-produk.php";</script>';
                        }
                    }else{
                        echo '<script>alert("Ukuran Terlalu Besar...");window.location="tambah-produk.php";</script>';
                    }
                }else{
                    echo '<script>alert("Jenis Gambar Tidak Diizinkan...");window.location="tambah-produk.php";</script>';
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