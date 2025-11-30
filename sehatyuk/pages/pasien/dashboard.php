<?php
session_start();
include '../../config/koneksi.php';

if($_SESSION['status'] != "login" || $_SESSION['role'] != "pasien"){
    header("location:../auth/login.php");
}

$id_saya = $_SESSION['id_peserta'];

$q_profil = mysqli_query($koneksi, "SELECT peserta.*, jadwal.tanggal_pemeriksaan, jadwal.lokasi 
                                    FROM peserta 
                                    JOIN jadwal ON peserta.id_jadwal = jadwal.id_jadwal 
                                    WHERE id_peserta='$id_saya'");
$profil = mysqli_fetch_assoc($q_profil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Peserta - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899', 'sehat-abu': '#334155' } } } }
    </script>
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow p-4">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-sehat-pink">Hai, <?php echo $_SESSION['nama']; ?> 👋</span>
            </div>
            <a href="../../process/logout.php" class="text-gray-500 hover:text-red-500 font-semibold text-sm">Logout</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto mt-8 p-4">
        
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-sehat-pink mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                
                <div class="mb-4 md:mb-0">
                    <h3 class="text-lg font-bold text-sehat-abu mb-1">Identitas Peserta</h3>
                    <p class="text-gray-600">NIK: <span class="font-semibold"><?php echo $profil['nik']; ?></span></p>
                    <p class="text-gray-600">Alamat: <?php echo $profil['alamat']; ?></p>
                </div>

                <div class="text-left md:text-right bg-pink-50 p-3 rounded-lg md:bg-transparent md:p-0 w-full md:w-auto">
                    <p class="text-gray-500 text-sm">Tanggal Pemeriksaan:</p>
                    <p class="text-xl font-bold text-sehat-pink">
                        📅 <?php echo date('d F Y', strtotime($profil['tanggal_pemeriksaan'])); ?>
                    </p>
                    <p class="text-xs text-gray-500 font-semibold mt-1">
                        📍 <?php echo $profil['lokasi']; ?>
                    </p>
                </div>

            </div>
        </div>

        <h3 class="text-xl font-bold text-sehat-abu mb-4">Riwayat Hasil Pemeriksaan</h3>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="py-3 px-4">Jenis Pemeriksaan</th>
                        <th class="py-3 px-4">Hasil</th>
                        <th class="py-3 px-4">Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $query = mysqli_query($koneksi, "SELECT hasil_pemeriksaan.*, layanan.nama_layanan, layanan.satuan 
                                                     FROM hasil_pemeriksaan 
                                                     JOIN layanan ON hasil_pemeriksaan.id_layanan = layanan.id_layanan 
                                                     WHERE id_peserta='$id_saya'");
                    
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4"><?php echo $row['nama_layanan']; ?></td>
                        <td class="py-3 px-4 font-bold text-sehat-pink text-lg"><?php echo $row['hasil_value']; ?></td>
                        <td class="py-3 px-4 text-gray-500 text-sm"><?php echo $row['satuan']; ?></td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='3' class='py-8 text-center text-gray-400'>Hasil pemeriksaan belum keluar atau belum diinput petugas.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 text-center text-gray-400 text-sm">
            <p>Jika ada kesalahan data, silakan hubungi petugas di lokasi.</p>
        </div>
    </div>

</body>
</html>