<?php

session_start();
$koneksi = mysqli_connect("localhost", "root", "", "phpmailer");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['pw'];

    $qry = $koneksi->query("SELECT * FROM `data` WHERE email = '$email AND password = '$password");
    $cek = $qry->num_rows;

    if($cek >0){
$verif = $qry->fetch_assoc();
if($verif['is_verif'] = 1){
    $_SESSION['user'] = $verif;
}else{
    echo "<script>alert('login bergasil');window.location='index.php';</script>";

}
    }else{
        echo "<script>alert('harap verifikasi akun anda');window.location='lohin.php';</script>";

    }
    }
    ?>
<form action="login.php" method="POST">
        <label for="email">email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="login">Login</button>
        <P>belum memiliki akun <a href="register.php">daftar</a></P>

    </form>