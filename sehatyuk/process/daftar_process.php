<?php
include '../config/koneksi.php';

$id_jadwal = $_POST['id_jadwal'];
$nama      = $_POST['nama'];
$nik       = $_POST['nik'];
$hp        = $_POST['nomor_hp'];
$alamat    = $_POST['alamat'];

$query = mysqli_query($koneksi, "INSERT INTO peserta (id_jadwal, nama, nik, nomor_hp, alamat) VALUES ('$id_jadwal', '$nama', '$nik', '$hp', '$alamat')");

if($query){
    header("location:../index.php?pesan=sukses_daftar");
} else {
    echo "Gagal mendaftar: " . mysqli_error($koneksi);
}
?>