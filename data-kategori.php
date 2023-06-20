<?php
session_start();
include 'db.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <h3>Data kategori</h3>
        <div class="box">
            <p><a href="tambah-kategori.php" >Tambah kategori</a></p>
           <table border="1" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th width="60px">no</th>
                    <th>kategori</th>
                    <th width="150px">aksi</th>
                </tr>
            </thead>
           <tbody>
            <?php
            $no=1;
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id ASC");
                    while ($row = mysqli_fetch_array($kategori)) {
            ?>
            <tr>
                <td><?php echo $no++ ?> </td>
                <td><?php echo $row['category_name']?></td>
                <td align="center">
                    <a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>"><i class="fa-solid fa-pen-nib"></i></a> 
                    <a href="proses-hapus.php?idk=<?php echo $row['category_id']?>"onclick="return confirm('apakah anda yakin ingin hapus data ini ?')" style="margin-left: 10px;"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php } ?>
           </tbody>
           </table>
        </div>
    </div>
</div>
<!-- footer nih bos -->
<footer>
  <p>copyright 2023 - buka warung<br>
  <a href="fachrulruhiat@gmail.com">fachrulruhiat@gmail.com</a></p>
</footer>
</body>
</html>