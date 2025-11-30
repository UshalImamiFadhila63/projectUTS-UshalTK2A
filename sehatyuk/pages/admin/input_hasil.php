<?php
session_start();
include '../../config/koneksi.php';
if($_SESSION['status'] != "login"){ header("location:../auth/login.php"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Input Hasil - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899', 'sehat-abu': '#334155' } } } }</script>
</head>
<body class="bg-gray-50 font-sans">
    <nav class="bg-white shadow p-4 flex justify-between">
        <span class="font-bold text-sehat-pink">Input Hasil Pemeriksaan</span>
        <a href="dashboard.php" class="text-gray-600 hover:text-sehat-pink">Kembali</a>
    </nav>

    <div class="max-w-7xl mx-auto mt-10 p-5">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-bold text-lg mb-4">Pilih Peserta untuk Diperiksa</h3>
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3">Nama</th>
                        <th class="border p-3">NIK</th>
                        <th class="border p-3">Lokasi Jadwal</th>
                        <th class="border p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT peserta.*, jadwal.lokasi FROM peserta JOIN jadwal ON peserta.id_jadwal = jadwal.id_jadwal ORDER BY peserta.id_peserta DESC");
                    while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <tr class="text-center">
                        <td class="border p-3 text-left"><?php echo $row['nama']; ?></td>
                        <td class="border p-3"><?php echo $row['nik']; ?></td>
                        <td class="border p-3 text-left"><?php echo $row['lokasi']; ?></td>
                        <td class="border p-3">
                            <a href="form_periksa.php?id=<?php echo $row['id_peserta']; ?>" class="bg-sehat-pink text-white px-4 py-2 rounded hover:bg-pink-600 transition">
                                🩺 Periksa Sekarang
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>