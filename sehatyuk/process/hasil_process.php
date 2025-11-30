<?php
include '../config/koneksi.php';

$id_peserta  = $_POST['id_peserta'];
$id_layanan  = $_POST['id_layanan'];  
$nilai_hasil = $_POST['nilai_hasil'];

if(empty($id_peserta)){
    die("Error: ID Peserta tidak terkirim. Hubungi Admin.");
}


$hapus = mysqli_query($koneksi, "DELETE FROM hasil_pemeriksaan WHERE id_peserta='$id_peserta'");

$jumlah_data = count($id_layanan);
$berhasil_simpan = 0;

for($i = 0; $i < $jumlah_data; $i++){
    $layanan_saat_ini = $id_layanan[$i];
    $hasil_saat_ini   = $nilai_hasil[$i];

    if(!empty($hasil_saat_ini)){
        $insert = mysqli_query($koneksi, "INSERT INTO hasil_pemeriksaan (id_peserta, id_layanan, hasil_value) 
                                          VALUES ('$id_peserta', '$layanan_saat_ini', '$hasil_saat_ini')");
        if($insert){
            $berhasil_simpan++;
        } else {
            echo "Gagal simpan layanan ID $layanan_saat_ini: " . mysqli_error($koneksi) . "<br>";
        }
    }
}

if($berhasil_simpan > 0){
    header("location:../pages/admin/lihat_hasil.php?id=$id_peserta");
} else {
    echo "Tidak ada data yang disimpan. Pastikan Anda mengisi angka hasil pemeriksaan.";
}
?>