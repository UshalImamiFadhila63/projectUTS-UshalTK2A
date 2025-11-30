<?php
include '../config/koneksi.php';

$aksi = $_GET['aksi'];

if($aksi == "delete"){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM peserta WHERE id_peserta='$id'");
    header("location:../pages/admin/data_peserta.php");
}
?>