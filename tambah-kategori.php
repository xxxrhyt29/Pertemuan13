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
        <h3>tambah data kategori</h3>
        <div class="box">
            <form action="" method="POST">
                 <input type="text" name="name" placeholder="Nama kategori" class="input-control"  required>
                 <input type="submit" name="submit" value="tambah data " class="btn">
                </form>
        </div>    
    <?php
            if (isset($_POST['submit'])) {
                $name    = ucwords($_POST['name']);
                
                $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES(
                                null, 
                                '".$name."')");
                            if($insert){
                                echo '<script>alert("tambah data berhasil sayang!")</script>';
                                echo '<script>window.location="data-kategori.php"</script>';
                            }else{
                                echo ' gagal ' .mysqli_error($conn);
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