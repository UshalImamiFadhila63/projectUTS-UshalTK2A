<?php
include '../config/koneksi.php';

$aksi = $_GET['aksi'];

if($aksi == "add"){
    $tanggal = $_POST['tanggal_pemeriksaan'];
    $lokasi  = $_POST['lokasi'];
    $status  = $_POST['status_aktif'];

    mysqli_query($koneksi, "INSERT INTO jadwal (tanggal_pemeriksaan, lokasi, status_aktif) VALUES ('$tanggal', '$lokasi', '$status')");
    header("location:../pages/admin/data_jadwal.php");
}

elseif($aksi == "update"){
    $id      = $_POST['id_jadwal'];
    $tanggal = $_POST['tanggal_pemeriksaan'];
    $lokasi  = $_POST['lokasi'];
    $status  = $_POST['status_aktif'];

    mysqli_query($koneksi, "UPDATE jadwal SET tanggal_pemeriksaan='$tanggal', lokasi='$lokasi', status_aktif='$status' WHERE id_jadwal='$id'");
    header("location:../pages/admin/data_jadwal.php");
}

elseif($aksi == "delete"){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal='$id'");
    header("location:../pages/admin/data_jadwal.php");
}
?>