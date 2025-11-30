<?php
session_start();
include '../../config/koneksi.php';
if($_SESSION['status'] != "login"){ header("location:../auth/login.php"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peserta - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899', 'sehat-abu': '#334155' } } } }
    </script>
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow p-4 flex justify-between">
        <span class="font-bold text-sehat-pink">Data Peserta</span>
        <a href="dashboard.php" class="text-gray-600 hover:text-sehat-pink">Kembali ke Dashboard</a>
    </nav>

    <div class="max-w-7xl mx-auto mt-10 p-5">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-bold text-lg mb-4 text-sehat-abu">Daftar Peserta Masuk</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-3 text-sm">No</th>
                            <th class="border p-3 text-sm">Nama Lengkap</th>
                            <th class="border p-3 text-sm">NIK</th>
                            <th class="border p-3 text-sm">Jadwal Pilihan</th>
                            <th class="border p-3 text-sm">No HP</th>
                            <th class="border p-3 text-sm">Alamat</th>
                            <th class="border p-3 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT peserta.*, jadwal.lokasi, jadwal.tanggal_pemeriksaan 
                                                         FROM peserta 
                                                         JOIN jadwal ON peserta.id_jadwal = jadwal.id_jadwal 
                                                         ORDER BY peserta.tanggal_daftar DESC");
                        
                        if(mysqli_num_rows($query) > 0){
                            while($row = mysqli_fetch_assoc($query)){
                        ?>
                        <tr class="text-center text-sm hover:bg-gray-50">
                            <td class="border p-3"><?php echo $no++; ?></td>
                            <td class="border p-3 font-semibold text-left"><?php echo $row['nama']; ?></td>
                            <td class="border p-3"><?php echo $row['nik']; ?></td>
                            <td class="border p-3 text-left">
                                <span class="block font-bold text-sehat-pink"><?php echo $row['lokasi']; ?></span>
                                <span class="text-xs text-gray-500"><?php echo $row['tanggal_pemeriksaan']; ?></span>
                            </td>
                            <td class="border p-3"><?php echo $row['nomor_hp']; ?></td>
                            <td class="border p-3 text-left"><?php echo $row['alamat']; ?></td>
                            <td class="border p-3">
                                <a href="../../process/peserta_process.php?aksi=delete&id=<?php echo $row['id_peserta']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus data peserta ini? Data hasil pemeriksaan juga akan terhapus.')" 
                                   class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='7' class='border p-5 text-center text-gray-400'>Belum ada peserta yang mendaftar.</td></tr>";
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>