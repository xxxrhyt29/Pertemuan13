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
        <h3>Data produk</h3>
        <div class="box">
            <p><a href="tambah-produk.php" class="btn" >Tambah produk</a></p>
           <table border="1" cellspacing="0" class="table" style="margin-top: 15px;">
            <thead>
                <tr>
                    <th width="60px">no</th>
                    <th>kategori</th>
                    <th>nama produk</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>status</th>
                    <th width="150px">aksi</th>
                </tr>
            </thead>
           <tbody>
            <?php
                $no=1;
                $produk = mysqli_query($conn, "SELECT * FROM tb_product INNER JOIN tb_category ON tb_category.category_id=tb_product.category_id ORDER BY product_id DESC");
                if (mysqli_num_rows($produk) > 0) {

             
                    while ($row = mysqli_fetch_array($produk)) {
            ?>
            <tr>
                <td><?= $no++?></td>
                <td><?php echo $row['category_name']?> </td>
                <td><?php echo $row['product_name']?></td>
                <td><?php echo $row['product_price']?></td>
                <td><?php echo $row['product_description']?></td>
                <td align="center"><img src="produk/<?php echo $row['product_image']?>" width="80"></td>
                <td>
                    <?php if ($row['product_status'] == 1) {
                    # code...
                    echo 'Aktif';
                    }else {
                        # code...
                        echo 'Tidak Aktif';
                    }?>
                </td>
                <td>
                    <a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">edit</a> 
                    <a href="proses-hapus.php?idp=<?php echo $row['product_id']?>"onclick="return confirm('apakah anda yakin ingin hapus data ini ?')">hapus</a>
                </td>
            </tr>
            <?php } }else{ ?>
                <tr>
                    <td colspan="8  ">tidak ada data</td>
                </tr>
           <?php }?>
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