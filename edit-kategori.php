<?php
include'db.php';
session_start();
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id ='".$_GET['id']."'");
if (mysqli_num_rows($kategori) == 0 ){
    echo '<script>window.location="data-kategori.php"</script>';
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
                 <input type="text" name="name" placeholder="Nama kategori" class="input-control" value="<?php echo $k->category_name?>" required>
                 <input type="submit" name="submit" value="edit " class="btn">
                </form>
        </div>    
    <?php
            if (isset($_POST['submit'])) {
                $name    = ucwords($_POST['name']);
                
                $update = mysqli_query($conn,"UPDATE tb_category SET
                category_name = '".$name."'
                WHERE category_id = '".$k->category_id."' ");
                            if($update){
                                echo '<script>alert("edit date berhasil sayang!")</script>';
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