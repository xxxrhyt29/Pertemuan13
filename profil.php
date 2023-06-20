<?php
include'db.php';
session_start();
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($conn,"SELECT * FROM tb_admin WHERE admin_id ='".$_SESSION['id']."'");
$d = mysqli_fetch_object($query);
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
        <h3>PROFIL</h3>
        <div class="box">
            <form action="" method="POST">
                 <input type="text" name="name" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                 <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                 <input type="text" name="Hp" placeholder="No Hp" class="input-control"  value="<?php echo $d->admin_tlpn ?>" required>
                 <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>"  required>
                 <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>"  required>
                 <input type="submit" name="submit" value="ubah profil" class="btn">
                </form>
            <?php
            if (isset($_POST['submit'])) {
                $name    = ucwords($_POST['name']);
                $user    = $_POST['user'];
                $Hp      = $_POST['Hp'];
                $email   = $_POST['email'];
                $alamat  = ucwords($_POST['alamat']);

                $update = mysqli_query($conn,"UPDATE tb_admin SET
                            admin_name = '".$name."',
                            username = '".$user."',
                            admin_tlpn = '".$Hp."',
                            admin_email= '".$email."',
                            admin_address = '".$alamat."'
                            WHERE admin_id = '".$d->admin_id."' ");

                if($update){
                    echo '<script>alert("ubah data berhasil bebb")</script>';
                    echo '<script>window.location="profil.php"</script>';
                }else{
                    echo 'gagal' .mysqli_error($conn);
                }
                
            }
            ?>
        </div>
        <h3>PASSWORD BARU</h3>
        <div class="box">
            <form action="" method="POST">
                <input type="Password" name="pass1" placeholder="password baru" class="input-control">
                <input type="Password" name="pass2" placeholder="konfirmasi password baru" class="input-control" >
                <input type="submit" name="ubah password" value="ubah password" class="btn">
            <?php
            if (isset($_POST['ubah_password'])) {
                $pass1    = ucwords($_POST['pass1']);
                $pass2    = $_POST['pass2'];

                if($pass2 != $pass1) {
                    echo '<script>alert("konfirmasi password baru tidak sesuai")</script>';
                }

                $u_pass = mysqli_query($conn,"UPDATE tb_admin SET
                            password = '".$pass1."' 
                            WHERE admin_id = '".$d->admin_id."'");

                            if($u_pass){
                                echo '<script>alert("ubah password berhasil")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'ubah password gagal' .mysqli_error($conn);
                            }
            };
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