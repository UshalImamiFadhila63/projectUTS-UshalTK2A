<?php
session_start();

include '../config/koneksi.php';

$username = $_POST['username'];//nik
$password = $_POST['password']; //nohp


$query_admin = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek_admin = mysqli_num_rows($query_admin);

if($cek_admin > 0){
    
    $data = mysqli_fetch_assoc($query_admin);

    $_SESSION['username'] = $username;
    $_SESSION['role']     = $data['role']; 
    $_SESSION['status']   = "login";

 
    header("location:../pages/admin/dashboard.php");
    exit(); 
}


$query_pasien = mysqli_query($koneksi, "SELECT * FROM peserta WHERE nik='$username' AND nomor_hp='$password'");
$cek_pasien = mysqli_num_rows($query_pasien);

if($cek_pasien > 0){
    $data = mysqli_fetch_assoc($query_pasien);

    
    $_SESSION['id_peserta'] = $data['id_peserta']; 

    $_SESSION['nama']   = $data['nama'];
    $_SESSION['role']   = "pasien";
    $_SESSION['status'] = "login";

    header("location:../pages/pasien/dashboard.php");
} 
else {
   
    header("location:../pages/auth/login.php?pesan=gagal");
}
?>